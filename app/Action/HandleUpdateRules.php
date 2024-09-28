<?php

namespace App\Action;

class HandleUpdateRules
{
    public static function handle($request,$columns, $model, $ifNotExists)
    {
        $entity_name = explode('\\', $model)[2];
        $entity_name = strtolower($entity_name);
        $table_name = resolve($model)->getTable();
        $columns['id'] = "required|integer|exists:".$table_name.",id";
        $entity = $model::query()->where('id','=',$request->route($entity_name))->first();
        //items to be removed if its dosn't change like logo
        //item with same value as old removed
        foreach (array_keys($columns) as $col){
            if ($request->has($col) && $request->get($col) != null  && isset($entity[$col])){
                if($request->get($col) == $entity[$col]){
                    unset($columns[$col]);
                }
            }else{
                if(array_search($col, $ifNotExists)){
                    unset($columns[$col]);
                }
            }
        }
        dd(array_search('logo', $ifNotExists));
        dd($columns);
        return $columns;
    }
}
