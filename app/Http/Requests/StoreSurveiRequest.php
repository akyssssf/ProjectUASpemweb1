<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreSurveiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pasien_id'      => 'nullable|exists:pasiens,id',
            'klinik_id'      => 'required|exists:kliniks,id',
            'poli_id'        => 'nullable|exists:polis,id',
            'pendaftaran_id' => 'nullable|exists:pendaftarans,id|unique:surveys,pendaftaran_id',
            'tipe'           => 'required|in:umum,spesifik',
            'rating'         => 'required|integer|min:1|max:5',
            'komentar'       => 'nullable|string',
        ];
    }
}
