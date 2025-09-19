<?php

namespace App\Action\Dashboard;

use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class DashboardSummary{

    public function execute(){
        $user = Auth::user();
        $query = Referral::query();

        if (!$user->isAdmin()) {
            $query->where('promoter_id', $$user->id);
        }

        $total = $query->count();
        $completed = $query->where('completed', true)->count();
        $conversionRate = $total > 0 ? round(($completed / $total) * 100, 2) : 0;
        $totalEarnings = $completed * 10;

        return [
            $total,
            $completed,
            number_format($conversionRate, 2),
            $totalEarnings
        ];
    }
}