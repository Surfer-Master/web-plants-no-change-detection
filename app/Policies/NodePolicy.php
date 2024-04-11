<?php

namespace App\Policies;

use App\Models\Node;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NodePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        // $roles = $user->roles->pluck('name');

        // if ($roles->contains('super-admin')) {
        //     return Response::allow();
        // }

        // return Response::denyAsNotFound();
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Node $node): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Node $node): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Node $node): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Node $node): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Node $node): Response
    {
        return Response::allow();
    }
}
