<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleSeeder;    
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = User::create([
            "nama" => "admin",
            "tanggal_lahir" => "2002-10-06",
            "nomor_telepon" => "+2193012",
            "alamat" => "alamat admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("password"),
        ]);
        $admin->assignRole("admin");
        
        $guru = User::create([
            "nama" => "guru",
            "tanggal_lahir" => "2002-10-06",
            "nomor_telepon" => "+2193012",
            "alamat" => "alamat guru",
            "email" => "guru@gmail.com",
            "password" => Hash::make("password"),
        ]);
        $guru->assignRole("admin");

        $siswa = User::create([
            "nama" => "siswa",
            "tanggal_lahir" => "2002-03-31",
            "nomor_telepon" => "+2193012",
            "alamat" => "alamat siswa",
            "email" => "siswa@gmail.com",
            "password" => Hash::make("password"),
        ]);
        $siswa->assignRole("siswa");
    }
}
