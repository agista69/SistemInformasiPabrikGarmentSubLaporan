<?php

namespace App\Models;

use CodeIgniter\Model;

class PakaianModel extends Model
{
    protected $table = 'pakaian';
    protected $primaryKey = 'id';
    protected $protectFields = false;
}