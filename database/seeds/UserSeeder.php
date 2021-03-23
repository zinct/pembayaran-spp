<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {

            $role = new \App\Role();
            $role->nama = 'Admin';
            $role->save();

            $user = new \App\User();
            $user->nama = 'Indra Mahesa';
            $user->username = 'admin';
            $user->password = '$2y$10$b45sogzP3eAdXlbcK/ylZOCOdpGBj8A6sKGFpImx28zLP3Vo/J47.'; // admin
            $user->role_id = $role->id;
            $user->save();

            $permissions = \App\Permission::get();

            foreach($permissions as $permission) {
                $role->permissions()->attach($permission->id);
            }
        });
    }
}
