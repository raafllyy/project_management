<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role sudah ada
        $roles = ['Admin', 'Project Manager', 'Member'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Buat user Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password')
            ]
        );
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }

        // Buat user Project Manager
        $pm = User::firstOrCreate(
            ['email' => 'pm@example.com'],
            [
                'name' => 'PM',
                'password' => Hash::make('password')
            ]
        );
        if (!$pm->hasRole('Project Manager')) {
            $pm->assignRole('Project Manager');
        }

        // Buat Member default 1
        $member1 = User::firstOrCreate(
            ['email' => 'member@example.com'],
            [
                'name' => 'Member 1',
                'password' => Hash::make('password')
            ]
        );
        if (!$member1->hasRole('Member')) {
            $member1->assignRole('Member');
        }

        // Buat Member tambahan 2
        $member2 = User::firstOrCreate(
            ['email' => 'member2@example.com'],
            [
                'name' => 'Member 2',
                'password' => Hash::make('password')
            ]
        );
        if (!$member2->hasRole('Member')) {
            $member2->assignRole('Member');
        }

        // Buat Member tambahan 3
        $member3 = User::firstOrCreate(
            ['email' => 'member3@example.com'],
            [
                'name' => 'Member 3',
                'password' => Hash::make('password')
            ]
        );
        if (!$member3->hasRole('Member')) {
            $member3->assignRole('Member');
        }
    }
}
