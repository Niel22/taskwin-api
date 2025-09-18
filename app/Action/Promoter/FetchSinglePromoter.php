<?php

namespace App\Action\Promoter;

use App\Models\User;

class FetchSinglePromoter{

    public function execute($id){
        $promoter = User::find($id);

        if(!empty($promoter)){
            return $promoter;
        }

        return false;
    }
}