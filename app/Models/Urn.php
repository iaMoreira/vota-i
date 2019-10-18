<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urn extends Model
{
    protected $fillable = ['title', 'begin', 'end'];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function ballots()
    {
        return $this->hasMany(Ballot::class);
    }
}
