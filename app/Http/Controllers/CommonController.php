<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use App\Models\Bis\Featured;
use App\Models\Bis\Location;
use App\Models\Index\Order;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Index\OrderRepository;
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
    public $cityRepository;
    /**
     * @var Category
     */
    public $categoryRepository;
    /**
     * @var Featured
     */
    public $featured;
    /**
     * @var Deal
     */
    public $deal;
    /**
     * @var Location
     */
    public $location;
    /**
     * @var Bis
     */
    public $bis;
    /**
     * @var
     */
    public $orderRepository;
    /**
     * CommonController constructor.
     * @param Citys $citys
     * @param Category $category
     * @param Featured $featured
     * @param Deal $deal
     */
    public function __construct(
        CityRepository $cityRepository,
        CategoryRepository $categoryRepository,
        Featured $featured,
        Deal $deal,
        Location $location,
        Bis $bis,
        OrderRepository $orderRepository
    )
    {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->featured = $featured;
        $this->deal = $deal;
        $this->location = $location;
        $this->bis = $bis;
        $this->orderRepository = $orderRepository;
    }
}
