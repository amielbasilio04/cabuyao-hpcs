<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthProfile extends Model
{
    use HasFactory;

    protected $fillable = ['resident_id', 'family_history_id', 'health_issue_id', 'guardian', 'address', 'contact', 'relationship'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function health_issue()
    {
        return $this->belongsTo(HealthIssue::class);
    }

    public function family_history()
    {
        return $this->belongsTo(FamilyHistory::class);
    }
}
