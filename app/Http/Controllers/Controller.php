<?php

namespace App\Http\Controllers;

use ChrisKonnertz\OpenGraph\OpenGraph;
use Hashids;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var OpenGraph
     */
    protected $og;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->initOg();
    }

    /**
     * 初始化 Facebook Open Graph.
     */
    protected function initOg()
    {
        $this->og = new OpenGraph;

        $this->og
            ->title('國立中正大學學生會')
            ->url(request()->url())
            ->type('website')
            ->locale('zh_TW');

        view()->share('og', $this->og);
    }

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

    /**
     * Decode hashid to original number.
     *
     * @param string $hashid
     *
     * @return int
     */
    protected function decodeHashid($hashid)
    {
        if (false !== strpos($hashid, '-')) {
            $hashid = array_last(explode('-', $hashid));
        }

        $ids = Hashids::decode($hashid);

        if (empty($ids)) {
            throw new NotFoundHttpException;
        }

        return array_first($ids);
    }
}
