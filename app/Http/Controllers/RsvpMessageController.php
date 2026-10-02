<?php

namespace App\Http\Controllers;

use App\Models\RsvpMessage;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RsvpMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:1000'],
            'captcha_answer' => [
                'required',
                'integer',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if ((int) $value !== (int) session('rsvp_captcha_answer', -1)) {
                        $fail('Jawaban CAPTCHA salah.');
                    }
                },
            ],
        ]);

        RsvpMessage::query()->create([
            'name' => $data['name'],
            'message' => $data['message'],
        ]);

        return back()->with('rsvp_success', 'Terima kasih, ucapan Anda sudah tersimpan.')->withFragment('rsvp');
    }

    public function destroy(RsvpMessage $rsvpMessage): RedirectResponse
    {
        $rsvpMessage->delete();
        AuditLogger::record('rsvp_message.deleted', 'Ucapan RSVP dihapus.', $rsvpMessage);

        return back()->with('success', 'Ucapan berhasil dihapus.');
    }
}
