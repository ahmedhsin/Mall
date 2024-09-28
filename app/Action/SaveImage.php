<?php

namespace App\Action;
use App\Models\Image;
class SaveImage
{
    public static function save($id, $model_name, $image_file)
    {
        Image::query()->create([
            'imageable_id' => $id,
            'imageable_type' => 'App\Models\\' . $model_name,
            'name' => $image_file,
        ]);
    }
}
