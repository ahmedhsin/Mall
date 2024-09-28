<?php

namespace App\Http\Requests;

use App\Action\HandleMultiLangRules;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
        if(str_contains($this->path(), 'update')){
        }
        $columns = [
            'name' => "required|string|max:255",
            'brand' => "required|string|max:255",
            'price' => "required|numeric|regex:/^\d+(\.\d{1,10})?$/",
            'stock' => "required|integer",
            'status' => "nullable|in:active,inactive",
            'sku' => "required|unique:products,sku",
            'weight' => "required|numeric|regex:/^\d+(\.\d{1,10})?$/",
            'dimensions' => "required|string|max:255",
            'featured' => "nullable|boolean",
            'description' => "nullable|string|max:1000|min:30",
            'images' => 'required|array',
            'images.*' => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'categories' => "required|array",
            'categories.*' => "exists:categories,id"
        ];

        return HandleMultiLangRules::handel($columns, Product::$multiLangColumns);
    }
}
