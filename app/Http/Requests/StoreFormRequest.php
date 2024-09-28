<?php

namespace App\Http\Requests;

use App\Action\HandleMultiLangRules;
use App\Action\HandleUpdateRules;
use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $store_id = '';
        $logoRule = "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048";
        if(str_contains($this->path(), 'update')){
            $store_id = ','.Store::query()->where('id','=',$this->route('store'))->first()->id;
            $logoRule = str_replace('required', 'nullable', $logoRule);
        }
        $columns = [
            'slug' => "required|string|min:3|unique:stores,slug".$store_id,
            'phone' => "required|min:4|max:20|unique:stores,phone".$store_id,
            'email' => "required|email|max:255|unique:stores,email".$store_id,
            'name'=>"required|string|max:255",
            'description'=>"nullable|string|max:1000|min:30",
            'address'=>"nullable|string|max:1000|min:30",
            'logo' => $logoRule,
        ];
        return HandleMultiLangRules::handel($columns, Store::$multiLangColumns);
    }
}
