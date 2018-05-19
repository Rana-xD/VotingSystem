<?php

namespace App\Policies;

use App\User;
use App\MeetingMaster;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the meeting master.
     *
     * @param  \App\User  $user
     * @param  \App\MeetingMaster  $meetingMaster
     * @return mixed
     */
    public function view(User $user, MeetingMaster $meetingMaster)
    {
        return !$user->isAdmin() && $user->meeting_uuid === $meetingMaster->meeting_uuid;
    }

    /**
     * Determine whether the user can create meeting masters.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the meeting master.
     *
     * @param  \App\User  $user
     * @param  \App\MeetingMaster  $meetingMaster
     * @return mixed
     */
    public function update(User $user, MeetingMaster $meetingMaster)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the meeting master.
     *
     * @param  \App\User  $user
     * @param  \App\MeetingMaster  $meetingMaster
     * @return mixed
     */
    public function delete(User $user, MeetingMaster $meetingMaster)
    {
        return $user->isAdmin();
    }
}
