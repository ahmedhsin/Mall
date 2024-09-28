<?php

namespace App\Action;

class UploadeImage
{
    public static function uploade($file,$folder_name){
            $name = time().rand(0,99999999999).'_image'.$file->getClientOriginalName();
            $file->move(public_path().'/images/'.$folder_name,$name);
            return $folder_name.'/'.$name;
    }
}
