<?php

namespace App\Http\Controllers;

use App\Action\Auth\Login;
use App\Action\Auth\Register;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function create(RegisterRequest $request, Register $action){
        if($action->execute($request->all())){
            return $this->success([], "User Registered Successfully");
        }

        return $this->error('Problem occured');
    }

    public function store(LoginRequest $request, Login $action){
        if($user = $action->execute($request)){
            return $this->success($user, "User Logged in Successfully");
        }

        return $this->error('Invalid Email Or Password');
    }
}
