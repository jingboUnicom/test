<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vacancy_id',
        'category_id',
        'subcategory_id',
        'name',
        'surname',
        'candidate_name',
        'location',
        'current_job_title',
        'photo',
        'resume',
        'cover_letter',
        'experience',
        'skills',
        'education',
        'languages',
        'status',
    ];

    const STATUS_SUBMITTED_TO_CLIENT = 0;
    const STATUS_INTERVIEW_FIRST_STAGE = 1;
    const STATUS_INTERVIEW_SECOND_STAGE = 2;
    const STATUS_OFFERED = 3;
    const STATUS_DECLINED = 4;
    const STATUS_ACCEPTED = 5;

    const STATUSES = [
        'Submitted to Client',
        'Interview 1st Stage',
        'Interview 2nd Stage',
        'Offered',
        'Declined',
        'Accepted',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['candidate_name'] = $value;
    }

    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = $value;
        $this->attributes['candidate_name'] = $this->attributes['name'] . ' ' . $value;
    }

    // Relationships

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // Inversed Relationships

}
