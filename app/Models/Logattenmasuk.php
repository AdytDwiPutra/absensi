<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logattenmasuk extends Model
{
    use HasFactory;
    protected $table = 'absenmasuk';
    /**
     * disable-model-timestamps: nambah kolom 'updated_at' dan 'created_at'
     */
    public $timestamps = false;

/**
    * The database primary key value.
    *
    * @var string
    */

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
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
    public function getNama() {

            return $this->belongsTo('App\Models\Teacher', 'id_user', 'id_user');
    }
}
