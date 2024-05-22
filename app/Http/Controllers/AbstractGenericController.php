<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Utils\Logger\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class AbstractGenericController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected ?Client $client = null;
    protected ?Logger $logger = null;
    protected static $errors = [];

    public function __construct(Request $request)
    {}

    /**
     * Log action
     *
     * @param string $log_entry
     * @param string $process_mark
     * @param string $action
     *
     * @return void
     */
    protected function log(string $log_entry, string $process_mark, string $action = 'request')
    {
        $this->logger->info($log_entry, [$process_mark]);
    }

    protected function subText(): string
    {
        return (App::isLocal() ? '[TEST]' : '') . ('[User:' . (Auth::user()->user_id ?? 'Anon') . ']');
    }
    
    /**
     * Log request object
     *
     * @var array $items
     * 
     * @return string
     *
     * @throws \Exception
     */
    public function paginate(array $items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
