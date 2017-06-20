<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Bis extends Model
{
    protected $table = 'biss';
    protected $fillable = ['name', 'city_id', 'city_path', 'logo', 'licence_logo', 'description', 'bank_info', 'bank_name', 'bank_user', 'faren', 'faren_tel', 'email'];

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
        $res = $this->where($data)
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
        $bis = $this::where('id' , $id)->first();
        $status == 0 ? $bis->status = 1 : $bis->status =0;
        $bis->save();
    }

    /**
     * 根据ID获取数据
     * @param $id
     * @return mixed
     */
    public function getBisById($id)
    {
        $res = $this::where('id', $id)->first();
        return $res;
    }
}
