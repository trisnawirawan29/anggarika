<?php

namespace App\Http\Controllers;

use App\Models\InvitationGuest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'stats' => [
                ['label' => 'Total Tamu Undangan', 'value' => number_format(InvitationGuest::query()->count(), 0, ',', '.'), 'change' => number_format(InvitationGuest::query()->where('is_active', true)->count(), 0, ',', '.'), 'footnote' => 'link aktif', 'icon' => 'fas fa-envelope-open-text', 'color' => 'primary'],
                ['label' => 'Pendapatan Bulan Ini', 'value' => 'Rp 48,6 jt', 'change' => '+8.2%', 'icon' => 'fas fa-wallet', 'color' => 'success'],
                ['label' => 'Pesanan Baru', 'value' => '356', 'change' => '+5.7%', 'icon' => 'fas fa-shopping-bag', 'color' => 'warning'],
                ['label' => 'Tiket Terbuka', 'value' => '24', 'change' => '-3.1%', 'icon' => 'fas fa-headset', 'color' => 'danger'],
            ],
        ]);
    }
}
