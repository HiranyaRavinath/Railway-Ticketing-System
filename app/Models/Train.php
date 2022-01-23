<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'end', 'alias', 'status', 'seatsperbox', 'windowed', 'nonwindowed'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public function startdata()
    {
        return $this->hasOne(Location::class, 'id', 'start');
    }

    public function enddata()
    {
        return $this->hasOne(Location::class, 'id', 'end');
    }
}
