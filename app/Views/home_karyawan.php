<?= $this->extend('layout/karyawan_template'); ?>
<?= $this->section('karyawan_content'); ?>

<h2>Beranda Karyawan</h2>
<h2>Selamat datang<?= $_SESSION['id'] ?></h2>
<?= $this->endSection(); ?>