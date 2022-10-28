<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'suffix',
        'gender',
        'birthdate',
        'address',
        'barangay_id',
        'contact',
        'email',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    // resident might have a one auth account
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->fname . " " . $this->lname;
    }

    public function health_profile()
    {
        return $this->hasOne(HealthProfile::class);
    }

}
