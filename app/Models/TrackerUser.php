<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerUser extends Model
{
    use HasFactory;

    protected $table = 'tracker_users';
    protected $fillable = ['name'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}