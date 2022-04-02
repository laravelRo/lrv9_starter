<?php

namespace App\Http\Requests\Staff;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class AddMemberRequest extends FormRequest
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
            'name' => ['required', 'max:150', 'string'],
            'email' => ['required', 'email'],
            'role' => ['required', 'string', 'max:30', Rule::in(['supervisor', 'assistent', 'manager'])],
            'photo' => 'nullable|image|max:1024',
            'password' => ['required', 'confirmed', Password::min(8)->symbols()->mixedCase()]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trebuie sa introduceti un nume in baza de date',
            'name.max' => 'Numele introds poate avea maximum 150 de caractere',
            'name.string' => 'Numele introds trebuie sa fie de tip text',

            'email.required' => 'Trebuie sa introduceti o adresa de email valida',
            'email.email' => 'Trebuie sa introduceti o adresa de email valida',

            'role.required' => 'Trebuie sa introduceti un rol pentru noul utilizator',
            'role.max' => 'Rolul nu poate avea mai mult de 30 de caractere',
            'role.in' => 'Acest rol nu este disponibil in baza de date',

            'photo.max' => 'imaginea nu poate avea mai mult de 1 MB',

            'password.confirmed' => 'Nu ati confirmat corect parola'


        ];
    }
}
