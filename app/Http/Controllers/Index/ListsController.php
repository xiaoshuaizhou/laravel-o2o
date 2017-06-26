<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListsController extends Controller
{
    /**
     * 商品分类
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id) {
        $title = '团购网';
        $city = session('city');
        $citys = session('citys');
        $cats = session('cats');
        $controller = 'lists';
        return view('index.lists', compact('title', 'controller', 'city', 'citys', 'cats'));
    }
}
