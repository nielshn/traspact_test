<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'eselon'];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
