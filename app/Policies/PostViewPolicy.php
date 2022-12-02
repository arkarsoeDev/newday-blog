<?php

namespace App\Policies;

use App\Models\PostView;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostViewPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isEditor()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAuthor();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PostView $postView)
    {
        return $postView->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PostView $postView)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PostView $postView)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PostView $postView)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostView  $postView
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PostView $postView)
    {
        //
    }
}
