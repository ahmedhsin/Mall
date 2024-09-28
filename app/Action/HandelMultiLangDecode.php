<?php

namespace App\Action;

use App\Models\Lang;

class HandelMultiLangDecode
{
    public static function handel($columns, $multiLangCols, $lang){
        $langs = [];
        if ($lang == 'all'){
            $langs = Lang::query()->pluck('prefix');
        }
        foreach($multiLangCols as $col){
            $result = json_decode($columns[$col], true);
            if($lang == "all"){
                foreach ($langs as $lang_){
                    $columns[$lang_.'_'.$col] = $result[$lang_];
                }
                unset($columns[$col]);
            }else{
                $columns[$col] = $result[$lang];
            }
        }

        return $columns;
    }
}
