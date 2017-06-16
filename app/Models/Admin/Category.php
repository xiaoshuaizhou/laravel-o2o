<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Request;
class Category extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['name', 'parent_id', 'listorder', 'status'];

    /**
     * 获取一级分类
     * @return mixed
     */
    public function getFistCategories() {
        $condition = [
            'parent_id' => 0,
            'status' => 1
        ];
        $res = $this->where($condition)->get();
        return $res;
    }

    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $category = Category::where('id' , $id)->first();
        $status == 0 ? $category->status = 1 : $category->status =0;
        $category->save();
    }

    /**
     * 获取子分类
     * @param $id
     * @return mixed
     */
    public function getSonsCategoryes($id=0) {
        $condition = [
            'parent_id' => $id,
        ];
        $res = $this->where($condition)->paginate();
        return $res;
    }

    /**
     * 获取一条分类
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id) {
        return $this::find($id);
    }
}
