<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['hypothesis_id', 'symptom_id', 'cf_pakar'];

    public function hypothesis()
    {
        return $this->belongsTo(Hypothesis::class);
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}