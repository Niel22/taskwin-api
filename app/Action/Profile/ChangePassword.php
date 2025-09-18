<?php

namespace App\Action\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChangePassword{

    public function execute($request){
        $user = User::find(Auth::id());

        if(!empty($user) && password_verify($request['password'], $user->password)){
            return $user->update([
                'password' => $request['new_password']
            ]);
        }

        return false;
    }
}