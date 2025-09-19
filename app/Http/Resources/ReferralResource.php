<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'proof' => Storage::url($this->proof),
            'telegram' => $this->telegram,
            'payment_code' => $this->payment_code,
            'completed' => $this->completed ? "completed" : "clicked",
            'created_at' => $this->created_at->format("D M d, Y | h:i A"),
            'updated_at' => $this->updated_at->format("D M d, Y | h:i A"),
        ];
    }
}
