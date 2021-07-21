<?php

namespace App\Models;

use CodeIgniter\Model;

class PemakaianBahanModel extends Model
{
    protected $table = 'pemakaian_bahan';
    protected $primaryKey = 'waktu_pakai';
    protected $protectFields = false;
}