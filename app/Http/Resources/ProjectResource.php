<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'client'     => $this->client,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
            'status'     => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'tasks'      => TaskResource::collection($this->whenLoaded('tasks')),
            'owner'      => new UserResource($this->whenLoaded('owner')),
        ];
    }
}
