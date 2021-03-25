<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVtransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW v_transaksi
            AS
            SELECT
                pembayaran.id AS id,
                IFNULL(MAX(transaksi.bulan_ke), 0) AS bulan_ke,
                IF(IFNULL(MAX(transaksi.bulan_ke), 0) >= 12, spp.nominal, IFNULL(SUM(transaksi.nominal), 0)) AS dibayar,
                IFNULL(IF(IFNULL(MAX(transaksi.bulan_ke), 0) >= 12, 'Lunas', 'Belum Lunas'), 'Belum Lunas') AS status
            FROM
                pembayaran
            JOIN
                spp ON pembayaran.spp_id = spp.id
            LEFT JOIN
                transaksi ON pembayaran.id = transaksi.pembayaran_id
            GROUP BY
                pembayaran.id, transaksi.pembayaran_id, spp.nominal
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            DROP VIEW IF EXISTS v_transaksi;
        ");
    }
}
