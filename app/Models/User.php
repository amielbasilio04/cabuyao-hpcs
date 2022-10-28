<?php

namespace App\Models;

use App\Models\Admin\Role;
use App\Models\Admin\Patient;
use App\Models\Admin\Barangay;
use App\Models\Admin\Resident;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable , InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_activated',
        'resident_id',
        'barangay_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role) {
        if($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    // media convertion
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('avatar')
        ->width(300)
        ->height(300)
        ->nonQueued();;

        $this->addMediaConversion('thumbnail')
        ->width(120)
        ->height(120)
        ->nonQueued();;
    }

    //relationship spatied media 

    public function avatar()
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    public function getUserAvatarAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('avatar');
    }
    public function getUserAvatarThumbnailAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('thumbnail');
    }


    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }


  
}
