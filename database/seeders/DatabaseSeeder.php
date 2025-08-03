<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Anggota;
use App\Models\KategoriKeuangan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        // Create sample anggota
        Anggota::create([
            'username' => 'ketua01',
            'password' => bcrypt('password'),
            'is_active' => '1',
            'nama_lengkap' => 'Budi Santoso',
            'gender' => 'M',
            'jabatan' => 'Ketua',
        ]);

        Anggota::create([
            'username' => 'sekretaris01',
            'password' => bcrypt('password'),
            'is_active' => '1',
            'nama_lengkap' => 'Siti Aminah',
            'gender' => 'F',
            'jabatan' => 'Sekretaris',
        ]);

        // Create kategori keuangan
        KategoriKeuangan::create([
            'nama_kategori' => 'Iuran Anggota',
            'is_active' => '1',
            'status_uang' => 'debit',
        ]);

        KategoriKeuangan::create([
            'nama_kategori' => 'Donasi',
            'is_active' => '1',
            'status_uang' => 'debit',
        ]);

        KategoriKeuangan::create([
            'nama_kategori' => 'Konsumsi Rapat',
            'is_active' => '1',
            'status_uang' => 'kredit',
        ]);

        KategoriKeuangan::create([
            'nama_kategori' => 'Transport',
            'is_active' => '1',
            'status_uang' => 'kredit',
        ]);
    }
}