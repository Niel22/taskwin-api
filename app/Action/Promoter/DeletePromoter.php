<?php

namespace App\Action\Promoter;

use App\Models\User;

class DeletePromoter{

    public function execute($id){
        $promoter = User::find($id);

        if(!empty($promoter)){
            return $promoter->delete();
        }

        return false;
    }
}