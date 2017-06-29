<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index($id) {
        $title = '支付页';
        $controller = '';
        $city = session('city');
        $citys = session('citys');
        $cats = session('cats');
        return view('index.pay.index', compact('title', 'controller', 'city', 'citys', 'cats'));
    }
}
