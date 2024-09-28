<?php

namespace App\Http\Resources;

use App\Action\HandelMultiLangDecode;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['categories'] = CategoryResource::collection($this->whenLoaded('categories'));
        if (isset($data['images'])){
            $data['images'] = $this->whenLoaded('images');
        }
        $data['created_at'] = $this->created_at->format('Y-m-d H:i:s');
        return HandelMultiLangDecode::handel($data, Product::$multiLangColumns, app()->getLocale());
    }
}
