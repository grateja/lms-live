<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::count() == 0) {
            $users = [
                [
                    'id' => Str::uuid(),
                    'name' => 'The Programmer',
                    'email' => 'developer@dev.com',
                    'password' => bcrypt('admin'),
                ],
                [
                    'id' => Str::uuid(),
                    'name' => 'Staff',
                    'email' => 'staff@test.com',
                    'password' => bcrypt('admin'),
                ],
                [
                    'id' => Str::uuid(),
                    'name' => 'Shop authorizer',
                    'email' => 'shop@authorizer.com',
                    'password' => bcrypt('admin'),
                ],
            ];
            User::insert($users);
        }
    }
}
