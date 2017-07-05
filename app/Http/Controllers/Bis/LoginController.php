<?php

namespace App\Http\Controllers\Bis;

use App\Http\Requests\BisLoginRequest;
use App\Service\Bis\LoginService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LoginController
 * @package App\Http\Controllers\Bis
 */
class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    public $loginService;

    /**
     * LoginController constructor.
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService) {
        $this->loginService = $loginService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        if (session('bisuser')){
            return redirect('/bis/');
        }
        return view('bis.login.index');
    }

    /**
     * 商户后台登录
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(BisLoginRequest $request) {
        $this->loginService->Login(Request::class);
        return redirect('/bis/');
    }

    /**
     * 商户后台退出登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        session()->forget('bisuser');
        return redirect('/bis/login');
    }
}
