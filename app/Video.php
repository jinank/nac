<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function genere()
    {
        return $this->belongsTo(Genere::class);
    }
}
