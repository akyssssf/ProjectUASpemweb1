<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntrianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pendaftaran_id'  => 'required|exists:pendaftarans,id',
            'nomor_antrian'   => 'required|string|max:20',
            'poli'            => 'required|string|max:255',
            'tanggal_antrian' => 'required|date',
            'status'          => 'required|in:menunggu,dipanggil,selesai',
        ];
    }
}