<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillSubcategory extends Model
{
    use HasFactory;

    /**
     * Get the category of this subcatory
     */
    public function category(){
        return $this->belongsTo(SkillCategory::class);
    }

    /**
     * Get the skills of this subcatory
     */
    public function skills(){
        return $this->hasMany(Skill::class);
    }
}
