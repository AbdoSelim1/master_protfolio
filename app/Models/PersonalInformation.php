<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $table = 'personal_information';
    protected $fillable = ["city", "country", "email", "phone", "job_title", "status", "age", "about"];

    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }
}
