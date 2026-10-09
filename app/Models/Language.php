<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Unguarded]
class Language extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    #[\Override]
    protected $attributes = [
        'rating' => 1,
        'speaking' => 'Beginner',
        'reading' => 'Beginner',
        'writing' => 'Beginner',
        'listening' => 'Beginner',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * The rating rounded down to the nearest half point (e.g. 4.3 → 4.0, 4.7 → 4.5).
     */
    public function roundedRating(): float
    {
        $rating = round((float) $this->rating, 2);
        $whole = floor($rating);

        return $rating - $whole >= 0.5 ? $whole + 0.5 : $whole;
    }

    /**
     * The human-readable meaning of the rounded rating.
     */
    public function ratingMeaning(): string
    {
        return match (true) {
            $this->roundedRating() >= 5.0 => 'Fluent',
            $this->roundedRating() >= 4.0 => 'Proficient',
            $this->roundedRating() >= 3.0 => 'Intermediate',
            $this->roundedRating() >= 2.0 => 'Limited working proficiency',
            default => 'Beginner',
        };
    }

    public function isNative(): bool
    {
        return $this->speaking === 'Native';
    }
}
