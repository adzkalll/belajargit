<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoriumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'laboratorium_category_id' => $this->whenLoaded('lab_category'),
            'user_id' => $this->whenLoaded('userId'),
            'name' => $this->name,
            'description' => $this->description,
            'head_of_lab' => $this->head_of_lab,
            'start_operasional_hour' => $this->start_operasional_hour,
            'end_operasional_hour' => $this->end_operasional_hour,
        ];
    }
}
