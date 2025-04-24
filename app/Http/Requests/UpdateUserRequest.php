<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($user)
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users,'.$user->id,
            'phone'     => 'required|string|max:20|unique:users,'.$user->id,
            'gender'    => 'nullable|string',
            'npi'       => 'required|string|max:50|unique:users,'.$user->id,
            'city'      => 'required|exists:cities,id',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le prénom est obligatoire.',
            'lastname.required'  => 'Le nom est obligatoire.',
            'email.required'     => 'L\'adresse e-mail est obligatoire.',
            'email.unique'       => 'Cette adresse e-mail est déjà utilisée.',
            'phone.required'     => 'Le numéro de téléphone est obligatoire.',
            'phone.unique'       => 'Ce numéro de téléphone est déjà utilisé.',
            'npi.required'       => 'Le NPI est obligatoire.',
            'npi.unique'         => 'Ce NPI est déjà utilisé.',
        ];
    }
}
