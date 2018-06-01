<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(array(
            'username' => 'admin',
            'name' => 'Super Admin',
            'password' => Hash::make('12341234'),
        ));
    }
}
