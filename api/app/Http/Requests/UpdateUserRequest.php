<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id,'id')],
            //'password' => 'required',
            'role_id' => 'required|numeric|min:1|exists:roles,id',
            'persona_id' => 'required|numeric|min:1|exists:personas,id',
            'colegio_id' => 'required|numeric|min:1|exists:colegios,id',
            'actividad' => 'required|boolean',
        ];
    }
}
