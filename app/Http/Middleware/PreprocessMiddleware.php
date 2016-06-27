<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;
use ParagonIE\CSPBuilder\CSPBuilder;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PreprocessMiddleware
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Http\Response
     */
    protected $response;

    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new preprocess instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->request = $request;

        $this->view->share('now', Carbon::now());

        $this->response = $next($this->request);

        $this->buildCsp();

        return $this->response;
    }

    /**
     * Add content security policy headers to response.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function buildCsp()
    {
        if ($this->response instanceof BinaryFileResponse) {
            return;
        }

        $csp = CSPBuilder::fromFile(config_path('csp.json'));

        $csp->addDirective('upgrade-insecure-requests', $this->request->secure());

        $this->response->withHeaders($csp->getHeaderArray());
    }
}
