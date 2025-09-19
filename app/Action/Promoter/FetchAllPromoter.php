<?php

namespace App\Action\Promoter;

use App\Enums\RoleEnum;
use App\Models\User;

class FetchAllPromoter{

    public function execute(){
        $promoters = User::withCount(['clicks', 'completed'])->where('role', (RoleEnum::PROMOTER)->value)->paginate(10);

        if($promoters->isNotEmpty()){
            return $promoters;
        }

        return false;
    }
}