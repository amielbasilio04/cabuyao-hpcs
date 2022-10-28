<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'fname', 'mname', 'lname', 'gender', 'contact'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getFullNameAttribute()
    {
        return $this->fname . " " . $this->lname;
    }
}
