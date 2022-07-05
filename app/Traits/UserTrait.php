<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

trait UserTrait
{
    protected function makeStoreValidator(Array $data)
    {   
        return Validator::make($data, [
            "nama_sekolah" => ["nullable", "string"],
            "nama" => ["required", "string", "unique:users"],
            "tanggal_lahir"=> ["required", "string"],
            "nomor_telepon" => ["required", "string", "min:9", "max:15"],
            "alamat" => ["nullable", "string"],
            "email" => ["required", "unique:users", "string", "min:11", "max:60"],
            "password" => ["required", "confirmed", "min:8", "max:30"],
            "role" => ["required", "in:guru,siswa,admin"]
        ]);
    }

    protected function storeUserInDatabase(Array $data)
    {
        return User::create([
            "sekolah_id" => $data["sekolah_id"] ?? null,
            "nama" => $data["nama"],
            "tanggal_lahir" => $data["tanggal_lahir"],
            "nomor_telepon" => $data["nomor_telepon"],
            "alamat" => $data["alamat"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            
        ]);
    }

    protected function makeUpdateDetailValidator(Array $data, int $user_id)
    {
        return Validator::make($data, [
            "nama_sekolah" => ["nullable", "string"],
            "nama" => ["sometimes","required", "string"],
            "tanggal_lahir"=> ["sometimes","required", "string"],
            "nomor_telepon" => ["sometimes","required", "string", "min:9", "max:15"],
            "alamat" => ["sometimes","nullable", "string"],
            "email" => ["sometimes","required", "string", ValidationRule::unique("users")->ignore($user_id), "min:11", "max:60"],
            "role" => ["required"]
        ]);
    }

    protected function makeUpdatePasswordValidator(Array $data)
    {
        return Validator::make($data, [
            "password" => ["required", "confirmed", "min:8", "max:30"]
        ]);
    }

    protected function formatPassword(Array $data)
    {
        $data["password"] = Hash::make($data["password"]);

        return $data;
    }

    protected function updateUserInDatabase(Array $data, User $user)
    {
        return $user->update($data);
    }
}
