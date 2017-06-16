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

    public function changStatus($id,$status) {
        $category = Category::where('id' , $id)->first();
        $status == 0 ? $category->status = 1 : $category->status =0;
        $category->save();
    }
}
