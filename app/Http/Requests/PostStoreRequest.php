<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //return [
        $rules = [    
            'name' => 'required',
            'slug' => 'required|unique:posts,slug', 
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'tags' => 'required|array', //las etiquetas son requeridas como array
            'body' => 'required',
            'status' => 'required|in:DRAFT,PUBLISHED'
        ];

        //imagen del articulo opcional. Si se selecciona imagen lo agrego al array $rules
        if ($this->get('file'))
            $rules = array_merge($rules, ['file'=>'mimes:jpg,jpeg,png']);

        return $rules;    
    }
}
