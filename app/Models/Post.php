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
    use HasFactory, SoftDeletes, Prunable, PostScopes;

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(new PublishedWithinThirtyDaysScope());
    // }

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

// {
//     {'title': '...', id: 'asdasd' },
// }

// {
//     {'asdasd': { title: '...', id: 'asdasd' } },
// }

// {
//     {'asdasd': '...' },
// }

Post::query()
    // ->where(...
    ->select(['title', 'id'])
    ->get()
    ->keyBy('id')
    ->map->title;

Post::query()
    ->get()
    ->pluck('title', 'id');

Post::query()
    ->pluck('title', 'id');
