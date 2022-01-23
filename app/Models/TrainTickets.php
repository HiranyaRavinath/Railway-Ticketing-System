<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainTickets extends Model
{
    use HasFactory;

    protected $fillable = ['class', 'status', 'isforeigner', 'start', 'end', 'train', 'price'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public static $classes = [1 => 'First Class', 2 => 'Second Class', 3 => 'Third Class'];

    public function startdata()
    {
        return $this->hasOne(Location::class, 'id', 'start');
    }

    public function enddata()
    {
        return $this->hasOne(Location::class, 'id', 'end');
    }

    public function traindata()
    {
        return $this->hasOne(Train::class, 'id', 'train');
    }
}
