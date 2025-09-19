<?php

namespace App\Action\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateProfile{

    public function execute($request){
        $user = User::find(Auth::id());

        if(!empty($user)){
            $user->update($request);
            return $user->fresh();
        }

        return false;
    }
}