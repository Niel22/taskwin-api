<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoterResource extends JsonResource
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
            'email' => $this->email,
            'active' => $this->active ? 'Active' : "Unactive",
            'role' => $this->role,
            'clicks' => $this->clicks->count(),
            'completed' => $this->completed->count(),
            'referral_code' => $this->referral_code,
            'created_at' => $this->created_at->format("D M d, Y | h:i A"),
        ];
    }
}
