<?php

namespace App\Presenter\Admin;


class DealPresenter {
    /**
     * citySelectPresenter
     * @param $citys
     * @param $deal
     * @return string
     */
    public function citySelectPresenter($citys, $deal) {
        $str  ='';
        foreach ($citys as $city){
            if ($city->id == $deal->city_id){
                $str .= '<option value="'.$city->id.'" selected="selected">'.$city->name.'</option>';
                break;
            }else{
                $str .= '<option value="'.$city->id.'>'.$city->name.'</option>';
            }
        }
        return $str;
    }
    /**
     * citySelectCategoryPresenter
     * @param $categorys
     * @param $value
     * @return string
     */
    public function citySelectCategoryPresenter($categorys, $deal) {
        $str  ='';
        foreach ($categorys as $category){
            if ($category->id == $deal->category_id){
                $str .= '<option value="'.$category->id.'" selected="selected">'.$category->name.'</option>';
                break;
            }else{
                $str .= '<option value="'.$category->id.'>'.$category->name.'</option>';
            }
        }
        return $str;
    }
    /**
     * category select
     * @param $categories
     * @return string
     */
    public function selectPersenter($categories) {
        $str = '';
        foreach ($categories as $category){
            $str .= '<option value="'.$category->id.'">-'.$category->name.'-</option>';
        }
        return $str;
    }
    /**
     * selectcity
     * @param $cities
     * @return string
     */
    public function selectCity($cities) {
        $str = '';
        foreach ($cities as $city){
            $str .= '<option value="'.$city->id.'">-'.$city->name.'-</option>';
        }
        return $str;
    }
}