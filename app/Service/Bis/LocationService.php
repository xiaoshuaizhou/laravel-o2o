<?php

namespace App\Service\Bis;


use App\Repositories\Bis\LocationRepository;
use App\Api\Map;
class LocationService {
    public $locationRepository;

    /**
     * LocationService constructor.
     * @param $locationRepository
     */
    public function __construct(LocationRepository $locationRepository) {
        $this->locationRepository = $locationRepository;
    }

    /**
     * 实现添加分店
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $request = app($request);
        //获取经纬度
        $lnglat = Map::getLngLat($request->address);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
            abort(404,'获取位置失败');
        }
        $data['cat'] = '';
        if (!empty($request->se_category_id)) {
            $data['cat'] = implode('|', $request->se_category_id);
        }
        $bisId = session('bisuser')->bis_id;
        $locationData = [
                'bis_id' => $bisId,
                'tel' => $request->tel,
                'logo' => $request->logo,
                'name' => $request->name,
                'contact' => $request->contact,
                'category_id' => $request->category_id,
                'category_path' => $request->category_id . ',' . $data['cat'],
                'city_id' => $request->city_id,
                'city_path' => empty($request->se_city_id) ? $request->city_id : $request->city_id . ',' . $request->se_city_id,
                'address' => $request->address,
                'api_address' => $request->address,
                'open_time' => $request->open_time,
                'content' => empty($request->content) ? '' : $request->content,
                'is_main' => 0, //分店
                'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
                'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
                'bank_info' => $request->bank_info,
        ];
        return $this->locationRepository->create($locationData);
    }
}