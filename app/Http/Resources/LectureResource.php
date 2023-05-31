<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\TextUI\Configuration\GroupCollection;

class LectureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'topic'=> $this->topic,
            'description' => $this->description,
            'groups' => GroupResource::collection($this->whenLoaded('groups')),
        ];
    }
}
