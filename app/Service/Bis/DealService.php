<?php

namespace App\Service\Bis;


use App\Repositories\Bis\AccountRepository;
use App\Repositories\Bis\DealRepository;
use App\Repositories\Bis\LocationRepository;

class DealService {
    public $locationRepository;
    public $dealRepository;
    public $accountRepository;
    /**
     * DealService constructor.
     * @param $locationRepository
     * @param $dealRepository
     */
    public function __construct(
            LocationRepository $locationRepository,
            DealRepository $dealRepository,
            AccountRepository $accountRepository
    ) {
        $this->locationRepository = $locationRepository;
        $this->dealRepository = $dealRepository;
        $this->accountRepository = $accountRepository;
    }

    public function create($request) {
        $request = app($request);
        $bisId = session('bisuser')->bis_id;
        $location = $this->locationRepository->find($request->location_ids[0]);
        if (empty($location)){
            abort(404, '分店不存在，请联系主管理员');
        }
        $data = [
                'bis_id' => $bisId,
                'name' => $request->name,
                'image' => $request->image,
                'category_id' => $request->category_id,
                'se_category_id' => empty($request->category_id) ? '' : implode(',', $request->se_category_id),
                'city_id' => $request->city_id,
                'location_ids' => empty($request->location_ids) ? '' : implode(',', $request->location_ids),
                'start_time' => ($request->start_time),
                'end_time' => ($request->end_time),
                'total_count' => $request->total_count,
                'origin_price' => $request->origin_price,
                'current_price' => $request->current_price,
                'coupons_begin_time' => ($request->coupons_begin_time),
                'coupons_end_time' => ($request->coupons_end_time),
                'notes' => htmlentities($request->notes),
                'description' => htmlentities($request->description),
                'account_id' => $this->accountRepository->whereFormBisId($bisId)->id,
                'xpoint' => $location->xpoint,
                'ypoint' => $location->ypoint,
        ];
        $this->dealRepository->create($data);
    }
}