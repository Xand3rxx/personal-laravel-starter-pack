<?php

namespace App\Traits;

trait RecursiveActions
{
    /**
     * Deactivate/Reinstate/Enable/Disable any type of model entity.
     *
     * @param  string $uuid
     * @param  string $model
     * @return bool true|false
     */
    public function updateEntityAccess(string $uuid, string $model)
    {
        $updateEntity = $model::where('uuid', $uuid)->withTrashed()->firstOrFail();

        // Prevent user access change of the current authenticated user
        if ($model === '\App\Models\User') $this->verifyUser($updateEntity);

        return empty($updateEntity['deleted_at'])
            ? $updateEntity->delete()
            : $updateEntity->restore();
    }

    /**
     * Permanently delete any type model entity.
     *
     * @param  string $uuid
     * @param  string $model
     * @return bool true|false
     */
    public function permanentlyDeleteEntity(string $uuid, string $model)
    {
        //Verify if uuid of Administrator exist and forcefully deleting that user
        $permanentlyDeleteEntity = $model::where('uuid', $uuid)->withTrashed()->firstOrFail();

        // Prevent user access change of the current authenticated user
        if ($model === '\App\Models\User') $this->verifyUser($permanentlyDeleteEntity);

        return ($permanentlyDeleteEntity->forceDelete());
    }

    /**
     * Permanently delete any type model entity.
     *
     * @param  string $uuid
     * @param  string $model
     * @param  string $column
     * @param  string $status
     * @return bool true|false
     */
    public function updateEntityStatus(string $uuid, string $model, string $column, string $status)
    {
        //Verify if uuid of the entity model and update the status
        return ($model::where('uuid', $uuid)->firstOrFail()->update([$column => $status]));
    }

    /**
     * Prevent user access change of the current authenticated user.
     *
     * @param  object $user
     * @return void
     */
    public function verifyUser($user)
    {
        if (auth()->user()->id == $user['id']) {
            return redirect()->back();
        }
    }
}
