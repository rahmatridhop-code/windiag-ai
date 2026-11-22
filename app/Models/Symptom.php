<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = ['code', 'description'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}