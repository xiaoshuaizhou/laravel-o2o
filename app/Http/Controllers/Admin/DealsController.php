<?php

namespace App\Http\Controllers\Admin;


use App\Service\Admin\DealsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toplan\FilterManager\Facades\FilterManager;

/**
 * Class DealsController
 * @package App\Http\Controllers\Admin
 */
class DealsController extends Controller
{

    /**
     * @var DealsService
     */
    public $dealsService;

    /**
     * DealsController constructor.
     * @param DealsService $dealsService
     */
    public function __construct(DealsService $dealsService)
    {
        $this->dealsService = $dealsService;
    }

    /**
     * 团购列表 多条件查询
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $deals = $this->dealsService->indexService(Request::class);
        $citys = $this->dealsService->getNormalCity();
        $categorys = $this->dealsService->getNormalCategories();
        return view('admin.deal.index', compact('citys', 'categorys', 'deals'));
    }

    /**
     * 待审核的团购商品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review() {
        $deals = $this->dealsService->reviewService(Request::class);
        $citys = $this->dealsService->getNormalCity();
        $categorys = $this->dealsService->getNormalCategories();
        return view('admin.deal.review', compact('citys', 'categorys', 'deals'));
    }

    /**
     * 团购商品编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $deal = $this->dealsService->getNormalDealById($id);
        $citys = $this->dealsService->getNormalCity();
        $categorys = $this->dealsService->getNormalCategories();
        $location = $this->dealsService->getNormalLocationById($deal->bis_id);
        return view('admin.deal.edit', compact('citys', 'categorys', 'deal', 'location'));
    }

    /**
     * 编辑团购商品
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $this->dealsService->updateDealById($request->all());
        return back();
    }

    /**
     * 团购商品下架
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id)
    {
        $this->dealRepository->deleteDealById($id);
        return back();
    }
}
