<?php

namespace App\Http\Controllers;

use App\Action\Promoter\DeletePromoter;
use App\Action\Promoter\DisablePromoter;
use App\Action\Promoter\FetchAllPromoter;
use App\Action\Promoter\FetchSinglePromoter;
use App\Http\Resources\PromoterCollection;
use App\Http\Resources\PromoterResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PromoterController extends Controller
{
    use ApiResponse;

    public function index(FetchAllPromoter $action){
        if($promoter = $action->execute()){
            return $this->success(new PromoterCollection($promoter), 'All Promoters');
        }

        return $this->error('No Promoters Found');
    }

    public function show($id, FetchSinglePromoter $action){
        if($promoter = $action->execute($id)){
            return $this->success(new PromoterResource($promoter), 'Single Promoters');
        }

        return $this->error('Promoter Not Found');
    }

    public function destroy($id, DeletePromoter $action){
        if($action->execute($id)){
            return $this->success([], 'Promoter Deleted');
        }

        return $this->error('Promoter Not Found');
    }

    public function disable($id, DisablePromoter $action){
        if($action->execute($id)){
            return $this->success([], 'Promoter Status Updated');
        }

        return $this->error('Promoter Not Found');
    }
}
