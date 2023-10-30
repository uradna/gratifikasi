<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gratifikasi extends Model
{
    use HasFactory;
    protected $table = 'gratifikasi';
    protected $fillable = [
        'user_id',
        'jenis',
        'bentuk',
        'nilai',
        'waktu',
        'nama',
        'hubungan',
        'alamat',
        'alasan',
        'unit',
        'jabatan',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
