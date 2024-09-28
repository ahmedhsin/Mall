<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\StoreUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StorePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Store $store): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Store $store): bool
    {
        return $user->id == $store->manager_id;
    }

    public function manage(User $user, Store $store)
    {
        $storeStaff = StoreUser::query()->where('user_id', '=', $user->id)->where('store_id', '=', $store->id)
            ->where('store_id', '=', $store->id)
            ->first();

        return (bool)$storeStaff || $store->manager_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Store $store): bool
    {
        return $user->id == $store->manager_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Store $store): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Store $store): bool
    {
        //
    }
}
