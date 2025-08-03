<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriKeuangan extends Model
{
    use HasFactory;

    protected $table = 'kategori_keuangans';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'is_active',
        'status_uang',
    ];

    protected $casts = [
        'is_active' => 'string',
        'status_uang' => 'string',
        'created_at' => 'datetime',
    ];

    public function pencatatanKeuangan(): HasMany
    {
        return $this->hasMany(PencatatanKeuangan::class, 'kategori_id', 'id_kategori');
    }
}