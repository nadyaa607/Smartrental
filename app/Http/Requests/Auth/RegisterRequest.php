<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_identitas' => ['required', 'string', 'max:50', 'unique:pelanggans,no_identitas'],
            'telepon' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_identitas.unique' => 'Nomor identitas ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah terdaftar.',
        ];
    }
}