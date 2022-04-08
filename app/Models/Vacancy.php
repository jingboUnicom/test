<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ja_ad_id',
        'ja_job_id',
        'work_id',
        'company_id',
        'user_id',
        'job_title',
        'salary_min',
        'salary_max',
        'short_description',
        'bullet_points',
        'job_description',
        'category_id',
        'subcategory_id',
        'location_id',
        'state_id',
        'status',
        'posted_at',
    ];

    protected $casts = [
        'bullet_points' => 'array',
    ];

    const STATUS_SYNCED = 'synced';
    const STATUS_OPEN = 'open';
    const STATUS_HOLD = 'hold';
    const STATUS_FILLED_BY_REGEINE_CAREER = 'filled_by_regeine_career';
    const STATUS_WITHDRAWN_BY_REGEINE_CAREER = 'withdrawn_by_regeine_career';
    const STATUS_WITHDRAWN_BY_CLIENT = 'withdrawn_by_client';

    const STATUSES = [
        'synced' => 'Synced',
        'open' => 'Open',
        'hold' => 'Hold',
        'filled_by_regeine_career' => 'Filled by Regeine Career',
        'withdrawn_by_regeine_career' => 'Withdrawn by Regeine Career',
        'withdrawn_by_client' => 'Withdrawn by Client',
    ];

    // Relationships

    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    // Inversed Relationships

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }
}
