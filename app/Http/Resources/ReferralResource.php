<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralResource extends JsonResource
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
            'promoter' => new PromoterResource($this->promoter),
            'location' => $this->location,
            'device_fingerprint' => $this->device_fingerprint,
            'ip_address' => $this->ip_address,
            'device' => $this->device,
            'name' => $this->name,
            'email' => $this->email,
            'country' => $this->country,
            'whatsapp' => $this->whatsapp,
            'age' => $this->age,
            'profession' => $this->profession,
            'gender' => $this->gender,
            'proof' => $this->proof,
            'telegram' => $this->telegram,
            'payment_code' => $this->payment_code,
            'completed' => $this->completed ? "completed" : "Clicked",
            'created_at' => $this->created_at->forat("D M d, Y | h:i A"),
        ];
    }
}
