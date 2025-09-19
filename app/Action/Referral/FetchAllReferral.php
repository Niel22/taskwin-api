<?php

namespace App\Action\Referral;

use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class FetchAllReferral{

    public function execute(){

        if(!Auth::user()->isAdmin()){
            $referrals = Referral::where('promoter_id', Auth::id())->latest()->paginate(10);

            if($referrals->isNotEmpty()){
                return $this->appendStats($referrals, Auth::id());
            }

            return false;
        }

        $referrals = Referral::with('promoter')->latest()->paginate(10);
        if($referrals->isNotEmpty()){
            return $this->appendStats($referrals);
        }

        return false;
    }

    private function appendStats($referrals, $promoterId = null)
    {
        $query = Referral::query();

        if ($promoterId) {
            $query->where('promoter_id', $promoterId);
        }

        $total = $query->count();
        $completed = $query->where('completed', true)->count();
        $conversionRate = $total > 0 ? round(($completed / $total) * 100, 2) : 0;

        $referrals->stats = [
            'total_clicks' => $total,
            'completed' => $completed,
            'conversion_rate' => $conversionRate,
        ];

        return $referrals;
    }
}