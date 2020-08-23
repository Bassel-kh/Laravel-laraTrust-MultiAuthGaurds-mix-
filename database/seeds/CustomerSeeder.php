<?php

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
        DB::table('customers')->insert([
            'name' => 'Customer1',
            'email' => 'customer1@customer.com',
            'password' => Hash::make('password'),
        ]);
    }
}
