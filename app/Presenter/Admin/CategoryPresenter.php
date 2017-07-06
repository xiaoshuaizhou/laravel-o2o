<?php

namespace App\Presenter\Admin;


class CategoryPresenter {
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
     * edit select
     * @param $categorys
     * @param $value
     * @return string
     */
    public function editPresenter($categorys, $value) {
        $str = '';
        if ($value->parent_id == 0){
            $str = '<option value="0">一级分类</option>';
        }else{
            foreach($categorys as $item){
                if ($value->parent_id == $item->id){
                    $str .= '<option value="'.$item->id. '" selected="selected">-'.$item->name.'-</option>';
                }
                $str .= '<option value="'.$item->id. '">-'.$item->name.'-</option>';
            }
        }
        return $str;
    }


}