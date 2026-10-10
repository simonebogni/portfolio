<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Unguarded]
class PortfolioItem extends Model
{
    use HasFactory;
    use SoftDeletes;

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
            'date' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<PortfolioCategory, $this>
     */
    public function portfolioCategory(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class);
    }

    /**
     * @return BelongsToMany<Image, $this>
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }

    /**
     * @return BelongsToMany<Tag, $this>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
