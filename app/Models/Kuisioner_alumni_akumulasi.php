<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner_alumni_akumulasi extends Model
{
    use HasFactory;

    protected $table = 'kuisioner_alumni_akumulasi';
    protected $primaryKey = 'id';
    protected $fillable = ['npm','nama_mahasiswa','total_point'];
}
