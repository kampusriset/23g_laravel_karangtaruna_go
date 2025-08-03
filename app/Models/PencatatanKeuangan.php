<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PencatatanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_keuangans';
    protected $primaryKey = 'id_catat';

    protected $fillable = [
        'kategori_id',
        'deskripsi',
        'nominal',
        'bukti_upload',
        'created_by',
    ];

    protected $casts = [
        'nominal' => 'integer',
        'created_at' => 'datetime',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKeuangan::class, 'kategori_id', 'id_kategori');
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'created_by', 'id_anggota');
    }
}