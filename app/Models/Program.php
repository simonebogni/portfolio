<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'start_date', 'end_date'];

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
}
