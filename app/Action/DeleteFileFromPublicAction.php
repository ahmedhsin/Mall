<?php

namespace App\Action;

class DeleteFileFromPublicAction
{
    public static function delete($folder, $path)
    {
        $path_file = public_path($folder.'/'.$path);
        if (file_exists($path_file)) unlink($path_file);
    }
}
