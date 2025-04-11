<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title', // ← 追加
        'sport_type',
        'prefecture',
        'city',
        'place_name',
        'scheduled_at',
        'recruit_number',
        'mood',
        'comment',
    ];
}
