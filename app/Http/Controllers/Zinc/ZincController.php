<?php

namespace App\Http\Controllers\Zinc;

use App\Zinc\Zinc;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ZincController extends Controller
{
    /**
     * Get the zinc list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $zincs = Zinc::with(['media'])
            ->where('published', true)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('zinc.index', compact('zincs'));
    }

    /**
     * Get the zinc content.
     *
     * @param int $year
     * @param int $month
     *
     * @return \Illuminate\View\View
     *
     * @throws NotFoundHttpException
     */
    public function show($year, $month)
    {
        $zinc = Zinc::with(['media'])
            ->where('year', $year)
            ->where('month', $month)
            ->firstOrFail();

        if (! $zinc->getAttribute('published') && Auth::guest()) {
            throw new NotFoundHttpException;
        }

        return view('zinc.show', compact('zinc'));
    }
}
