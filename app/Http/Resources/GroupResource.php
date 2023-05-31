<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=> $this->title,
            'students' => StudentResource::collection($this->whenLoaded('students')),
            'lectures' => LectureResource::collection($this->whenLoaded('lectures')),
        ];
    }
}
