<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cabang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Kepala Yayasan (Global)
        User::updateOrCreate(
            ['email' => 'yayasan@gmail.com'],
            [
                'name' => 'Ketua Yayasan',
                'password' => bcrypt('yayasan123'),
                'role' => 'yayasan',
                'cabang_id' => null,
            ]
        );

        // 2. Auto-Generate Akun Admin untuk Seluruh Cabang yang Ada di Database
        $cabangs = Cabang::all();
        foreach ($cabangs as $cb) {
            // Bersihkan nama cabang untuk format email dan password
            // Contoh: "Ebony Sukabangun" -> "sukabangun"
            $cleanName = strtolower(str_replace([' ', '_', '-'], '', $cb->nama_cabang));
            $cleanName = str_replace('ebony', '', $cleanName);

            $email = 'admin' . $cleanName . '@gmail.com';
            $password = 'admin' . $cleanName . '123';
            $name = 'Admin ' . str_replace('Ebony ', '', $cb->nama_cabang);

            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt($password),
                    'role' => 'admin',
                    'cabang_id' => $cb->id,
                ]
            );
        }
    }
}
