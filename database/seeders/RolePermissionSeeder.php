<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::create([
            'name' => 'admin'
        ]);
        
        $pengawasRole = Role::create([
            'name' => 'user'
        ]);

        $user = User::create([
            'name' => 'Abdu',
            'email' => 'abdu@admin.com',
            'password' => bcrypt('123123123')
        ]);

        $user->assignRole($adminRole);
    }
}
