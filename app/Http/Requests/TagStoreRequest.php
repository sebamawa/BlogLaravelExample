<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //autorizo validacion  //false;
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
            'slug' => 'required|unique:tags,slug', //verifico campo que sea obligatorio y que sea unico en la tabla tags de la bd
        ];
    }
}
