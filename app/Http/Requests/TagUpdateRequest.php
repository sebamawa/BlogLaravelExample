<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            //$this->tag indica que evalue todos los registros menos el actual. Esto permite que
            //se permita actualizar tags sin modificar sus tags en el campo de texto, pero si se quiere crear un tag
            //con un slug existente no se permita (ver que en TagStoreRequest.php no se coloca $this->tag)
            'slug' => 'required|unique:tags,slug,' . $this->tag, 
        ];
    }
}
