<?php

namespace App\Http\Controllers\Bis;

use App\Api\Map;
use App\Events\UserRegister;
use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Account;
use App\Models\Bis\Bis;
use App\Models\Bis\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public $city;
    public $category;
    public $bis;
    public $location;
    public $account;
    /**
     * RegisterController constructor.
     * @param $city
     */
    public function __construct(Citys $city, Category $category, Bis $bis, Location $location, Account $account) {
        $this->city = $city;
        $this->category = $category;
        $this->bis = $bis;
        $this->location = $location;
        $this->account = $account;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $citys = $this->city->getCitysByParentId();
        $categorys = $this->category->getFistCategories();
        return view('bis.register.index', compact('citys', 'categorys'));
    }

    public function store(Request $request) {

        $name = $this->account->where('username', '=', $request->username)->first();
        $email = $this->bis->where('email', '=', $request->email)->first();
        if ($name || $email){
            return abort(404, '该用户名或邮箱已经存在');exit;
        }

        //获取经纬度
        $lnglat = Map::getLngLat($request->address);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
            abort(404,'获取位置失败');
        }

        \DB::beginTransaction();
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
            $bis = $this->bis->create($bisData);
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
            $this->location->create($locationData);
            //账户信息
            $accountData = [
                    'bis_id' => $bis->id,
                    'username' => $request->username,
                    'password' => password_hash($request->password, PASSWORD_DEFAULT),
                    'last_login_ip' => getIp(),
                    'last_login_time' => Carbon::now(),
                    'is_man' => 1, //总管理员
            ];
            $this->account->create($accountData);
            \DB::commit();
        }catch (\Exception $e){
            \DB::rollBack();
        }
        //使用事件处理邮件发送
        event(new UserRegister($this->bis->latest()->first()));
        return $this->waiting($bis->id);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function waiting($id)
    {
        if (empty($id)){
            abort(404, '该信息有误，请重新填写');
        }
        $detail = $this->bis->where('id', $id)->first();
        return view('bis.register.waiting',compact('detail'));
    }
}
