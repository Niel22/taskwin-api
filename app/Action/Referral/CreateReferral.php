<?php

namespace App\Action\Referral;

use App\Models\Referral;
use App\Models\User;
use App\Services\GeoLocationService;

class CreateReferral{

    public function  __construct(public GeoLocationService $geo)
    {
        
    }

    public function execute($request){
        $promoter = User::where('referral_code', $request->referral_code)->first();

        if($promoter){
            $referral = Referral::firstOrCreate(
                ['ip_address' => $request->ip()],
                [
                    'promoter_id' => $promoter?->id,
                    'device' => $request->userAgent(),
                    'location' => $this->geo->getLocation($request->ip()),
                    'completed' => false,
                ]
            );
            
            if($referral){
                return true;
            }
        }
        
        return false;
        

    }
}