<?php

namespace App\Http\Controllers;

use App\Models\InvitationGuest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $selectedRsvpStatus = $request->query('rsvp');
        $selectedRsvpStatus = in_array($selectedRsvpStatus, ['attending', 'declined'], true)
            ? $selectedRsvpStatus
            : null;

        return view('dashboard', [
            'guestCount' => number_format(InvitationGuest::query()->count(), 0, ',', '.'),
            'attendingGuestCount' => number_format(InvitationGuest::query()->where('rsvp_status', 'attending')->count(), 0, ',', '.'),
            'declinedGuestCount' => number_format(InvitationGuest::query()->where('rsvp_status', 'declined')->count(), 0, ',', '.'),
            'selectedRsvpStatus' => $selectedRsvpStatus,
            'selectedGuests' => $selectedRsvpStatus === null
                ? collect()
                : InvitationGuest::query()
                    ->select(['id', 'name', 'phone', 'rsvp_status'])
                    ->where('rsvp_status', $selectedRsvpStatus)
                    ->orderBy('name')
                    ->get(),
        ]);
    }
}
