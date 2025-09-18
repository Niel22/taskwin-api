<?php

namespace App\Action\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login{

    public function execute($request){

        $user = User::whereEmail($request->email)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $token = $user->createToken($user->email);
                $user  = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'referral_code' => $user->referral_code,
                    'token' => $token->plainTextToken
                ];
                return $user;
            }
        }
        return false;
    }
}