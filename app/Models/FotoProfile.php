<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProfile extends Model
{
    use HasFactory;
    protected $table = 'foto_profile';

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
    protected $guarded = [];

}
