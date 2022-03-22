<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'link',
        'shortcode',
        'disabled',
    ];

    public function isDisabled() : Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == 1 ? true : false
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
