<?php

namespace App\Policies\Inventory;

use App\Models\Inventory\InventoryItem;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Inventory\InventoryItem  $inventoryItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InventoryItem $inventoryItem)
    {
        //
    }
}
