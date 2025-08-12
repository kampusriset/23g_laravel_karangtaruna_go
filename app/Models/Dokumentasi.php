<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dokumentasi extends Model
{
     use HasFactory;

    protected $table = 'dokumentasi';
    
    protected $fillable = [
        'gambar',
        'deskripsi',
    ];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? Storage::url($this->gambar) : null;
    }
}
