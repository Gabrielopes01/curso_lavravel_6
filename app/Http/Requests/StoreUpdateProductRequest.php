<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
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
            'name' => 'required|min:3|max:250',  
            'description' => 'nullable|min:3|max:10000',  
            'photo' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.min' => 'Nome precisa de no mínimo 3 caracteres',
            'name.max' => 'Limite de 250 caracteres excedido em Nome',
            'photo.required' => 'Você precisa selecionar uma imagem',
            'photo.image' => 'O arquivo deve ser uma imagem'
        ];
    }
}
