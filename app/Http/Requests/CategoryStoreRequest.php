<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
        return [
            //se usan campos (algunos o todos) del array fillable del modelo (Tag)
            'name' => 'required',
            'slug' => 'required|unique:categories,slug', //verifico campo que sea obligatorio y que sea unico en la tabla tags de la bd
        ];
    }
}
