<?php

namespace App\Events;

use App\Action\DeleteFileFromPublicAction;
use App\Action\DeleteImage;
use App\Models\Image;
use App\Models\Store;
use App\Repositories\StoreRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaveStoreEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     */
    public function __construct($storesRepo ,$data)
    {
        $logo = $data['logo'];
        $id = $data['id'] ?? null;
        unset($data['logo']);
        unset($data['id']);
        $data['manager_id'] = auth()->user()->id;
        $store = $storesRepo->updateOrCreate($id, $data);
        $this->images = [$logo];
        //in case of update remove old image if there new one
        if($id){
            if($logo){
                $this->images = [$logo];
                DeleteImage::delete($store->logo);
            }else{
                $this->images = [];
            }
        }
        $this->model = 'Store';
        $this->folder = 'stores';
        $this->id = $store->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
