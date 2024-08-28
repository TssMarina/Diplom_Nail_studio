<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'firstname' => 'Марина',
            'middlename' => 'Васильевна',
            'lastname' => 'Цепова',
            'email' => 'test@mail.ru',
            'password' => \Hash::make('123456'),
            'phone' => '89009009090',
            'role' => 'ADMIN'
        ]);
    }
}
