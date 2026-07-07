<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'nik'        => $this->nik,
            'no_hp'      => $this->no_hp,
            'alamat'     => $this->alamat,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}