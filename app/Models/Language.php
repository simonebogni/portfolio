<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
