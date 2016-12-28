<?php

namespace App\Http\Controllers\Zinc;

use App\Http\Controllers\Controller;
use App\Models\Zinc;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param int $year
     * @param int $month
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $year, $month)
    {
        $zinc = Zinc::with(['media'])
            ->where('year', $year)
            ->where('month', $month)
            ->firstOrFail();

        if (! $zinc->getAttribute('published') && is_null($request->user())) {
            throw new NotFoundHttpException;
        }

        return view('zinc.show', compact('zinc'));
    }
}
