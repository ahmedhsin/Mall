<?php

namespace App\Http\Resources;

use App\Action\HandelMultiLangDecode;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return HandelMultiLangDecode::handel(parent::toArray($request), Category::$multiLangColumns, app()->getLocale());
    }
}
