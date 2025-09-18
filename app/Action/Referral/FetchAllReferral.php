<?php

namespace App\Action\Referral;

use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class FetchAllReferral{

    public function execute(){

        if(!Auth::user()->isAdmin()){
            $referral = Referral::where('promoter_id', Auth::id())->latest()->paginate(10);

            if($referral->isNotEmpty()){
                return $referral;
            }

            return false;
        }

        $referral = Referral::with('promoter')->latest()->paginate(10);
        if($referral->isNotEmpty()){
            return $referral;
        }

        return false;
    }
}