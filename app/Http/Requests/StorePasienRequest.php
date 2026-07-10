<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePasienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Diizinkan, autentikasi sudah ditangani middleware auth:sanctum
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // ID pasien yang sedang diupdate, diambil dari parameter route {id}
        $pasienId = $this->route('id');

        return [
            'name'    => 'required|string|max:255',
            'email'   => [
                'required',
                'email',
                Rule::unique('pasiens', 'email')->ignore($pasienId),
            ],
            'nik'     => [
                'required',
                'string',
                'size:16',
                Rule::unique('pasiens', 'nik')->ignore($pasienId),
            ],
            'no_hp'   => 'nullable|string|max:20',
            'alamat'  => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom error messages (opsional, biar pesan galat lebih ramah).
     */
    public function messages(): array
    {
        return [
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'email.unique' => 'Email sudah terdaftar untuk pasien lain.',
            'nik.unique' => 'NIK sudah terdaftar untuk pasien lain.',
        ];
    }
}
