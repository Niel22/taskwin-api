<?php

namespace App\Action\Auth;

use App\Models\User;

class Register {
    
    public function execute($request){

        $user = User::create($request);

        if($user){
            return true;
        }

        return false;

    }
}