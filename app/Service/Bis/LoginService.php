<?php

namespace App\Service\Bis;


use App\Repositories\Bis\AccountRepository;
use Carbon\Carbon;
use Redirect;

class LoginService {
    /**
     * @var AccountRepository
     */
    public $accountRepository;

    /**
     * LoginController constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository) {
        $this->accountRepository = $accountRepository;
    }

    /**
     * 商户后台用户登录
     * @param $request
     * @return $this
     */
    public function Login($request) {
        $request = app($request);
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
    }
}