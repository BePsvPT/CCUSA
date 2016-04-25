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

        if ($request->is('zinc*')) {
            $breadcrumbs[] = ['link' => route('zinc.index'), 'text' => '會刊'];

            if ($request->is('zinc/manage/analytics')) {
                $breadcrumbs[] = ['link' => '#!', 'text' => '流量分析'];
            } else if ($request->is('zinc/manage*')) {
                $breadcrumbs[] = ['link' => route('zinc.manage.index'), 'text' => '管理'];

                if ($request->is('zinc/manage/create')) {
                    $breadcrumbs[] = ['link' => '#!', 'text' => '新增'];
                } else if ($request->is('zinc/manage/*/edit')) {
                    $breadcrumbs[] = ['link' => '#!', 'text' => '編輯'];
                }
            }
        } else if ($request->is('documents*')) {
            $breadcrumbs[] = ['link' => route('documents.index'), 'text' => '文件'];

            if ($request->is('documents/create')) {
                $breadcrumbs[] = ['link' => '#!', 'text' => '新增'];
            } elseif ($request->is('documents/*/edit')) {
                $breadcrumbs[] = ['link' => '#!', 'text' => '編輯'];
            }
        }

        $this->view->share('breadcrumbs', $breadcrumbs);

        return $next($request);
    }
}
