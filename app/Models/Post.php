<?php

namespace App\Models;

use App\Models\Scopes\PublishedWithinThirtyDaysScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(new PublishedWithinThirtyDaysScope());
    // }

    public function scopePublished(Builder $builder)
    {
        return $builder->where('is_published', true);
    }

    public function scopeWithUserData(Builder $builder)
    {
        return $builder->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.email');
    }

    // protected $table = 'users';

    // protected $primaryKey = 'slug';

    // public $incrementing = false;

    // protected $keyType = 'string';

    // public $timestamps = false;

    // protected $dateFormat = 'U';

    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }
}
