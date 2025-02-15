<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillSubcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the category of this subcatory
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    /**
     * Get the skills of this subcategory
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
