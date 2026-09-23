<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('menus')->updateOrInsert(
            ['slug' => 'admin.landing-settings'],
            [
                'name' => 'Pengaturan Landing Page',
                'route_name' => 'admin.landing-settings',
                'icon' => 'fas fa-images',
                'group_name' => 'Menu Utama',
                'sort_order' => 25,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        $menuId = DB::table('menus')->where('slug', 'admin.landing-settings')->value('id');
        $roleIds = DB::table('roles')->whereIn('slug', ['superadmin', 'admin'])->pluck('id');

        foreach ($roleIds as $roleId) {
            DB::table('role_menu')->updateOrInsert(['role_id' => $roleId, 'menu_id' => $menuId]);
        }
    }

    public function down(): void
    {
        $menuId = DB::table('menus')->where('slug', 'admin.landing-settings')->value('id');
        if ($menuId) {
            DB::table('role_menu')->where('menu_id', $menuId)->delete();
            DB::table('menus')->where('id', $menuId)->delete();
        }
    }
};
