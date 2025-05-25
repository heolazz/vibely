<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanasQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['emotion', 'type', 'question_text'];
}
