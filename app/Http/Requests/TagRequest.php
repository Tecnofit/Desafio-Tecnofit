<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'id_user' => 'required', 
            'nome' => 'required',
            'language' => 'required',
            'image' => 'required'
        ];
    }

    public function messages() {
        return [
            'id_user.required' => 'Você deve escolher um usuário',
            'nome.required' => 'Você deve preencher um Filme',
            'language.required' => 'Você deve preencher uma linguagem',
            'image.required' => 'Você deve preencher o link',
        ];
    }
}
