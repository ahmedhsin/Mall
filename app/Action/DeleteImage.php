<?php

namespace App\Action;

class DeleteImage
{
    public static function delete($image){
        DeleteFileFromPublicAction::delete("images", $image->name);
        return $image->delete();
    }
}
