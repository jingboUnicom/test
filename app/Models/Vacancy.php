<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
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

    const STATUSES = [
        'Synced from Job Adder',
        'Open',
        'Hold',
        'Filled by Regeine Career',
        'Withdrawn by Regeine Career',
        'Withdrawn by Client',
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

}
