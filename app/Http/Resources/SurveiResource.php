<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_pengguna' => $this->user_id,
            'rating_kepuasan' => $this->rating . ' Bintang',
            'ulasan' => $this->komentar,
            'tanggal_survei' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}