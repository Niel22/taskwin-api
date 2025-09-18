<?php

namespace App\Action\Referral;

use App\Models\Referral;
use App\Services\GeoLocationService;
use Illuminate\Support\Str;

class UpdateReferral{
    public function  __construct(public GeoLocationService $geo)
    {
        
    }

    public function execute($request){
        $referral = Referral::where('ip_address', $request->ip())
            ->where('completed', false)
            ->latest()
            ->first();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'whatsapp' => $request->whatsapp,
            'age' => $request->age,
            'profession' => $request->profession,
            'gender' => $request->gender,
            'proof' => $request->proof,
            'telegram' => $request->telegram,
            'payment_code' => Str::random(8),
            'completed' => true,
        ];

        if($referral){
            $referral->update($data);
            return $referral->payment_code;
        }

        $data['promoter_id'] = null;
        $data['ip_address'] = $request->ip();
        $data['device'] = $request->userAgent();
        $data['location'] = $this->geo->getLocation($request->ip());

        $newReferral = Referral::create($data);

        if($newReferral){
            return $newReferral->payment_code;
        }

        return false;
    }
}