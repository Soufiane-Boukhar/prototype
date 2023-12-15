<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'soufiane',
            'email' => 'soufiane@gmail.com',
            'role' => 'project-leader',
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('project-leader');

        $permissionsLeader = [
            'create-ProjectController',
            'store-ProjectController',
            'show-ProjectController',
            'edit-ProjectController',
            'update-ProjectController',
            'destroy-ProjectController',
            'index-ProjectController',
            'import-ProjectController',
            'export-ProjectController',

            'create-TaskController',
            'store-TaskController',
            'show-TaskController',
            'edit-TaskController',
            'update-TaskController',
            'destroy-TaskController',
            'index-TaskController',
            'import-TaskController',
            'export-TaskController',

            'create-MemberController',
            'store-MemberController',
            'show-MemberController',
            'edit-MemberController',
            'update-MemberController',
            'destroy-MemberController',
            'index-MemberController',
        ];

        $user->givePermissionTo($permissionsLeader);



        $member = User::create([
            'name' => 'amine',
            'email' => 'amine@gmail.com',
            'role' => 'member',
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('member');


        $permissions = [
            'index-ProjectController',
            'index-TaskController',
            'index-MemberController',
        ];
        
        $member->givePermissionTo($permissions);

    }
}
