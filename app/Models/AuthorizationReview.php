<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthorizationReview extends Model
{
    use HasFactory;
    protected $table = 'authorization_reviews';
    protected $fillable = ['key'];

    protected function key(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }
}
