<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
    ];

    // Relationships

    // Inversed Relationships

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }
}
