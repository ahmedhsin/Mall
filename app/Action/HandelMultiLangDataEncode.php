<?php

namespace App\Action;

use App\Models\Lang;

class HandelMultiLangDataEncode
{
    public static function handel($columns, $multiLangColumns)
    {
        $langs = Lang::query()->pluck('prefix');
        foreach ($multiLangColumns as $col) {
            $column = [];
            foreach ($langs as $lang){
                $column[$lang] = $columns[$lang . '_' . $col];
                unset($columns[$lang . '_' . $col]);
            }
            $columns[$col] = json_encode($column, JSON_UNESCAPED_UNICODE);
        }
        return $columns;
    }
}
