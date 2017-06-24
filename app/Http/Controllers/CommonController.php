<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Featured;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public $city;
    public $category;
    public $featured;
    public function __construct(
        Citys $citys,
        Category $category,
        Featured $featured
    )
    {
        $this->city = $citys;
        $this->category = $category;
        $this->featured = $featured;
    }
}
