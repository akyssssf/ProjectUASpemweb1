<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntrianResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'pendaftaran_id'  => $this->pendaftaran_id,
            'nomor_antrian'   => $this->nomor_antrian,
            'poli'            => $this->poli,
            'tanggal_antrian' => $this->tanggal_antrian->format('Y-m-d'),
            'status'          => $this->status,
            'created_format'  => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}