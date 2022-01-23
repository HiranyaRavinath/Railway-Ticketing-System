<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['train', 'location', 'slot', 'status'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public function locationdata()
    {
        return $this->hasOne(Location::class, 'id', 'location');
    }

    public function traindata()
    {
        return $this->hasOne(Train::class, 'id', 'train');
    }
}
