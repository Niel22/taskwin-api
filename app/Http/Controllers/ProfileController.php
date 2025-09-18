<?php

namespace App\Http\Controllers;

use App\Action\Profile\ChangePassword;
use App\Action\Profile\UpdateProfile;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponse;

    public function update(UpdateProfileRequest $request, UpdateProfile $action){
        if($action->execute($request->all())){
            return $this->success([], 'Profile Updated');
        }

        return $this->error('Problem Updating Profile');
    }

    public function changePassword(UpdatePasswordRequest $request, ChangePassword $action){
        if($action->execute($request->all())){
            return $this->success([], 'Passwor Updated');
        }

        return $this->error('Invalid Password');
    }
}
