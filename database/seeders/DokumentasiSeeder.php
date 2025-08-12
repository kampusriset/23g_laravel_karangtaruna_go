<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokumentasi;

class DokumentasiSeeder extends Seeder
{
    public function run(): void
    {
        $dokumentasi = [
            [
                'gambar' => 'dokumentasi/panduan-sistem.jpg',
                'deskripsi' => 'Panduan lengkap penggunaan sistem manajemen internal perusahaan. Dokumen ini mencakup tutorial step-by-step untuk semua fitur utama aplikasi, termasuk cara login, navigasi menu, dan penggunaan berbagai modul yang tersedia.',
            ],
            [
                'gambar' => 'dokumentasi/sop-keamanan.jpg',
                'deskripsi' => 'Standard Operating Procedure (SOP) untuk keamanan data dan informasi perusahaan. Berisi protokol keamanan, cara menangani data sensitif, dan prosedur backup yang harus diikuti oleh seluruh karyawan.',
            ],
            [
                'gambar' => 'dokumentasi/workflow-approval.jpg',
                'deskripsi' => 'Dokumentasi alur kerja persetujuan untuk berbagai jenis dokumen dan keputusan dalam perusahaan. Menjelaskan hierarki persetujuan, waktu proses, dan tanggung jawab masing-masing posisi.',
            ],
            [
                'gambar' => null,
                'deskripsi' => 'Dokumentasi API endpoint untuk integrasi sistem eksternal. Berisi daftar semua API yang tersedia, parameter yang diperlukan, format response, dan contoh implementasi untuk developer.',
            ],
            [
                'gambar' => 'dokumentasi/training-material.jpg',
                'deskripsi' => 'Materi pelatihan untuk karyawan baru yang mencakup pengenalan sistem, budaya kerja, dan proses bisnis perusahaan. Dilengkapi dengan video tutorial dan quiz interaktif.',
            ],
        ];

        foreach ($dokumentasi as $doc) {
            Dokumentasi::create($doc);
        }
    }
}