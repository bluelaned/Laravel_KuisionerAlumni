<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner_alumni_hasil extends Model
{
    use HasFactory;

    protected $table = 'kuisioner_alumni_hasil';
    protected $primaryKey = 'id';
    protected $fillable = ['npm','nama_mahasiswa','pertanyaan','jawaban','point'];
}
