<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait PostScopes
{
    public function scopePublished(Builder $builder)
    {
        return $builder->where('is_published', true);
    }

    public function scopeWithUserData(Builder $builder)
    {
        return $builder->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.email');
    }

    public function scopePublishedByUser(Builder $builder, $userId)
    {
        return $builder->where('user_id', $userId)
            ->whereNotNull('created_at');
    }
}
