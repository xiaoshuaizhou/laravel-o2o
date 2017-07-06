<?php

namespace App\Presenter\Admin;


class FeaturedPresenter {
    /**
     * @param $featureds
     * @return string
     */
    public function selectFeatureds($featureds) {
        $str = '';
        foreach($featureds as $key=>$featured){
            $str .= '<option value="'.$key.'">'.$featured.'</option>';
        }
		return $str;
    }
}