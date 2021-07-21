<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanModel extends Model
{
    protected $table = 'bahan';
    protected $primaryKey = 'nama';
    protected $protectFields = false;
}