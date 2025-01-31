<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    protected function user() {
        return $this->belongsTo(User::class);
    }
}
