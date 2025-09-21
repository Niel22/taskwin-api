<?php

namespace App\Action\Referral;

use App\Models\Referral;
use App\Models\User;
use App\Services\GeoLocationService;
use Jenssegers\Agent\Agent;

class CreateReferral{

    public function  __construct(public GeoLocationService $geo, public Agent $agent)
    {
        
    }

    public function execute($code, $request){
        $promoter = User::where('referral_code', $code)->first();

        if($promoter){
            $ip = $request->ip();
            $fingerprint = $request->fingerprint;
            $userAgent = $this->agent;
            $location = $this->geo->getLocation($ip);

            if(!$fingerprint){
                return true;
            }

            if ($fingerprint && Referral::where('device_fingerprint', $fingerprint)->exists()) {
                return true;
            }

            if (Referral::where('ip_address', $ip)->exists()) {
                return true;
            }


            $referral = Referral::create([
                    'promoter_id' => $promoter->id,
                    'ip_address' => $ip,
                    'device_fingerprint' => $fingerprint,
                    'device' => $userAgent->browser() . '/' . $userAgent->platform(),
                    'location' => $location,
                    'completed' => false,
                ]);
            
            if($referral){
                return true;
            }
        }
        
        return false;
    
    }
}