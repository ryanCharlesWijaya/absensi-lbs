<?php

namespace App\Services;

use App\Models\User;
use App\Traits\UserTrait;

class UserService {
    use UserTrait;
    public function createUser(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $user = $this->storeUserInDatabase($validated);

        return $user;
    }

    public function updateUserDetail(Array $data, int $user_id)
    {
        $user = User::findOrFail($user_id);

        $validated = $this->makeUpdateDetailValidator($data)->validate();

        $this->updateUserInDatabase($validated, $user);

        return $user->refresh();
    }

    public function updateUserPassword(Array $data, int $user_id)
    {
        $user = User::findOrFail($user_id);

        $validated = $this->makeUpdatePasswordValidator($data)->validate();

        $this->updateUserInDatabase($this->formatPassword($validated), $user);

        return $user->refresh();
    }

    public function deleteUserResource(int $user_id)
    {
        $user = User::findOrFail($user_id);

        $user = $user::find($user_id);
        $user->delete();

        return $user;
    }
}
