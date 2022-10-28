<?php

namespace App\Models\Admin;

use App\Models\Admin\Time;
use App\Pivot\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Date extends Model
{
    use HasFactory;

    protected $fillable = ['date'];

    public function times()
    {
        return $this->belongsToMany(Time::class)->using(DateTime::class)->withPivot('patient_id', 'status')->withTimestamps();
    }
}
