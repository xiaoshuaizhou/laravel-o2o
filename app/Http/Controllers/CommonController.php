<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use App\Models\Bis\Featured;
use App\Models\Bis\Location;
use Illuminate\Http\Request;

/**
 * Class CommonController
 * @package App\Http\Controllers
 */
class CommonController extends Controller
{
    /**
     * @var Citys
     */
    public $city;
    /**
     * @var Category
     */
    public $category;
    /**
     * @var Featured
     */
    public $featured;
    /**
     * @var Deal
     */
    public $deal;
    public $location;
    public $bis;

    /**
     * CommonController constructor.
     * @param Citys $citys
     * @param Category $category
     * @param Featured $featured
     * @param Deal $deal
     */
    public function __construct(
        Citys $citys,
        Category $category,
        Featured $featured,
        Deal $deal,
        Location $location,
        Bis $bis
    )
    {
        $this->city = $citys;
        $this->category = $category;
        $this->featured = $featured;
        $this->deal = $deal;
        $this->location = $location;
        $this->bis = $bis;
    }
}
