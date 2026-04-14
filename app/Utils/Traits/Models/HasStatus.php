<?php

namespace App\Utils\Traits\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;

trait HasStatus
{
    public function isActive(): bool
    {
        return $this->status == static::ACTIVE_STATUS
            ? true
            : false;
    }

    /**
     * Scope a query to only include active models.
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('status', static::ACTIVE_STATUS);
    }

    /**
     * Scope a query to only include inactive models.
     */
    #[Scope]
    protected function inactive(Builder $query): void
    {
        $query->where('status', static::INACTIVE_STATUS);
    }
}
