<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVtagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('v_tagihan');
        \DB::statement("
            CREATE VIEW v_tagihan
            AS
            SELECT
                tagihan.id AS id,
                IFNULL(MAX(pembayaran.bulan_ke), 0) AS bulan_ke,
                IF(IFNULL(MAX(pembayaran.bulan_ke), 0) >= 12, spp.nominal, IFNULL(SUM(pembayaran.jumlah), 0)) AS dibayar,
                IFNULL(IF(IFNULL(MAX(pembayaran.bulan_ke), 0) >= 12, 'Lunas', 'Belum Lunas'), 'Belum Lunas') AS status
            FROM
                tagihan
            JOIN
                spp ON tagihan.spp_id = spp.id
            LEFT JOIN
                pembayaran ON tagihan.id = pembayaran.tagihan_id
            GROUP BY
                tagihan.id, pembayaran.tagihan_id, spp.nominal
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
            DROP VIEW IF EXISTS v_tagihan;
        ");
    }
}
