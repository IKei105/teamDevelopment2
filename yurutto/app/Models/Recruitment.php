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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participations');
    }


}
