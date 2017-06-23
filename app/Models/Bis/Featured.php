<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $fillable = ['title', 'image', 'type', 'url', 'status', 'listorder', 'description'];

    /**
     * 根据type查询推荐位
     * @param $type
     * @return mixed
     */
    public function getNorMalFeaturedByType($type)
    {
        $condition = ['type' => $type];
        $featured = $this->where($condition)
                        ->where('status', '>=', 0)
                        ->paginate(1);
        return $featured;
    }

    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $featured = $this::where('id' , $id)->first();
        $status == 0 ? $featured->status = 1 : $featured->status =0;
        $featured->save();
    }

    /**
     * 推荐位删除
     * @param $id
     */
    public function destory($id)
    {
        $featured = $this->find($id);
        $featured->status = 2;
        $featured->save();
    }
}
