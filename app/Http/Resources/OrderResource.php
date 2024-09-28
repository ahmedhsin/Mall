<?php

namespace App\Http\Resources;

use App\Action\HandelMultiLangDecode;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        if (isset($data['products'])){
            $data['products'] = $this->whenLoaded('products');
            foreach ($data['products'] as $index=>$value)
            $data['products'][$index] = HandelMultiLangDecode::handel($value, Product::$multiLangColumns, app()->getLocale());
        }

        return $data;
    }
}
