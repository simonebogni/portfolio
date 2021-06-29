<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'exam_date'];

    /**
     * Get the program that taught this course
     */
    public function program(){
        return $this->belongsTo(Program::class);
    }
}
