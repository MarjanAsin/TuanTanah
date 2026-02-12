<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'banner_id';

    protected $fillable = [
        'gambar_banner',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
}
