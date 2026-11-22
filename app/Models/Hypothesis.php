<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hypothesis extends Model
{
    protected $fillable = ['code', 'name', 'category', 'solution'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}