<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use HasFactory;

    /**
     * Get the subcategories of the category
     */
    public function subcategories(){
        return $this->hasMany(SkillSubcategory::class);
    }
}
