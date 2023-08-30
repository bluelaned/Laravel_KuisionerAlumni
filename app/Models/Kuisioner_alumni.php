<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kuisioner_alumni extends Authenticatable
{
    use HasFactory;

    protected $table = 'kuisioner_alumni';
    protected $primaryKey = 'id';
    protected $fillable = ['role','npm','nama_mahasiswa'];
}
