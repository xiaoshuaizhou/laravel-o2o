<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bis\Featured;
use App\Repositories\Bis\FeaturedRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FeaturedController
 * @package App\Http\Controllers\Admin
 */
class FeaturedController extends Controller
{
    /**
     * @var FeaturedRepository
     */
    public $featuredRepository;

    /**
     * FeaturedController constructor.
     * @param FeaturedRepository $featuredRepository
     */
    public function __construct(FeaturedRepository $featuredRepository)
    {
        $this->featuredRepository = $featuredRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $type = $request->type;
        if (empty($type)){
            $type = 0;
        }
        $featureds = config('app.featured');
        $datas = $this->featuredRepository->getNorMalFeaturedByType($type);
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
        $this->featuredRepository->create($request->all());
        return back();
    }

    /**
     * 删除推荐位
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id)
    {
        $this->featuredRepository->destory($id);
        return back();

    }
}
