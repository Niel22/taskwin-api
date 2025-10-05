<?php

namespace App\Action\Dashboard;

use App\Enums\RoleEnum;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardSummary{

    public function execute(): array
    {
        $user = Auth::user();
        $query = Referral::query();

        if (!$user->isAdmin()) {
            $query->where('promoter_id', $user->id);
        }

        $total = $query->count();
        $completed = $query->whereNotNull('promoter_id')->where('completed', true)->count();
        $conversionRate = $total > 0 ? round(($completed / $total) * 100, 2) : 0;
        $totalPayouts = $completed * 10;

        $summary = [
            'total' => $total,
            'completed' => $completed,
            'conversionRate' => number_format($conversionRate, 2),
            'totalEarnings' => $totalPayouts,
        ];

        return $user->isAdmin() ? $this->adminStats($summary) : $summary;
    }

    private function adminStats(array $summary): array
    {
        $promoters = User::where('role', (RoleEnum::PROMOTER)->value)->get();

        $totalPromoters = $promoters->count();
        $activePromoters = $promoters->where('active', true)->count();

        $totalPayouts = $summary['completed'] * 10;

        $summary['total_promoters'] = $totalPromoters;
        $summary['active_promoters'] = $activePromoters;
        $summary['total_payouts'] = $totalPayouts;
        $summary['avg_earnings'] = $activePromoters > 0
            ? round($totalPayouts / $activePromoters, 2)
            : 0;

        return $summary;
    }
}