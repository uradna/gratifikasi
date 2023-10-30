<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backupuser extends Model
{
    protected $table = 'backupuser';
    protected $fillable = [
        'name',
        'nip',
        'email',
        'hp',
        'password',
        'pangkat',
        'jabatan',
        'unit',
        'tempat',
        'status_1',
        'status_2',
        'status_3',
        'status_laporan',
        'finish',
        'tanggal',
        'admin',
    ];
}
