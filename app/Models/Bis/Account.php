<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['bis_id', 'username', 'status', 'password', 'last_login_ip', 'last_login_time', 'is_man', 'is_default'];

    /**
     * 根据bis_id 查询数据
     * @param $bisId
     * @return mixed
     */
    public function getBisByBisId($bisId)
    {
        $data = [
            'bis_id' => $bisId,
            'is_man' => 1
        ];
        $res = $this::where($data)->first();
        return $res;
    }
}
