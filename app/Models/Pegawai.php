<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    
    public function user()
    {
        return $this->hasOne(User::class, 'nip', 'p_nip');
    }
}
