<?php

namespace App\Http\Controllers;

use App\Models\InvitationGuest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'guestCount' => number_format(InvitationGuest::query()->count(), 0, ',', '.'),
        ]);
    }
}
