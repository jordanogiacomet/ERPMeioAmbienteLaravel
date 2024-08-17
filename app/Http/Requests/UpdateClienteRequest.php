<?php

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }
}