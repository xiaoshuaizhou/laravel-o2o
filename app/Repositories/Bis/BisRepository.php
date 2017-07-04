<?php

namespace App\Repositories\Bis;
use App\Models\Bis\Account;
use App\Models\Bis\Bis;
use App\Models\Bis\Location;

/**
 * Class BisRepository
 * @package App\Repositories\Bis
 */
class BisRepository
{
    /**
     * @var Bis
     */
    public $bis;

    /**
     * BisRepository constructor.
     * @param $bis
     */
    public function __construct(Bis $bis) {
        $this->bis = $bis;
    }
    /**
     * 根据状态获取bis实例
     * @param $status
     * @return mixed
     */
    public function getBisByStatus($status=0)
    {
        $data = [
                'status' => $status
        ];
        $res = $this->bis->where($data)
                ->orderBy('id', 'desc')
                ->paginate(1);
        return $res;
    }

    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $bis = $this->bis->where('id' , $id)->first();
        $location = Location::where('bis_id', $id)->first();
        $account = Account::where('bis_id', $id)->first();
        $status == 0 ? $bis->status = $location->status = $account->status = 1   : $bis->status = $location->status = $account->status = 0;
        $bis->save();
        $location->save();
        $account->save();
    }
    /**
     * 根据ID获取数据
     * @param $id
     * @return mixed
     */
    public function getBisById($id)
    {
        $res = $this->bis->where('id', $id)->first();
        return $res;
    }
    /**
     * 商户删除状态
     * @param $id
     * @param $status
     */
    public function changStatusDel($id, $status)
    {
        $bis = $this->bis->where('id' , $id)->first();
        $location = Location::where('bis_id', $id)->first();
        $account = Account::where('bis_id', $id)->first();
        $bis->status = $location->status = $account->status = $status;
        $bis->save();
        $location->save();
        $account->save();
    }
    /**
     * @param $id
     * @return mixed
     */
    public function whereForm($id) {
        return $this->bis->where('id', $id)->first();
    }
    /**
     * @param $name
     * @return mixed
     */
    public function whereFormNameLike($name) {
        return $this->bis->where('name', 'like', '%'.$name.'%')->first();
    }
    /**
     * @return mixed
     */
    public function latestFirst() {
        return $this->bis->latest()->first();
    }
    /**
     * @param $email
     * @return mixed
     */
    public function whereFormEmial($email) {
        return $this->bis->where('email', '=', $email)->first();
    }
    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        return $this->bis->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->bis->find($id);
    }
}
