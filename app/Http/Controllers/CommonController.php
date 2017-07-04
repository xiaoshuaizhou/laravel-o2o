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
use App\Repositories\Bis\BisRepository;
use App\Repositories\Bis\DealRepository;
use App\Repositories\Bis\FeaturedRepository;
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
     * @var FeaturedRepository
     */
    public $featuredRepository;
    /**
     * @var DealRepository
     */
    public $dealRepository;
    /**
     * @var Location
     */
    public $location;
    /**
     * @var BisRepository
     */
    public $bisRepository;
    /**
     * @var
     */
    public $orderRepository;

    /**
     * CommonController constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param FeaturedRepository $featuredRepository
     * @param DealRepository $dealRepository
     * @param Location $location
     * @param BisRepository $bisRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        CityRepository $cityRepository,
        CategoryRepository $categoryRepository,
        FeaturedRepository $featuredRepository,
        DealRepository $dealRepository,
        Location $location,
        BisRepository $bisRepository,
        OrderRepository $orderRepository
    )
    {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->featuredRepository = $featuredRepository;
        $this->dealRepository = $dealRepository;
        $this->location = $location;
        $this->bisRepository = $bisRepository;
        $this->orderRepository = $orderRepository;
    }
}
