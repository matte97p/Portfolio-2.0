<?php

namespace App\Http\Controllers\Concrete;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use App\Exceptions\CustomHandler;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\AbstractApiController;

class BeerController extends AbstractApiController
{
    protected static $base_uri = [
        0 => 'https://api.openbrewerydb.org/v2/',   //prod
        1 => 'https://api.openbrewerydb.org/v1/',   //test
    ];

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    protected function getBaseUri(): string
    {
        return self::$base_uri[(int) App::isLocal()];
    }

    /**
     * list breweries
     *
     * @var Request $request
     *
     * @return \Illuminate\View\View
     *
     * @throws Exception
     */
    public function breweries(Request $request): \Illuminate\View\View
    {
        try {
            $parameters =
                [
                    RequestOptions::JSON => []
                ];

            $response = $this->request('get', 'breweries', $parameters);

            $response = json_decode((string) $response->getBody());

            return view('beer', array('data' => $this->paginate($response)))->with("message", "Data retrived");
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, "Login fallito!");
        }
    }
}
