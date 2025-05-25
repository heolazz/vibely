<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanasResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pa_score',
        'na_score',
        'mood_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
