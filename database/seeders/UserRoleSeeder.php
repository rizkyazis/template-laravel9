<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listRole = ['Admin', 'Dropshipper', 'Buyer'];
        $listUser = ['admin', 'dropshipper', 'buyer'];

        foreach ($listRole as $role) {
            Role::create([
                'code' => $role,
                'role' => $role
            ]);
        }

        foreach ($listUser as $user) {
            User::create([
                'name' => $user,
                'email' => $user . '@mail.com',
                'password' => Hash::make('12345678')
            ]);
        }

        foreach ($listUser as $user) {
            $valueUser = User::all()->where('name', $user)->first();
            $valueRole = Role::all()->where('code', ucfirst($user))->first();

            UserRole::create([
                'user_id' => $valueUser->id,
                'role_id' => $valueRole->id,
            ]);
        }


    }
}
