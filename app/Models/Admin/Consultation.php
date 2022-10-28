<?php

namespace App\Models\Admin;

use App\Pivot\DateTime;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Consultation extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = ['date_time_id', 'aog', 'fundic_height', 'weight', 'blood_pressure', 'abdominal_measurement', 'diagnosis', 'treatment', 'notes', 'status', 'comeback_on'];

      // media convertion
      public function registerMediaCollections(): void
      {
          $this->addMediaConversion('card')
          ->width(600)
          ->height(600);
      }
     
      public function post_image()
      {
          return $this->hasOne(Media::class, 'model_id', 'id');
      }
  
    // get the first image on the relationship media
      public function getPostImageUrlAttribute()
      {
          return $this->post_image->getUrl('card');
      }

      public function datetime()
      {
          return $this->belongsTo(DateTime::class);
      }
}
