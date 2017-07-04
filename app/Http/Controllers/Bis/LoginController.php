<?php

namespace App\Http\Controllers\Bis;

use App\Repositories\Bis\AccountRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
class LoginController extends Controller
{
    public $accountRepository;

    /**
     * LoginController constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository) {
        $this->accountRepository = $accountRepository;
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
    public function login(Request $request) {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);
        $acconnt = $this->accountRepository->whereFromUsername($request->username);
        if (empty($acconnt) || $acconnt->status != 1){
            return Redirect::back()->withErrors(['msg' => '账户不存在或者用户审核未通过']);
        }
        /*校验密码是否正确*/
        if (!password_verify($request->password,$acconnt->password)){
            return Redirect::back()->withErrors(['msg' => '账户或密码错误']);
        }
        $acconnt->last_login_time = Carbon::now();
        $acconnt->save();
        session(['bisuser' => $acconnt]);
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
