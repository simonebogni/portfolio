<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'rating' => 1,
        'speaking' => "Beginner",
        'reading' => "Beginner",
        'writing' => "Beginner",
        'listening' => "Beginner",
    ];
}
