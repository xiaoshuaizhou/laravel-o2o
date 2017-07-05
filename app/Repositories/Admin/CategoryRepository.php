<?php

namespace App\Repositories\Admin;


use App\Models\Admin\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
{
    /**
     * @var Category
     */
    public $category;

    /**
     * @param $attribu
     * @return mixede
     */
    public function create($attribute)
    {
        $data = [
            'listorder' => 0,
            'status' => 1,
        ];
        return $this->category->create(array_merge($attribute, $data));
    }
    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * 获取一级分类
     * @return mixed
     */
    public function getFistCategories() {
        $condition = [
            'parent_id' => 0,
            'status' => 1
        ];
        $res = $this->category->where($condition)->get();
        return $res;
    }
    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $category = $this->category->where('id' , $id)->first();
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
        $res = $this->category->where($condition)
            ->orderBy('id','desc')
            ->orderBy('listorder','desc')
            ->paginate(5);
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
        $res = $this->category->where($condition)
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
        return $this->category->find($id);
    }

    public function updateCategory($id, $data) {
        $category = $this->category->find($id);
        $category->update($data);
    }
    /**
     * 根据ID修改状态删除分类
     * @param $id
     * @return mixed
     */
    public function deleteCategoryStatus($id) {
        $category = $this->category->find($id);
        $data = ['status' => -1];
        return $category->update($data);
    }
    /**
     * 根据listorder排序
     * @param $id
     * @param $listorder
     * @return mixed
     */
    public function listorder($id, $listorder)
    {
        return $this->category
                ->where(['id' => $id])
                ->update(['listorder' => $listorder]);

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
        $category = $this->category->where($condition)
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
        $category = $this->category->where($condition)
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
        $cats = $this->category->whereIn('parent_id', $ids)
            ->where('status', 1)
            ->orderBy('listorder', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        return $cats;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->category->find($id);
    }
}