<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTrapActivityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier' => 'required|string',
            'is_open' => 'required|boolean',
            'battery' => 'required|string'
        ];
    }
}
