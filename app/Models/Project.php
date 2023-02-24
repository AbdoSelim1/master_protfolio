<?php

namespace App\Models;


use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\services\ManegMedia\UploadMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia ,UploadMedia ;

    protected $fillable  = ["name", "slug", "github_url", "preview_url", "tools", "description", "start_date", "status",'priority'];
   
    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }

    protected function priority(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }
}

