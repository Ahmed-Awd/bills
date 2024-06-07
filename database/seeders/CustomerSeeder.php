<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'customer customer',
            'email' => 'customer@customer.com',
            'password' => '12345678',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('customer');
    }
}
