<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bis\Featured;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FeaturedController
 * @package App\Http\Controllers\Admin
 */
class FeaturedController extends Controller
{
    /**
     * @var Featured
     */
    public $featured;

    /**
     * FeaturedController constructor.
     * @param $featured
     */
    public function __construct(Featured $featured)
    {
        $this->featured = $featured;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.featured.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $featureds = config('app.featured');
        return view('admin.featured.add', compact('featureds'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $this->featured->create($request->all());
        return back();
    }
}
