<?php

namespace App\Services;

use App\Models\Sekolah;
use App\Models\User;
use App\Traits\UserTrait;

class UserService {
    use UserTrait;
    public function createUser(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $sekolah = Sekolah::where("nama", $validated["nama_sekolah"] ??  null)->first();

        $validated["sekolah_id"] = $sekolah
            ? $sekolah->id
            : Sekolah::create(["nama" => $validated["nama_sekolah"], "kategori" => "sekolah_siswa"])->id;

        $user = $this->storeUserInDatabase($validated);

        $user->assignRole($validated["role"]);

        return $user;
    }

    public function updateUserDetail(Array $data, int $user_id)
    {
        $user = User::findOrFail($user_id);

        $validated = $this->makeUpdateDetailValidator($data)->validate();

        if ($validated["nama_sekolah"]) {
            $sekolah = Sekolah::where("nama", $validated["nama_sekolah"] ?? null)->first();

            $validated["sekolah_id"] = $sekolah
                ? $sekolah->id
                : Sekolah::create(["nama" => $validated["nama_sekolah"], "kategori" => "sekolah_siswa"])->id;
        }

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

    public function deleteUser(int $user_id)
    {
       User::findOrFail($user_id)->delete();
    }
}
