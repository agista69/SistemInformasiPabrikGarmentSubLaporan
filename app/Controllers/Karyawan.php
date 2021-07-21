<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\LaporanModel;
use App\Models\PakaianModel;
use App\Models\PemakaianBahanModel;
use App\Models\KaryawanModel;



class Karyawan extends BaseController
{
    protected $pakaianModel;
    protected $bahanModel;
    protected $laporanModel;
    protected $pemakaianBahanModel;
    protected $karyawanModel;
    public function __construct()
    {
        session_start();
        $this->pakaianModel = new PakaianModel();
        $this->bahanModel = new BahanModel();
        $this->laporanModel = new LaporanModel();
        $this->pemakaianBahanModel = new PemakaianBahanModel();
        $this->karyawanModel = new KaryawanModel();
    }
    public function index()
    {

        return view('home_karyawan');
    }

    public function detail_laporan()
    {
        $id_laporan = $this->request->getGet('id');
        $data_laporan = $this->laporanModel->where('waktu_dibuat', $id_laporan)->findAll()[0];
        $data_pakaian = $this->pakaianModel->where('id', $data_laporan['id_pakaian'])->findAll()[0];
        $data_bahan = $this->bahanModel->findAll();
        $data = [
            "judul" => $data_laporan['judul'],
            "deskripsi" => $data_laporan['deskripsi'],
            "jml_pakaian" => $data_pakaian['jml_terbuat'],
            "target_pakaian" => $data_pakaian['jml_target'],
            "pengirim" => $data_laporan['id_pengirim'],
            "waktu_dibuat" => $data_laporan["waktu_dibuat"],
            "bahan_bahan" => $data_bahan
        ];
        return view('detail_laporan', $data);
    }

    public function login_page()
    {
        return view('login_karyawan');
    }

    public function validate_login()
    {
        $login_data = $this->request->getPost();
        if ($this->karyawanModel->where('id', $login_data['id'])->findAll()) {
            if ($this->karyawanModel->where('password', $login_data['password'])->findAll()) {
                $_SESSION['login'] = true;
                $_SESSION['id'] = $login_data['id'];
                return redirect()->to('/karyawan');
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['id']);
        $_SESSION['login'] = false;
        return redirect()->to('karyawan/login');
    }
    public function input_laporan_page()
    {
        return view('input_laporan');
    }

    public function daftar_laporan_page()
    {
        $daftar_laporan = $this->laporanModel->orderBy('waktu_dibuat', 'DESC')->findAll();
        $data = ['daftar_laporan' => $daftar_laporan];
        return view('daftar_laporan', $data);
    }

    function ubah_data_jml_bahan($nama_bahan, $input)
    {
        $jml_awal = $this->bahanModel->find($nama_bahan)['jml'];
        $data = [
            'jml' => $jml_awal - $input
        ];
        $this->bahanModel->update($nama_bahan, $data);
    }
    private function ubah_data_jml_pakaian($id, $input)
    {
        $jml_terbuat = $this->pakaianModel->find($id)['jml_terbuat'];
        $data = [
            'jml_terbuat' => $jml_terbuat + $input
        ];
        $this->pakaianModel->update($id, $data);
    }

    public function hapus_laporan()
    {
        //Get paramter
        $id_laporan = $this->request->getGet('id');
        //Get data laporan
        $data_laporan = $this->laporanModel->where('waktu_dibuat', $id_laporan)->findAll()[0];
        //Get data pemakaian bahan
        $data_pemakaian_bahan = $this->pemakaianBahanModel->where('waktu_pakai', $id_laporan)->findAll();
        $this->ubah_data_jml_pakaian($data_laporan['id_pakaian'], -1 * $data_laporan['jml_pakaian_terbuat']);
        foreach ($data_pemakaian_bahan as $bahan) {

            $this->ubah_data_jml_bahan($bahan['nama'], -1 * $bahan['jml_terpakai']);
        }
        $this->pemakaianBahanModel->where('waktu_pakai', $id_laporan)->delete();
        $this->laporanModel->where('waktu_dibuat', $id_laporan)->delete();
        return redirect()->to('karyawan/daftarlaporan');
    }
    public function submit_laporan()
    {
        $daftar_bahan = $this->bahanModel->findColumn('nama');
        $input_laporan = $this->request->getPost();
        //dd($input_laporan);
        date_default_timezone_set("Asia/Jakarta");
        $datetimeToday = date('Y-m-d H:i:s', strtotime('now'));

        $this->ubah_data_jml_pakaian($input_laporan['id_pakaian'], 30);
        foreach ($daftar_bahan as $bahan) {
            $bahan_name = strtolower(str_replace(' ', '_', $bahan));

            if (intval($input_laporan[$bahan_name]) > 0) {
                $data_pemakaian_bahan = [
                    'waktu_pakai' => $datetimeToday,
                    'nama' => $bahan,
                    'jml_terpakai' => $input_laporan[$bahan_name]
                ];
                $this->ubah_data_jml_bahan($bahan, $input_laporan[$bahan_name]);
                $this->pemakaianBahanModel->insert($data_pemakaian_bahan);
            }
        }
        $data = [
            'waktu_dibuat' => $datetimeToday,
            'id_pakaian' => $input_laporan['id_pakaian'],
            'id_pengirim' => $_SESSION['id'],
            'judul' => $input_laporan['judul'],
            'deskripsi' => $input_laporan['deskripsi'],
            'jml_pakaian_terbuat' => $input_laporan['jml_pakaian']
        ];
        $this->laporanModel->insert($data);
        return redirect()->to('karyawan/daftarlaporan');
    }
}