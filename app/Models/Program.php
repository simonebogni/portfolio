<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get the Institute of this Program
     */
    public function institute(){
        return $this->belongsTo(Institute::class);
    }

    /**
     * Get the OnlinePlatform of this Program
     */
    public function onlinePlatform(){
        return $this->belongsTo(OnlinePlatform::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the courses taught by this program
     */
    public function courses(){
        return $this->hasMany(Course::class);
    }
}
