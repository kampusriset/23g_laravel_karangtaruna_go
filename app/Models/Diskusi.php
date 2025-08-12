<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Diskusi extends Model
{
    use HasFactory;

    protected $table = 'diskusi';
    
    protected $fillable = [
        'user_id',
        'teks',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function komentar(): HasMany
    {
        return $this->hasMany(Komentar::class);
    }

    public function getJumlahKomentarAttribute()
    {
        return $this->komentar()->count();
    }
}
