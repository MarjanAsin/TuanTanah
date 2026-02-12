<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    protected $table = 'properti';
    protected $primaryKey = 'properti_id';

    protected $fillable = [
        'user_id',
        'nama_properti',
        'harga',
        'lokasi',
        'deskripsi',
        'fasilitas',
        'kontak_whatsapp',
        'foto_properti',
        'status',
        'is_unggulan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
