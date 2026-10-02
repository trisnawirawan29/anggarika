<?php

namespace App\Http\Controllers;

use App\Models\InvitationGuest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvitationGuestRsvpController extends Controller
{
    public function update(Request $request, InvitationGuest $guest): JsonResponse
    {
        abort_if(! $guest->is_active, 404);

        $data = $request->validate([
            'status' => ['required', Rule::in(['attending', 'declined'])],
        ]);

        $guest->update(['rsvp_status' => $data['status']]);

        return response()->json([
            'status' => $guest->rsvp_status,
            'message' => $guest->rsvp_status === 'attending'
                ? 'Terima kasih, kehadiran Anda sudah dikonfirmasi.'
                : 'Baik, kami sudah mencatat bahwa Anda belum dapat hadir.',
        ]);
    }
}
