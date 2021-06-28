<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlinePlatform extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the list of the Programs taught on this OnlinePlatform
     */
    public function programs(){
        return $this->hasMany(Program::class);
    }
}
