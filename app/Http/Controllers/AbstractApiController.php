<?php

namespace App\Http\Controllers;

use GuzzleHttp\Utils;
use GuzzleHttp\Client;
use App\Utils\Logger\Logger;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

/**
 * @author Matteo Perino
 */
abstract class AbstractApiController extends AbstractGenericController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->logger = new Logger(
            env('APP_NAME') . '_api', //filename
            'api/' //subpath
        );
    }

    /**
     * @return Client
     *
     * @throws \Exception
     */
    private function getClient(): Client
    {
        if (is_null($this->client)) {
            if (empty($this->getBaseUri())) {
                throw new \Exception('No base URI defined in ' . static::class);
            }

            $this->client = new Client([
                'base_uri'                      => $this->getBaseUri(),
                RequestOptions::TIMEOUT         => 20,
                RequestOptions::CONNECT_TIMEOUT => 10,
                RequestOptions::VERIFY          => true,
                RequestOptions::HEADERS => [
                    'User-Agent' => env('APP_NAME'),
                    'Accept' => '*/*'
                ],
            ]);
        }

        return $this->client;
    }


    /**
     * Returns the proper base uri
     *
     * @return string
     */
    abstract protected function getBaseUri(): string;

    /**
     * Does a request, merging default parameters that would be otherwise dropped by Guzzle.
     *
     * @param string $method
     * @param string $uri
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $uri, array $data = [])
    {
        $logger = $this->logger;
        $process_mark = $logger->getProcessMark();

        $request = new GuzzleRequest(
            $method,
            $uri,
            array_merge(
                [
                    'User-Agent' => env('APP_NAME'),
                    'Accept' => '*/*'
                ],
                $data[RequestOptions::HEADERS] ?? [],
            ),
            $data[RequestOptions::BODY] ?? null
        );

        // log request
        $this->log(
            $this->getRequestLogEntry($data, $uri),
            $process_mark,
            $logger::ACTION_REQUEST
        );

        try {
            $response = $this->getClient()->send($request, $data);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
        } catch (ConnectException $exception) {
            $response = $exception->getMessage();
        } catch (\Exception $exception) {
            $response = $exception->getMessage();
        }

        // log response
        $this->log(
            $this->getResponseLogEntry($response, $uri),
            $process_mark,
            $logger::ACTION_RESPONSE
        );

        if (isset($exception)) {
            throw $exception;
        }

        return $response;
    }

    /**
     * Log request object
     *
     * @param array $options
     * @param string $uri
     *
     * @return string
     *
     * @throws \Exception
     */
    private function getRequestLogEntry(array $options, string $uri): string
    {
        $entry_content = '';

        if (isset($options[RequestOptions::FORM_PARAMS])) {
            $entry_content = \http_build_query($options[RequestOptions::FORM_PARAMS], '', '&');
        } elseif (isset($options[RequestOptions::JSON])) {
            $entry_content = Utils::jsonEncode($options[RequestOptions::JSON]);
        } elseif (isset($options[RequestOptions::BODY])) {
            $entry_content = $options[RequestOptions::BODY];
        }

        if (isset($options[RequestOptions::HEADERS])) {
            $entry_content .= "\nHeaders: " . json_encode($options[RequestOptions::HEADERS]);
        }

        $endpoint = $this->getBaseUri() . '/' . $uri;

        if (isset($options[RequestOptions::QUERY])) {
            $endpoint .= '?' . \http_build_query($options[RequestOptions::QUERY], "", '&');
        }

        $log_entry = $this->subText() . 'Request to ' . $endpoint . "\n" . $entry_content;

        return $log_entry;
    }

    /**
     * Log response object
     *
     * @param string|ResponseInterface $response
     * @param string $uri
     *
     * @return string
     *
     * @throws \Exception
     */
    private function getResponseLogEntry($response, string $uri): string
    {
        $body = null;
        if (is_string($response)) {
            $body = $response;
        } elseif (is_object($response)) {
            $interfaces = class_implements($response);
            if (isset($interfaces[ResponseInterface::class])) {
                $body = (string) $response->getBody() . "\nHeaders: " . json_encode($response->getHeaders());
            }
        }

        if (is_null($body)) {
            throw new \Exception("Unexpected response type. Expected string or ResponseInterface, " . gettype($response) . " given");
        }

        $log_entry = $this->subText() . 'Response from ' . $this->getBaseUri() . $uri . "\n" . $body;

        return $log_entry;
    }
}
