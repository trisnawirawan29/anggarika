<?php

namespace App\Http\Controllers;

use App\Models\InvitationGuest;
use App\Models\Setting;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminInvitationGuestController extends Controller
{
    public function index(): View
    {
        $messageTemplate = (string) Setting::query()->where('key', 'landing_guest_message_template')->value('value');
        $messageTemplate = $messageTemplate !== '' ? $messageTemplate : "Halo {{nama}},\n\nKami mengundang Anda untuk hadir di acara pernikahan kami.\n\nBuka undangan: {{link}}";
        $guestSettings = ['landing_guest_message_template' => $messageTemplate];
        $guests = InvitationGuest::query()
            ->when(request('search'), fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->latest()
            ->get()
            ->map(function (InvitationGuest $guest) use ($messageTemplate): InvitationGuest {
                $invitationUrl = route('invitation', $guest);
                $invitationMessage = str_replace(
                    ['{{nama}}', '{{link}}'],
                    [$guest->name, $invitationUrl],
                    $messageTemplate,
                );

                if (! str_contains($messageTemplate, '{{link}}')) {
                    $invitationMessage .= "\n\n".$invitationUrl;
                }

                $guest->setAttribute('invitation_url', $invitationUrl);
                $guest->setAttribute('invitation_message', $invitationMessage);

                return $guest;
            });

        return view('admin.invitation-guests.index', compact('guests', 'guestSettings'));
    }

    public function create(): View
    {
        return view('admin.invitation-guests.form', [
            'guest' => new InvitationGuest(['is_active' => true]),
            'pageTitle' => 'Tambah Tamu Undangan',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $guest = InvitationGuest::create($this->validatedData($request));
        AuditLogger::record('invitation_guest.created', "Tamu {$guest->name} ditambahkan.", $guest, [], $guest->only(['name', 'phone', 'is_active']));

        return redirect()->route('admin.invitation-guests.index')->with('success', 'Tamu undangan berhasil ditambahkan.');
    }

    public function edit(InvitationGuest $invitationGuest): View
    {
        return view('admin.invitation-guests.form', [
            'guest' => $invitationGuest,
            'pageTitle' => 'Edit Tamu Undangan',
        ]);
    }

    public function update(Request $request, InvitationGuest $invitationGuest): RedirectResponse
    {
        $data = $this->validatedData($request);
        $invitationGuest->update($data);
        AuditLogger::record('invitation_guest.updated', "Tamu {$invitationGuest->name} diperbarui.", $invitationGuest, $invitationGuest->getOriginal(), $invitationGuest->only(['name', 'phone', 'is_active']));

        return redirect()->route('admin.invitation-guests.index')->with('success', 'Data tamu undangan berhasil diperbarui.');
    }

    public function destroy(InvitationGuest $invitationGuest): RedirectResponse
    {
        $name = $invitationGuest->name;
        $invitationGuest->delete();
        AuditLogger::record('invitation_guest.deleted', "Tamu {$name} dihapus.", null, ['name' => $name]);

        return back()->with('success', 'Tamu undangan berhasil dihapus.');
    }

    /** @return array<string, mixed> */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama tamu wajib diisi.',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
