<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A site-wide setting edited from the admin panel, stored as a key/value pair.
 */
#[Unguarded]
class SiteSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function valueOf(string $key): ?string
    {
        $value = static::query()->where('key', $key)->value('value');

        return is_string($value) ? $value : null;
    }

    public static function put(string $key, ?string $value): void
    {
        static::withTrashed()->updateOrCreate(['key' => $key], ['value' => $value, 'deleted_at' => null]);
    }

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
}
