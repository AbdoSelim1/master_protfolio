<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'status'];
    protected $table = "social_links";

    public $timestamps = false;

    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }
}
