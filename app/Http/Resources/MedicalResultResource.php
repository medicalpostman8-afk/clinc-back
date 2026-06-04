<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'result_date' => $this->result_date?->format('Y-m-d'),
            'files' => $this->getMedia('files')->map(fn($file) => [
                'id' => $file->id,
                'name' => $file->file_name,
                'url' => $file->getUrl() ? url($file->getUrl()) : null,
            ]),
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
