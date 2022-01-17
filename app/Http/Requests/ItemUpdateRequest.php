<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required','integer', 'min:0'],
            'category_id' => ['required','exists:categories,id'],
            'stock' =>['required','integer', 'min:0'],
        ];
    }
    
    public function attributes(){
        return [
            'name' => '商品名',
        ];
    }
}
