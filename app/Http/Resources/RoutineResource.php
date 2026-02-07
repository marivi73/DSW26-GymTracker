<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoutineResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'exercises' => $this->exercises->map(function ($exercise) {
                return [
                    'id' => $exercise->id,
                    'name' => $exercise->name,
                    'description' => $exercise->description,
                    
                    'sequence' => $exercise->pivot->sequence,
                    'target_sets' => $exercise->pivot->target_sets,
                    'target_reps' => $exercise->pivot->target_reps,
                    'rest_seconds' => $exercise->pivot->rest_seconds,
                    
                ];
            }),
        ];
    }
}
