<?php

namespace App\Listeners;

use App\Action\SaveImage;
use App\Action\UploadeImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveImagesListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        foreach ($event->images as $image){
            $file_path = UploadeImage::uploade($image, $event->folder);
            SaveImage::save($event->id, $event->model, $file_path);
        }
    }
}
