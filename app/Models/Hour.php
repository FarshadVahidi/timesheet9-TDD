<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $dates=['date'];

    public function setDateAttribute($date)
    {
        $this->attributes['date']=Carbon::parse($date);
    }

    public function person()
    {
        $this->hasOne(User::class);
    }
}
