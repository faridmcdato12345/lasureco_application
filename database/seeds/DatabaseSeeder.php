<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
            'name'=>'superadmin'
        ]);
        DB::table('roles')->insert([
            'name'=>'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'farid',
            'username' => 'faridmcdato',
            'password' => Hash::make('Cogiemcd42'),
            'role_id'=>1,
            'is_active'=>1
        ]);
    }
}
