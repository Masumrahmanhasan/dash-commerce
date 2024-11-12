<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $editor = User::factory()->create([
            'name' => 'Test User',
            'email' => 'editor@example.com',
        ]);
        $userRole = Role::query()->where('name', 'User')->first();
        $adminRole = Role::query()->where('name', 'Admin')->first();
        $editorRole = Role::query()->where('name', 'Editor')->first();

        $user->roles()->attach($userRole);
        $admin->roles()->attach($adminRole);
        $editor->roles()->attach($editorRole);
    }
}
