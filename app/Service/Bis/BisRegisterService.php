<?php

namespace App\Service\Bis;

use App\Events\UserRegister;
use DB;
use App\Api\Map;
use Carbon\Carbon;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\AccountRepository;
use App\Repositories\Bis\BisRepository;
use App\Repositories\Bis\LocationRepository;

class BisRegisterService {
    /**
     * @var CityRepository
     */
    public $cityRepository;
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;
    /**
     * @var BisRepository
     */
    public $bisRepository;
    /**
     * @var LocationRepository
     */
    public $locationRepository;
    /**
     * @var AccountRepository
     */
    public $accountRepository;

    /**
     * RegisterController constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param BisRepository $bisRepository
     * @param LocationRepository $locationRepository
     * @param AccountRepository $accountRepository
     */
    public function __construct(
            BisRepository $bisRepository,
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            LocationRepository $locationRepository,
            AccountRepository $accountRepository
    ) {
        $this->bisRepository = $bisRepository;
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->locationRepository = $locationRepository;
        $this->accountRepository = $accountRepository;
    }

    /**
     * 商户后台注册视图
     * @return array
     */
    public function indexService() {
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        return [$citys, $categorys];
    }

    /**
     * 商户入驻申请
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function storeService($request) {
        $request = app($request);
        $name = $this->accountRepository->whereFromUsername( $request->username);
        $email = $this->bisRepository->whereFormEmial($request->email);
        if ($name || $email){
            $message = '该用户名或邮箱已经存在';
            return abort(404, $message);exit;
        }

        //获取经纬度
        $lnglat = Map::getLngLat($request->address);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
            $message = '获取位置失败';
            return abort(404,$message);exit;
        }

        DB::beginTransaction();
        try {
            //商户基本信息
            $bisData = [
                    'name' => $request->name,
                    'city_id' => $request->city_id,
                    'city_path' => empty($request->se_city_id) ? $request->city_id : $request->city_id . ',' . $request->se_city_id,
                    'logo' => $request->logo,
                    'licence_logo' => $request->licence_logo,
                    'description' => empty($request->description) ? '' : $request->description,
                    'bank_info' => $request->bank_info,
                    'bank_name' => $request->bank_name,
                    'bank_user' => $request->bank_user,
                    'faren' => $request->faren,
                    'faren_tel' => $request->faren_tel,
                    'email' => $request->email
            ];
            $bis = $this->bisRepository->create($bisData);
            //总店相关信息
            $data['cat'] = '';
            if (!empty($request->se_category_id)) {
                $data['cat'] = implode('|', $request->se_category_id);
            }
            $locationData = [
                    'bis_id' => $bis->id,
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
                    'is_main' => 1, //总店
                    'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
                    'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
                    'bank_info' => $request->bank_info,
            ];
            $this->locationRepository->create($locationData);
            //账户信息
            $accountData = [
                    'bis_id' => $bis->id,
                    'username' => $request->username,
                    'password' => password_hash($request->password, PASSWORD_DEFAULT),
                    'last_login_ip' => getIp(),
                    'last_login_time' => Carbon::now(),
                    'is_man' => 1, //总管理员
            ];
            $this->accountRepository->create($accountData);
            DB::commit();
            return $bis;
        }catch (\Exception $e){
            DB::rollBack();
            return back();
        }
        //使用事件处理邮件发送
        event(new UserRegister($this->bisRepository->latestFirst()));
    }

    /**
     * 注册邮件视图
     * @param $id
     * @return mixed
     */
    public function waitingService($id) {
        if (empty($id)){
            $message = '该信息有误，请重新填写';
            abort(404, $message);
        }
        return $this->bisRepository->whereForm($id);
    }
}