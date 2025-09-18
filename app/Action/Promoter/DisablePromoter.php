<?php

namespace App\Action\Promoter;

use App\Models\User;

class DisablePromoter{

    public function execute($id){
        $promoter = User::find($id);

        if(!empty($promoter)){
            return $promoter->update([
                'active' => !$promoter->active
            ]);
        }

        return false;
    }
}