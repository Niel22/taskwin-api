<?php

namespace App\Http\Controllers;

use App\Action\Dashboard\DashboardSummary;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index(DashboardSummary $action){
        if($data = $action->execute()){
            return $this->success($data, 'Dashboard Summary');
        }

        return $this->success([], 'Problem Occured');
    }
}
