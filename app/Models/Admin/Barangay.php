<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lat', 'long'];

    public function resident()
    {
        return $this->hasOne(Resident::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
