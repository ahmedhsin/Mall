<?php

namespace App\Http\Resources;

use App\Action\HandelMultiLangDecode;
use App\Models\Image;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['logo'] = $data['logo']['name'];
        unset($data['manager_id']);
        return HandelMultiLangDecode::handel($data, Store::$multiLangColumns, app()->getLocale());
    }
}
