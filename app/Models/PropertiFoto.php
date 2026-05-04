<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertiFoto extends Model
{
    protected $fillable = [
        'properti_id',
        'path'
    ];

    public function properti()
    {
        return $this->belongsTo(Properti::class);
    }
}
