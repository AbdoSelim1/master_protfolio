<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cv extends Model
{
    use HasFactory;
    protected $fillable = ["status", "name", "company_name", "file_name", "file_path", "file_type", "file_size"];

    protected function filePath(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('storage'.DIRECTORY_SEPARATOR.'cvs' . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR .$this->file_name),
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (string) $value,
        );
    }
}
