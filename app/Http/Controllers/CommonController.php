<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\BisRepository;
use App\Repositories\Bis\DealRepository;
use App\Repositories\Bis\FeaturedRepository;
use App\Repositories\Bis\LocationRepository;
use App\Repositories\Index\OrderRepository;
use Illuminate\Http\Request;

/**
 * Class CommonController
 * @package App\Http\Controllers
 */
class CommonController extends Controller
{
    /**
     * @var CityRepository
     */
    public $cityRepository;
    /**
     * @var CategoryRepository
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
     * @var LocationRepository
     */
    public $locationRepository;
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
     * @param LocationRepository $locationRepository
     * @param BisRepository $bisRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        CityRepository $cityRepository,
        CategoryRepository $categoryRepository,
        FeaturedRepository $featuredRepository,
        DealRepository $dealRepository,
        LocationRepository $locationRepository,
        BisRepository $bisRepository,
        OrderRepository $orderRepository
    )
    {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->featuredRepository = $featuredRepository;
        $this->dealRepository = $dealRepository;
        $this->locationRepository = $locationRepository;
        $this->bisRepository = $bisRepository;
        $this->orderRepository = $orderRepository;
    }
}
