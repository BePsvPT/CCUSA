<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return 200 http response.
     *
     * @param array $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ok(array $headers = [])
    {
        return response('', 200, $headers);
    }
}
