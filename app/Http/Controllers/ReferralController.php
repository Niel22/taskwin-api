<?php

namespace App\Http\Controllers;

use App\Action\Referral\CreateReferral;
use App\Action\Referral\FetchAllReferral;
use App\Action\Referral\FetchCompletedReferral;
use App\Action\Referral\UpdateReferral;
use App\Http\Requests\CompleteTaskRequest;
use App\Http\Requests\CreateReferralRequest;
use App\Http\Resources\ReferralCollection;
use App\Http\Resources\ReferralResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    use ApiResponse;

    public function store($code, Request $request, CreateReferral $action){
        if($action->execute($code, $request)){
            return $this->success([], 'referral Created');
        }

        return $this->error('Promoter Does Not Exist');
    }

    public function update(CompleteTaskRequest $request, UpdateReferral $action){
        if($data = $action->execute($request)){
            return $this->success($data, 'Task Completed');
        }

        return $this->error('Problem Occured');
    }

    public function fetchAllClicks(FetchAllReferral $action){
        if($data = $action->execute()){
            return $this->success(new ReferralCollection($data), 'All Referrals');
        }

        return $this->success([], 'No Referrals Clicks Found');
    }

    public function fetchAllCompletions(FetchCompletedReferral $action){
        if($data = $action->execute()){
            return $this->success(new ReferralCollection($data), 'All Completed Referrals');
        }

        return $this->success([], 'No Referrals Completions Found');
    }
}
