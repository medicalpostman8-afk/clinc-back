<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => [
                'ar' => $this->title['ar'] ?? null,
                'en' => $this->title['en'] ?? null,
            ],

            'description' => [
                'ar' => $this->description['ar'] ?? null,
                'en' => $this->description['en'] ?? null,
            ],
            'url' => $this->url,
            'image' => $this->getFirstMediaUrl('blogs') ?: null,
            'doctor' => [
                'id' => $this->doctor?->id,
                'name' => $this->doctor?->name,
            ],
            'status' => (bool) $this->status,
            'created_at' => $this->created_at?->toDateTimeString(),
            'created_at_human' => $this->created_at?->diffForHumans(),
        ];
    }
}
