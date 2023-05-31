<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\TextUI\Configuration\GroupCollection;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                "name" => $this->name,
                "email" => $this->email,
                "group" => GroupResource::make($this->whenLoaded('group')),
                "lectures" => LectureResource::make($this->whenLoaded('lectures'))
        ];
    }
}
