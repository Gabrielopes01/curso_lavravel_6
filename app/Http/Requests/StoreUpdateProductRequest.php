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

        $id = $this->segment(2);   //Pega o ID da URL

        return [
            'name' => "required|min:3|max:250|unique:products,name,{$id},id",   //unique:tabela_excessao,coluna_do_where,valor_externo,valor_interno_comparacao
            'description' => 'required|min:3|max:10000',
            'price' => 'required|numeric',  
            'photo' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.min' => 'Nome precisa de no mínimo 3 caracteres',
            'name.max' => 'Limite de 250 caracteres excedido em Nome',
            'name.unique' => 'Este nome ja foi selecionado, favor escolher outro',
            'description.required' => 'Você precisa adicionar uma descrição ao produto',
            'photo.image' => 'O arquivo deve ser uma imagem',
            'price.numeric'=>'O Valor de Preço precisa ser um número',
            'price.required'=> 'É necessário preencher o campo preço'
        ];
    }
}
