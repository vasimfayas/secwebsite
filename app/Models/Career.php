<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'desc',
        'experience',
        'period',
        'location',
        'is_active',
        'deadline'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];

    /**
     * Jobs visible on the public careers page: active and not past their deadline.
     */
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('deadline')->orWhereDate('deadline', '>=', today());
            });
    }

    public function isExpired(): bool
    {
        return $this->deadline !== null && $this->deadline->lt(today());
    }
}
