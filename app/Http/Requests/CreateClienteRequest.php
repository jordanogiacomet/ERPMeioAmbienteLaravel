<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClienteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14',
            'endereco' => 'required|string|max:255',
            'contato' => 'required|string|max:255',
        ];
    }

    public function authorize()
    {
        // Retorne true se a autorização do request for sempre permitida.
        return true;
    }
}