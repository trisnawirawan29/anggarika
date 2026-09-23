<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = [
            ['name' => 'Superadmin', 'slug' => 'superadmin', 'description' => 'Mengatur seluruh aplikasi, role, dan izin menu.', 'is_system' => true],
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Mengelola operasional sesuai izin yang diberikan.', 'is_system' => true],
            ['name' => 'User', 'slug' => 'user', 'description' => 'Akses dasar aplikasi.', 'is_system' => true],
        ];
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['slug' => $role['slug']], $role + ['created_at' => now(), 'updated_at' => now()]);
        }

        $menus = [
            ['name' => 'Dashboard', 'slug' => 'dashboard', 'route_name' => 'dashboard', 'icon' => 'fas fa-chart-pie', 'group_name' => 'Menu Utama', 'sort_order' => 10],
            ['name' => 'Notifikasi', 'slug' => 'notifications', 'route_name' => 'notifications', 'icon' => 'far fa-bell', 'group_name' => 'Menu Utama', 'sort_order' => 20],
            ['name' => 'Manajemen Pengguna', 'slug' => 'admin.users', 'route_name' => 'admin.users', 'icon' => 'fas fa-users-cog', 'group_name' => 'Administrasi', 'sort_order' => 30],
            ['name' => 'Pengaturan Aplikasi', 'slug' => 'admin.settings', 'route_name' => 'admin.settings', 'icon' => 'fas fa-sliders', 'group_name' => 'Administrasi', 'sort_order' => 40],
            ['name' => 'Audit Log', 'slug' => 'admin.audit-logs', 'route_name' => 'admin.audit-logs', 'icon' => 'fas fa-clock-rotate-left', 'group_name' => 'Administrasi', 'sort_order' => 50],
            ['name' => 'Profil Pengguna', 'slug' => 'profile', 'route_name' => 'profile', 'icon' => 'fas fa-user', 'group_name' => 'Akun Saya', 'sort_order' => 60],
        ];
        foreach ($menus as $menu) {
            DB::table('menus')->updateOrInsert(['slug' => $menu['slug']], $menu + ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        }

        $superadminId = DB::table('roles')->where('slug', 'superadmin')->value('id');
        $adminId = DB::table('roles')->where('slug', 'admin')->value('id');
        $allMenuIds = DB::table('menus')->pluck('id');
        DB::table('role_menu')->where('role_id', $superadminId)->delete();
        DB::table('role_menu')->insert($allMenuIds->map(fn ($menuId) => ['role_id' => $superadminId, 'menu_id' => $menuId])->all());
        DB::table('role_menu')->where('role_id', $adminId)->delete();
        DB::table('role_menu')->insert(DB::table('menus')->whereIn('slug', ['dashboard', 'notifications', 'profile'])->get()->map(fn ($menu) => ['role_id' => $adminId, 'menu_id' => $menu->id])->all());
        foreach (['user'] as $basicRole) {
            $roleId = DB::table('roles')->where('slug', $basicRole)->value('id');
            DB::table('role_menu')->insert(DB::table('menus')->whereIn('slug', ['dashboard', 'notifications', 'profile'])->get()->map(fn ($menu) => ['role_id' => $roleId, 'menu_id' => $menu->id])->all());
        }

        DB::table('users')->where('role', 'admin')->update(['role' => 'superadmin', 'role_id' => $superadminId]);
        DB::table('users')->whereNull('role_id')->eachById(function ($user) {
            $roleId = DB::table('roles')->where('slug', $user->role ?: 'user')->value('id');
            DB::table('users')->where('id', $user->id)->update(['role_id' => $roleId]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('role_menu')->truncate();
        DB::table('menus')->truncate();
        DB::table('roles')->truncate();
    }
};
