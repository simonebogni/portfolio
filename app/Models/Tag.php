<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'category', 'bg_color', 'color',
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
     * @return BelongsToMany
     */
    public function workPositions()
    {
        return $this->belongsToMany(WorkPosition::class);
    }

    /**
     * @return BelongsToMany
     */
    public function certificates()
    {
        return $this->belongsToMany(Certificate::class);
    }

    /**
     * @return BelongsToMany
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }

    /**
     * @return BelongsToMany
     */
    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }
}
