<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $userRole = Role::query()->where('name', 'User')->first();
        $users = User::factory(10)
            ->create()
            ->each(function ($user) use ($userRole) {
            $user->roles()->attach($userRole);
        });
        $products = Product::factory(1000)->create();
        $orders = Order::factory(1000)->recycle($users)
            ->has(OrderItem::factory(4)->recycle($products))
            ->create();
    }
}
