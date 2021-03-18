<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            DB::table('user')->insert([
                'nama' => 'Indra Mahesa',
                'username' => 'admin',
                'password' => '$2y$10$b45sogzP3eAdXlbcK/ylZOCOdpGBj8A6sKGFpImx28zLP3Vo/J47.', // admin
                'role_id' => 1,
            ]);
    
            // \App\Role::find(1)->permissions()->attach([33, 34]);
        });
    }
}
