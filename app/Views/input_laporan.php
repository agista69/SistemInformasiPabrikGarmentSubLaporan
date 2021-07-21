<?= $this->extend('layout/karyawan_template'); ?>
<?= $this->section('karyawan_content'); ?>

<div class="container">
    <h2>Input Laporan</h2>
    <form action="/karyawan/inputlaporan/submit" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul</label>
            <input name="judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="exampleInputPassword1" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="id_pakaian" class="form-label">Masukkan Id Pakaian:</label>
            <input type="text" name="id_pakaian" id="id_pakaian" class="form-control">

        </div>
        <div class="mb-3">
            <label class="form-label" for="jml_pakaian">Masukkan Jumlah Pakaian Jadi : </label>
            <input class="form-control" type="number" name="jml_pakaian" id="jml_pakaian"><br>


        </div>
        <div class="mb-3">
            <label for="" class="form-label">Bahan yang dipakai</label>
            <br>
            <label for="benang_jahit" class="form-label">Benang Jahit : </label>
            <input class="form-control" type="number" name="benang_jahit" id="benang_jahit">
            <label for="kain_cotton_combed" class="form-label">Cotton Combed : </label>
            <input class="form-control" type="number" name="kain_cotton_combed" id="kain_cotton_combed">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Kirim Laporan</button>
    </form>
</div>

<?= $this->endSection(); ?>