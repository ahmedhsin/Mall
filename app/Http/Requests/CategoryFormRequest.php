<?php

namespace App\Http\Requests;

use App\Action\HandleMultiLangRules;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $store = Store::findOrFail($this->store_id);
        return auth()->user()->can('manage', $store);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $category_id = '';
        if(str_contains($this->path(), 'update')){
            $category_id = ','.Category::query()->where('id','=',$this->route('store'))->first()->id;
        }
        $columns = [
            'slug' => "required|string|min:3|unique:categories,slug".$category_id,
            'name'=>"required|string|max:255",
        ];
        return HandleMultiLangRules::handel($columns, Category::$multiLangColumns);
    }
}
