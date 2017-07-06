<?php

namespace App\Presenter\Admin;


class CityPresenter {
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
    /**
     * edit select
     * @param $categorys
     * @param $value
     * @return string
     */
    public function editPresenter($citys, $value) {
        $str = '';
        if ($value->parent_id == 0){
            $str = '<option value="0">一级城市</option>';
        }else{
            foreach($citys as $city){
                if ($value->parent_id == $city->id){
                    $str .= '<option value="'.$city->id. '" selected="selected">-'.$city->name.'-</option>';
                }else{
                    $str .= '<option value="'.$city->id. '">-'.$city->name.'-</option>';

                }
            }
        }
        return $str;
    }


}