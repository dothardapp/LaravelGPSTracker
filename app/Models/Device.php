<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['tracker_user_id', 'device_id', 'name'];

    public function user()
    {
        return $this->belongsTo(TrackerUser::class, 'tracker_user_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}