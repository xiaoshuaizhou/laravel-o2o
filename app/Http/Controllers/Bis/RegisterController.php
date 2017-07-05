<?php

namespace App\Http\Controllers\Bis;

use App\Service\Bis\BisRegisterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * Class RegisterController
 * @package App\Http\Controllers\Bis
 */
class RegisterController extends Controller
{
    /**
     * @var BisRegisterService
     */
    public $bisRegisterService;

    /**
     * RegisterController constructor.
     * @param BisRegisterService $bisRegisterService
     */
    public function __construct(BisRegisterService $bisRegisterService ) {
        $this->bisRegisterService = $bisRegisterService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data = $this->bisRegisterService->indexService();
        $citys = $data[0];
        $categorys = $data[1];
        return view('bis.register.index', compact('citys', 'categorys'));
    }

    /**
     * 商户入驻申请
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function store(Request $request) {
        $bis = $this->bisRegisterService->storeService(Request::class);
        return $this->waiting($bis->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function waiting($id)
    {
        $detail = $this->bisRegisterService->waitingService($id);
        return view('bis.register.waiting',compact('detail'));
    }
}
