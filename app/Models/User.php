<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Scopes\BalanceVerifyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(new BalanceVerifyScope());
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function companyPhoneNumber(): HasOneThrough
    {
        return $this->hasOneThrough(
            related: PhoneNumber::class,
            through: Company::class,
            firstKey: 'user_id',
            secondKey: 'company_id',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function latestJob(): HasOne
    {
        return $this->hasOne(Job::class)->latestOfMany();
    }

    public function oldestJob(): HasOne
    {
        return $this->hasOne(Job::class)->oldestOfMany();
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
