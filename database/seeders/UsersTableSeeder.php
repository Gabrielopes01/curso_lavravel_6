<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        /*
        User::create([
            'name' => 'Carlos',
            'email' => 'carlos@hotmail.com',
            'password' => bcrypt('123')
        ]);
        */
    }
}
