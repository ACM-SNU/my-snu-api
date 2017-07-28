<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Found extends Model
{
    protected $fillable = [
        'user_id',
        'what',
        'where',
        'when',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
