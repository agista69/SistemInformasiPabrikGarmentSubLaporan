<?= $this->extend('layout/karyawan_template'); ?>
<?= $this->section('karyawan_content'); ?>
<div class="container">


    <h2>Daftar Laporan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($daftar_laporan as $laporan) { ?>
            <tr>
                <td><?= $laporan['judul'] ?></td>
                <td><?= $laporan['waktu_dibuat'] ?></td>
                <td>
                    <form action="/karyawan/daftarlaporan/detail" method="GET">
                        <input type="hidden" name="id" id="" value="<?= $laporan['waktu_dibuat'] ?>">

                        <button type="submit" class="btn btn-primary">Detail</button>

                    </form><br>
                    <form action="/karyawan/daftarlaporan/hapus" action="get">
                        <input type="hidden" name="id" id="" value="<?= $laporan['waktu_dibuat'] ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>


                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
<?= $this->endSection(); ?>