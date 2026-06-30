<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'pasien_id'       => $this->pasien_id,
            'klinik_id'       => $this->klinik_id,
            'klinik'          => $this->whenLoaded('klinik', fn () => $this->klinik->nama),
            'poli_id'         => $this->poli_id,
            'poli'            => $this->whenLoaded('poli', fn () => $this->poli?->nama),
            'pendaftaran_id'  => $this->pendaftaran_id,
            'tipe'            => $this->tipe,
            'rating_kepuasan' => $this->rating . ' Bintang',
            'ulasan'          => $this->komentar,
            'tanggal_survei'  => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
