<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'diagnosis' => $this->diagnosis,
            'date' => $this->created_at->format('Y-m-d'),

            'analysis_files' => $this->getMedia('analysis')
                ->map(fn($file) => $file->getUrl()),

            'xray_files' => $this->getMedia('xray')
                ->map(fn($file) => $file->getUrl()),

            'prescriptions' => $this->prescriptions,
        ];
    }
}
