<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreSurveiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jadi true agar diizinkan
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5', // Rating dibatasi 1-5
            'komentar' => 'nullable|string'
        ];
    }
}   