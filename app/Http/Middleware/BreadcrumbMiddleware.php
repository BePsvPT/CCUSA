<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;

class BreadcrumbMiddleware
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new error binder instance.
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
        $breadcrumbs = [];

        switch (true) {
            case $request->is('zinc/manage/create') || $request->is('zinc/manage/*/edit'):
                $breadcrumbs[] = ['link' => '#!', 'text' => '新增 / 編輯'];
            case $request->is('zinc/manage'):
                $breadcrumbs[] = ['link' => route('zinc.manage.index'), 'text' => '管理'];
            case $request->is('zinc'):
                $breadcrumbs[] = ['link' => route('zinc.index'), 'text' => '會刊'];
                break;
            case $request->is('zinc/manage/analytics'):
                $breadcrumbs[] = ['link' => route('zinc.manage.analytics'), 'text' => '流量分析'];
                $breadcrumbs[] = ['link' => route('zinc.index'), 'text' => '會刊'];
                break;
            case $request->is('document'):
                $breadcrumbs[] = ['link' => route('document'), 'text' => '文件'];
                break;
        }

        $this->view->share('breadcrumbs', array_reverse($breadcrumbs));

        return $next($request);
    }
}
