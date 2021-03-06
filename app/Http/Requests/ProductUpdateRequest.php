<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $rules = [
            'name'       => 'required|min:3',
            'slug'       => 'required|unique:products,slug,' . $this->product->id,
            'user_id'    => 'required|integer',
            'category_id'=> 'required|integer',
            'tags'       => 'required|array',
            'description'=>'required',
            'status'     => 'required|in:DRAFT,PUBLISHED',

        
        ];

        if($this->get('file'))
            $rules = array_merge($rules, ['file' => 'mimes:jpg,jpeg,png']);

            return $rules;
    }
}

