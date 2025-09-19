<?php

namespace App\Action\Referral;

use App\Models\Referral;

class DeleteReferral{

    public function execute($id){

        $referral = Referral::find($id);

        if(!empty($referral)){
            return $referral->delete();
        }

        return false;
    }
}