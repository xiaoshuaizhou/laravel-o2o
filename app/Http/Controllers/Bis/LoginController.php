<?php

namespace App\Http\Controllers\Bis;

use App\Models\Bis\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
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
        $acconnt = Account::where('username', $request->username)->first();
        if (empty($acconnt) || $acconnt->status != 1){
            return \Redirect::back()->withErrors(['msg' => '账户不存在或者用户审核未通过']);
        }
        /*校验密码是否正确*/
        if (!password_verify($request->password,$acconnt->password)){
            return \Redirect::back()->withErrors(['msg' => '账户或密码错误']);
        }
        $acconnt->last_login_time = Carbon::now();
        $acconnt->save();
        session(['bisuser' => $acconnt]);
        return redirect('/bis/');
    }
}
