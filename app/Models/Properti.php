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
        'status_pembayaran', // 🔥 tambahan
        'is_unggulan',
        'bukti_pembayaran',
        'alasan_penolakan',
        'alasan_penolakan_pembayaran' // 🔥 tambahan
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔥 OPTIONAL (BIAR CLEAN QUERY)
    public function scopeSiapTampil($query)
    {
        return $query->where('status', 'disetujui')
                     ->where('status_pembayaran', 'valid');
    }
}
