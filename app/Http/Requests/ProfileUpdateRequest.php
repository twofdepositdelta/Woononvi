<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // Permet de vérifier si l'utilisateur est autorisé à effectuer cette requête.
        // Dans ce cas, on retourne toujours vrai pour permettre à tout utilisateur authentifié de modifier son profil.
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $this->user()->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $this->user()->id,
            'gender' => 'nullable|string|in:male,female',
            'date_of_birth' => 'nullable|date',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le prénom est obligatoire.',
            'lastname.required' => 'Le nom de famille est obligatoire.',
            'username.required' => "Le nom d'utilisateur est obligatoire.",
            'username.unique' => "Ce nom d'utilisateur est déjà pris.",
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'address.required' => "L'adresse est obligatoire.",
        ];
    }
}