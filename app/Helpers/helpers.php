<?php

use App\Models\Category;
use App\Models\Routes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


function required_mark()
{
    return '<span class="text-danger"> *</span>';
}

function getStatusColors($index){
    return [1=>'success',2=>'danger',3=>'warning',4=>'dark'][$index];
}

function isDateTime($dateString)
{
    if (strtotime($dateString)) {
        return true;
    }
    return false;
}

function days_between($end, $start)
{
    return (strtotime($end) - strtotime($start)) / (60 * 60 * 24);
}

function leftSpace($value)
{
    return ($value) ? ' ' . $value : '';
}

function rightSpace($value)
{
    return ($value) ? $value . ' ' : '';
}

function leftrightSpace($value)
{
    return ($value) ? ' ' . $value . ' ' : '';
}

function leftRightBrakets($value)
{
    return ($value) ? '( ' . $value . ' )' : '';
}

function format_currency($value)
{
    $value = ((env('CURRENCY'))?env('CURRENCY'):'Rs') .' '. number_format($value, 2);
    return $value;
}

function getUploadsPath($name){
    $name='uploads/'.$name;
    return asset($name);
}

function getDownloadFileName($prefix=null){
    return (($prefix)?$prefix:'').Carbon::now()->format('YmdHs');
}

function isntEmpty($val){
    return ($val && $val!='')?true:false;
}
