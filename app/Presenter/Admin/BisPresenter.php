<?php

namespace App\Presenter\Admin;


class BisPresenter {
    /**
     * apply 状态判断
     * @param $status
     * @return string
     */
    public function apply($status) {
        $str = '';
        if ($status == 0){
            $str = '待审核';
        }elseif ($status == 1){
            $str = '审核通过';
        }else{
            $str = '申请不符要求';
        }
        return $str;
    }

    /**
     * category_path
     * @param $path
     * @return string
     */
    public function detail($path) {
        if (getCategoryByCategoryPath($path)) {
            return '<input type="checkbox" checked="checked" value="">' . getCategoryNameBySeCategoryId($path);
        } else {
            return '';
        }
    }

    /**
     * category select 选项
     * @param $categorys
     * @param $locationCid
     * @return string
     */
    public function selectCategory($categorys, $locationCid) {
        $str = '';
        foreach ($categorys as $category){
            if ( $category->id == $locationCid  ){
                $str .= '<option value="'.$category->id.'" selected="selected">'.$category->name.'</option>';
            }
        }
        return $str;
    }

    /**
     * city selest选项
     * @param $citys
     * @param $bisCityId
     * @return string
     */
    public function selectCity($citys, $bisCityId) {
        $str = '';
        foreach ($citys as $city){
            if ( $city->id == $bisCityId  ){
                $str = '<option value="'.$city->id.'" selected="selected">'.$city->name.'</option>';
            }
        }
        return $str;
    }
}