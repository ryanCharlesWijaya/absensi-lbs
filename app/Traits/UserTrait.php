<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait UserTrait
{
    protected function makeStoreValidator(Array $data)
    {
        return Validator::make($data, [
            "sekolah_id" => ["nullable", "int"],
            "nama" => ["required", "string"],
            "tanggal_lahir"=> ["required", "string"],
            "nomor_telepon" => ["required", "string"],
            "alamat" => ["nullable", "string"],
            "email" => ["required", "string"],
            "password" => ["required", "confirmed", "min:8"]
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
            "password" => $data["password"],
            
        ]);
    }

    protected function makeUpdateDetailValidator(Array $data)
    {
        return Validator::make($data, [
            "sekolah_id" => ["sometimes","nullable", "int"],
            "nama" => ["sometimes","required", "string"],
            "tanggal_lahir"=> ["sometimes","required", "string"],
            "nomor_telepon" => ["sometimes","required", "int"],
            "alamat" => ["sometimes","nullable", "string"],
            "email" => ["sometimes","required", "string"],
        ]);
    }

    protected function makeUpdatePasswordValidator(Array $data)
    {
        return Validator::make($data, [
            "password" => ["required", "confirmed", "min:8"]
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
