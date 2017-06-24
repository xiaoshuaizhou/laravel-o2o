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
        $res = $this->where($condition)
            ->orderBy('id','desc')
            ->orderBy('listorder','desc')
            ->paginate(1);
        return $res;
    }

    /**
     * 商户入驻是API接口使用（此处返回collection）
     * @param int $id
     * @return mixed
     */
    public function findFirstCategories($id=0)
    {
        $condition = [
            'parent_id' => $id,
        ];
        $res = $this->where($condition)
            ->orderBy('id','desc')
            ->orderBy('listorder','desc')
            ->get();
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

    /**
     * 根据listorder排序
     * @param $id
     * @param $listorder
     * @return mixed
     */
    public function listorder($id, $listorder)
    {
        return $this->where(['id' => $id])->update(['listorder' => $listorder]);

    }

    /**
     * 首页分类展示
     * @param int $parentId
     * @param int $limit
     * @return mixed
     */
    public function getIndexCategoryByParentId($parentId=0,$limit=5)
    {
        $condition = [
          'parent_id' => $parentId,
            'status' => 1
        ];
        $category = $this->where($condition)
            ->orderBy('listorder', 'desc')
            ->orderBy('id', 'desc');
        if ($limit){
            $category->limit($limit);
        }
        $category = $category->get();
        return $category;
    }
    /**
     * 首页分类展示
     * @param int $parentId
     * @param int $limit
     * @return mixed
     */
    public function getIndexCategoryByCategoryId($categoryId,$limit=5)
    {
        $condition = [
            'parent_id' => $categoryId,
            'status' => 1
        ];
        $category = $this->where($condition)
            ->orderBy('listorder', 'desc')
            ->orderBy('id', 'desc');
        if ($limit){
            $category->limit($limit);
        }
        $category = $category->get();
        return $category;
    }

    /**
     * 根据一级分类城市的ID集合获取二级城市
     * @param $ids
     * @return mixed
     */
    public function getSecondCategoryByParentId($ids)
    {
        $cats = $this->whereIn('parent_id', $ids)
            ->where('status', 1)
            ->orderBy('listorder', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }
}
