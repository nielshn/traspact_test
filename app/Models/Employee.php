<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    protected $fillable = [
        'nip',
        'first_name',
        'last_name',
        'birth_place',
        'birth_date',
        'gender',
        'rank_id',
        'position_id',
        'unit_id',
        'religion_id',
        'address',
        'phone',
        'npwp',
        'photo_path'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
    public function getPhotoUrlAttribute()
    {
        return $this->photo_path
            ? asset('storage/' . $this->photo_path)
            : asset('default-avatar.png');
    }
}
