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
            "nama" => "Ryan",
            "tanggal_lahir" => "2002-10-06",
            "nomor_telepon" => "+2193012",
            "alamat" => "alamat ryan",
            "email" => "ryan@gmail.com",
            "password" => Hash::make("password"),
        ]);
        $admin->assignRole("admin");
        
        $guru = User::create([
            "nama" => "guru",
            "tanggal_lahir" => "2002-10-06",
            "nomor_telepon" => "+2193012",
            "alamat" => "alamat ryan",
            "email" => "guru@gmail.com",
            "password" => Hash::make("password"),
        ]);
        $guru->assignRole("guru");

        $siswa = User::create([
            "nama" => "Fazil",
            "tanggal_lahir" => "2002-03-31",
            "nomor_telepon" => "+2193012",
            "alamat" => "alamat ryan",
            "email" => "fazil@gmail.com",
            "password" => Hash::make("password"),
        ]);
        $siswa->assignRole("siswa");
    }
}
