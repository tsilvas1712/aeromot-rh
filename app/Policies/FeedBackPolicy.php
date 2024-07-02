<?php

namespace App\Policies;

use App\Models\FeedBack;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FeedBackPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('feed_back_permissions');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FeedBack $feedBack): bool
    {

        return $feedBack->user_id === $user->id || $user->hasPermissionTo('feed_back_permissions');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(['feed_back_permissions', 'create']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FeedBack $feedBack): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FeedBack $feedBack): bool
    {
        return $user->hasRole('Admin');
    }
}
