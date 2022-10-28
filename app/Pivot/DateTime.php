<?php 

namespace App\Pivot;

use App\Models\Admin\Patient;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DateTime extends Pivot {
    
    public $incrementing = true;

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}