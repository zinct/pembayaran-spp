<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert($this->getData());
    }

    public function getData()
    {
        return [
            ['nama' => 'user-manager.user'],
            ['nama' => 'user-manager.role'],
            ['nama' => 'user-manager.permission'],
            ['nama' => 'user-manager.profile'],
        ];   
    }
}