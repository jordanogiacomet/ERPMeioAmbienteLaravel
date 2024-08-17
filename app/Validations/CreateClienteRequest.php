<?php

use Illuminate\Foundation\Http\FormRequest;

class CreateClienteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }
}