<?php

namespace App\Utils\Traits\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasParent
{
    /**
     * Get model parent.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class);
    }

    /**
     * Get model children.
     */
    public function children(): HasMany
    {
        return $this->belongsTo(static::class);
    }

    /**
     * Scope a query to only include parent models.
     */
    #[Scope]
    protected function isParent(Builder $query): void
    {
        $query->whereNull(static::PARENT_COLUMN);
    }

    /**
     * Scope a query to only include children models.
     */
    #[Scope]
    protected function isChild(Builder $query): void
    {
        $query->whereNotNull(static::PARENT_COLUMN);
    }
}
