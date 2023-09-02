<?php

namespace App\Policies\Admin;

use App\Models\User;
use App\Models\Admin\TemplateCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemplateCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_admin::template::category');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\TemplateCategory  $templateCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TemplateCategory $templateCategory): bool
    {
        return $user->can('view_admin::template::category');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_admin::template::category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\TemplateCategory  $templateCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TemplateCategory $templateCategory): bool
    {
        return $user->can('update_admin::template::category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\TemplateCategory  $templateCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TemplateCategory $templateCategory): bool
    {
        return $user->can('delete_admin::template::category');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_admin::template::category');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\TemplateCategory  $templateCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TemplateCategory $templateCategory): bool
    {
        return $user->can('force_delete_admin::template::category');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_admin::template::category');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\TemplateCategory  $templateCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TemplateCategory $templateCategory): bool
    {
        return $user->can('restore_admin::template::category');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_admin::template::category');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\TemplateCategory  $templateCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, TemplateCategory $templateCategory): bool
    {
        return $user->can('replicate_admin::template::category');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_admin::template::category');
    }

}
