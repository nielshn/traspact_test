<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['code', 'description'];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
