<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

         // Reset cached roles and permissions
         app()[PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         Permission::create(['name' => 'create user']);
         Permission::create(['name' => 'update user']);
         Permission::create(['name' => 'delete user']);
         
         Permission::create(['name' => 'create expenses']);
         Permission::create(['name' => 'update expenses']);
         Permission::create(['name' => 'delete expenses']);
 
         // create roles and assign existing permissions
         $role1 = Role::create(['name' => 'user']);
         $role1->givePermissionTo('create expenses');
         $role1->givePermissionTo('delete expenses');
         $role1->givePermissionTo('update expenses');
 
         $role2 = Role::create(['name' => 'admin']);


        
        $user = User::create([

            'email' => 'admin@gmail.com',
            'first_name' => 'admin1',
            'last_name' => 'admin',
            'password' => Hash::make('123'),

        ]);

        $user->assignRole($role2);

    }
}
