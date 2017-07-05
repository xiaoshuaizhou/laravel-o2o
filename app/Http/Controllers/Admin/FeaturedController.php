<?php

namespace App\Http\Controllers\Admin;

use App\Service\Admin\FeaturedService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FeaturedController
 * @package App\Http\Controllers\Admin
 */
class FeaturedController extends Controller
{
    /**
     * @var FeaturedService
     */
    public $featuredService;

    /**
     * FeaturedController constructor.
     * @param FeaturedService $featuredService
     */
    public function __construct(FeaturedService $featuredService)
    {
        $this->featuredService = $featuredService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $datas = $this->featuredService->indexService(request('type'));
        $featureds = config('app.featured');
        return view('admin.featured.index', compact('featureds', 'datas'));
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
        $this->featuredService->createService($request->all());
        return back();
    }

    /**
     * 删除推荐位
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id)
    {
        $this->featuredService->destoryService($id);
        return back();

    }
}
