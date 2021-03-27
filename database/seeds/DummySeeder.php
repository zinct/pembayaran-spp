<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kompetensi')->insert([
            ['nama' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'Desain Komunikasi Visual'],
            ['nama' => 'Akuntansi'],
            ['nama' => 'Animasi'],
        ]);

        DB::table('kelas')->insert([
            ['nama' => 'XII RPL 1', 'kompetensi_id' => '1'],
            ['nama' => 'XII RPL 2', 'kompetensi_id' => '1'],
            ['nama' => 'XII RPL 3', 'kompetensi_id' => '1'],
            ['nama' => 'XII RPL 4', 'kompetensi_id' => '1'],
            ['nama' => 'XII RPL 5', 'kompetensi_id' => '1'],
            ['nama' => 'XII AKT 1', 'kompetensi_id' => '3'],
            ['nama' => 'XII AKT 2', 'kompetensi_id' => '3'],
            ['nama' => 'XII AKT 3', 'kompetensi_id' => '3'],
            ['nama' => 'XII AKT 4', 'kompetensi_id' => '3'],
            ['nama' => 'XII DKV 1', 'kompetensi_id' => '2'],
            ['nama' => 'XII DKV 2', 'kompetensi_id' => '2'],
            ['nama' => 'XII ANM', 'kompetensi_id' => '4'],
        ]);

        DB::table('tahun')->insert([
            ['nama' => '2018/2019'],
            ['nama' => '2019/2020'],
        ]);
    }
}
