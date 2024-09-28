<?php

namespace App\Events;

use App\Action\DeleteImage;
use App\Repositories\CategoryRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaveProductEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($repo ,$data)
    {
        $id = $data['id'] ?? null;
        unset($data['id']);
        $data['user_id'] = auth()->user()->id;
        $product = $repo->updateOrCreate($id, $data);
        $categoryRepo = new CategoryRepository();
        $categoryRepo->addCategoriesToProduct($data['categories'], $product->id);
        $this->images = $data['images'];
        $this->model = 'Product';
        $this->folder = 'products';
        $this->id = $product->id;
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
