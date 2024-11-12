<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->create(['name' => 'User']);
        Role::query()->create(['name' => 'Editor']);
        Role::query()->create(['name' => 'Admin']);
    }
}
