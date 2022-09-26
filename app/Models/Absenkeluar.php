<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absenkeluar extends Model
{
    use HasFactory;
    protected $table = 'absenkeluar';

    protected $fillable = [
        'sn',
        'id_user',
        'tanggal',
        'waktu',
        'tipe',
        '4',
        '5',
        '6',
    ];
}
