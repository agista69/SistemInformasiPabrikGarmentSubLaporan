<?= $this->extend('layout/karyawan_template'); ?>
<?= $this->section('karyawan_content'); ?>
<div class="container">

    <input type="button" value="Cetak" class="btn btn-primary" onclick="window.print()">
</div>
<div class="container" id="data-detail">
    <h2>Detail Laporan</h2>
    <ul class="list-group">
        <li class="list-group-item">Dikirm oleh : <?= $pengirim ?></li>
        <li class="list-group-item">Waktu Dibuat : <?= $waktu_dibuat ?></li>
        <li class="list-group-item">Judul : <?= $judul ?></li>
        <li class="list-group-item">Deskripsi : <?= $deskripsi ?></li>
        <li class="list-group-item">Pakaian Jadi : <?= $jml_pakaian . " / " . $target_pakaian ?></li>
        <li class="list-group-item">Sisa Bahan :

            <ul class="list-group">
                <?php foreach ($bahan_bahan as $bahan) { ?>
                <li class="list-group-item"><?= $bahan['nama'] . " : " . $bahan['jml'] . "  " . $bahan['satuan'] ?></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</div>
<?= $this->endSection(); ?>