<?php

namespace App\Models\Admin;

use App\Pivot\DateTime;
use App\Models\Admin\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Time extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dates()
    {
        return $this->belongsToMany(Date::class)->using(DateTime::class)->withPivot('patient_id', 'status')->withTimestamps();
    }
}
