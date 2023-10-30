<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Createuser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'email',
        'hp',
        'unit',
        'keterangan',
        'file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
