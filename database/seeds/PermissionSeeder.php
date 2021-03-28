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
            ['nama' => 'transaksi.pembayaran'],
            ['nama' => 'transaksi.tagihan'],
            ['nama' => 'data.siswa'],
            ['nama' => 'data.kelas'],
            ['nama' => 'data.kompetensi'],
            ['nama' => 'data.spp'],
            ['nama' => 'data.tahun'],
            // ['nama' => 'laporan.tahun'],
            ['nama' => 'user-manager.user'],
            ['nama' => 'user-manager.role'],
            ['nama' => 'user-manager.permission'],
        ];   
    }
}