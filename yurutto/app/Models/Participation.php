<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = [
        'recruitment_id',
        'user_id',
    ];   

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

}
