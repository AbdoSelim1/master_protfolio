<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    use HasFactory;

    protected $fillable  = ['status', 'company_name', 'start_date', 'end_date', 'job_title', 'job_type', 'job_responsibilities'];

    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }
}
