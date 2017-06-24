<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers\Index
 */
class IndexController extends CommonController
{
    /**
     * @var
     */
    public $citys;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $cityName = $request->city;
        $citys = $this->city->getNormalCity();
        $this->getCity($citys, $cityName);
        $city = $this->citys;
        return view('index.index', compact('citys', 'city'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome() {
        return view('welcomepage');
    }

    /**
     * @param $citys
     * @param $cityName
     */
    private function getCity($citys, $cityName)
    {
        $defaultName = '';
        foreach ($citys as $city) {
            if ($city->is_default == 1) {
                $defaultName = $city->uname;
                break;
            }
        }
            $defaultName = $defaultName ? $defaultName : 'beijing';
            if (session('cityuname') && empty(request('city'))){
                $cityuname = session('cityuname');
            }else {
                $cityuname = $cityName ? $cityName : trim($defaultName);
                session('cityuname', $cityuname);
            }
            $this->citys = $this->city->where('uname', $cityuname)->first();
    }
}
