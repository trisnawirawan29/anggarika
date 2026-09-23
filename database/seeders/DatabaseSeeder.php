<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superadminRole = Role::firstOrCreate(
            ['slug' => 'superadmin'],
            ['name' => 'Superadmin', 'description' => 'Mengatur seluruh aplikasi, role, dan izin menu.', 'is_system' => true],
        );
        $credentials = config('auth.initial_superadmin');
        $admin = User::firstOrNew(['email' => $credentials['email']]);
        $wasNew = ! $admin->exists;
        $admin->fill([
            'name' => $credentials['name'],
            'role' => 'superadmin',
            'role_id' => $superadminRole->id,
        ]);
        if ($wasNew) {
            $admin->password = $credentials['password'];
        }
        $admin->save();

        if ($wasNew) {
            $admin->notify(new SystemNotification('Selamat datang di NexaAdmin', 'Akun superadmin Anda siap digunakan.', 'success'));
            $admin->notify(new SystemNotification('Lengkapi profil Anda', 'Tambahkan avatar dan informasi pribadi agar profil lebih lengkap.', 'info'));
        }
    }
}
