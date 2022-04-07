<?php

namespace App\Http\Requests\Staff;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
            'phone' => ['nullable', 'string', 'max:250'],

            'role' => ['required', 'string', 'max:30', Rule::in(['normal', 'gold', 'silver'])],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trebuie sa introduceti un nume al user-ului',
            'name.max' => 'Numele introds poate avea maximum 150 de caractere',
            'name.string' => 'Numele introds trebuie sa fie de tip text',



            'role.required' => 'Trebuie sa introduceti un rol pentru noul utilizator',
            'role.max' => 'Rolul nu poate avea mai mult de 30 de caractere',
            'role.in' => 'Acest rol nu este disponibil in baza de date',

            'phone.max' => 'Numarul de telefon nu poate avea mai multe de 250 de caractere',


        ];
    }
}
