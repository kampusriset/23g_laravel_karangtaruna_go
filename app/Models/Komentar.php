<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
   use HasFactory;

    protected $table = 'komentar';
    
    protected $fillable = [
        'diskusi_id',
        'user_id',
        'teks',
    ];

    public function diskusi(): BelongsTo
    {
        return $this->belongsTo(Diskusi::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
