<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Authenticatable
{
    use HasFactory;

    protected $table = 'anggotas';
    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'username',
        'password',
        'is_active',
        'nama_lengkap',
        'gender',
        'jabatan',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'string',
        'gender' => 'string',
        'created_at' => 'datetime',
    ];

    public function pencatatanKeuangan(): HasMany
    {
        return $this->hasMany(PencatatanKeuangan::class, 'created_by', 'id_anggota');
    }
}