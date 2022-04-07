<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'contact_name',
        'email',
        'password',
        'profile_photo_path',
        'position',
        'department',
        'company_id',
        'phone',
        'super',
        'employer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['contact_name'] = $value;
    }

    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = $value;
        $this->attributes['contact_name'] = $this->attributes['name'] . ' ' . $value;
    }

    public function canAccessFilament(): bool
    {
        return $this->super || $this->employer;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }

        return $this->avatar_url;
    }

    // Relationships

    // Inversed Relationships

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
