<?php

namespace App\Http\Controllers\Bis;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public $city;
    public $category;

    /**
     * RegisterController constructor.
     * @param $city
     */
    public function __construct(Citys $city, Category $category) {
        $this->city = $city;
        $this->category = $category;
    }

    public function index() {
        $citys = $this->city->getCitysByParentId();
        $categorys = $this->category->getFistCategories();
        return view('bis.register.index', compact('citys', 'categorys'));
    }
}
