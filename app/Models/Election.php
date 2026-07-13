<?php

namespace App\Models;

use Database\Factories\ElectionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

#[Fillable(['title', 'description', 'start_date', 'end_date', 'status', 'created_by'])]
class Election extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Election $election) {
            $election->status = $election->computeStatus();
        });
    }

    public function computeStatus(): string
    {
        $now = Carbon::now();

        if (!$this->start_date || !$this->end_date) {
            return 'draft';
        }

        if ($now->lt($this->start_date)) {
            return 'upcoming';
        }

        if ($now->between($this->start_date, $this->end_date)) {
            return 'active';
        }

        return 'closed';
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function turnoutPercentage(): float
    {
        $eligible = User::whereNotNull('verified_at')->count();

        return $eligible === 0 ? 0 : round(($this->votes()->count() / $eligible) * 100, 1);
    }
}