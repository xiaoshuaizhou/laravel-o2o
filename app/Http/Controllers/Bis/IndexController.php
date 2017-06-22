<?php

namespace App\Http\Controllers\Bis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        if (session('bisuser')){
            return view('bis.index.index');
        }
        return view('bis.login.index');
    }
}
