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
        $userRoleId = DB::table('roles')->where('slug', 'user')->value('id');
        $allowedRoleIds = DB::table('roles')->whereIn('slug', ['superadmin', 'admin', 'user'])->pluck('id');
        DB::table('users')->whereNotIn('role', ['superadmin', 'admin', 'user'])->update(['role' => 'user', 'role_id' => $userRoleId]);
        DB::table('users')->whereNotIn('role_id', $allowedRoleIds)->update(['role' => 'user', 'role_id' => $userRoleId]);
        DB::table('role_menu')->whereNotIn('role_id', $allowedRoleIds)->delete();
        DB::table('roles')->whereNotIn('slug', ['superadmin', 'admin', 'user'])->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Role tambahan yang sudah dihapus tidak dapat dipulihkan otomatis.
    }
};
