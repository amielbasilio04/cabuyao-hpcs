<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthIssue extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function health_profile()
    {
        return $this->hasOne(HealthProfile::class);
    }
}
