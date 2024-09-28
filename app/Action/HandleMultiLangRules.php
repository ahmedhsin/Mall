<?php

namespace App\Action;

use App\Models\Lang;

class HandleMultiLangRules
{
    public static function handel($current, $multiLangCols)
    {
        $langs = Lang::query()->pluck('prefix');
        foreach ($multiLangCols as $col){
            foreach ($langs as $lang){
                $current[$lang . '_' . $col] = $current[$col];
            }
            unset($current[$col]);
        }
        return $current;
    }
}
