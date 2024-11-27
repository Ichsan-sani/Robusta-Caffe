<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Muhammad Ichsan Nursani',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Khoyum Masalik',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'kasir'
        ]);

        Product::create([
            'name' => 'Kopi Hitam',
            'description' => 'Kopi hitam pekat dengan aroma khas',
            'type' => 'Minuman',
            'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBhZxudbRGpnwGASvemp5l_wr6uy1l2RR0cQ&s',
            'price' => 12000,
            'stock' => rand(0, 50),
        ]);

        Product::create([
            'name' => 'Latte',
            'description' => 'Kopi susu lembut dengan foam di atasnya',
            'type' => 'Minuman',
            'img' => 'https://i.pinimg.com/control/564x/fd/ee/be/fdeebe1bfef26991ef76700af3845030.jpg',
            'price' => 18000,
            'stock' => rand(0, 50),
        ]);
    }
}
