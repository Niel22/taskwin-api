<?php

namespace App\Action\Referral;

use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class FetchCompletedReferral{

    public function execute(){

        if(!Auth::user()->isAdmin()){
            $referrals = Referral::where('promoter_id', Auth::id())->where('completed', true)->latest()->paginate(10);

            if($referrals->isNotEmpty()){
                return $this->appendStats($referrals, Auth::id());
            }

            return false;
        }

        $referrals = Referral::with('promoter')->where('completed', true)->latest()->paginate(10);
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

        $totalCompletions = $query->where('completed', true)->count();
        $totalEarnings = $totalCompletions * 10;
        
        $thisMonth = (clone $query)
            ->where('completed', true)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $referrals->stats = [
            'total_completions' => $totalCompletions,
            'total_earnings' => number_format($totalEarnings, 2),
            'this_month' => $thisMonth,
        ];

        return $referrals;
    }
}