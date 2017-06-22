<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealsController extends Controller
{
    public $city;
    public $category;
    /**
     * DealsController constructor.
     * @param $city
     */
    public function __construct(Citys $city, Category $category)
    {
        $this->city = $city;
        $this->category = $category;
    }

    public function index()
    {
        $citys = $this->city->getNormalCity();
        $categorys = $this->category->findFirstCategories();
        return view('admin.deal.index', compact('citys','categorys'));
    }
}
