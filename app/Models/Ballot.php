<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    protected $fillable = ['elector', 'urn_id', 'candidate_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
