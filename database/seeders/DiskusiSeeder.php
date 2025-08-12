<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diskusi;
use App\Models\Komentar;
use App\Models\User;

class DiskusiSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada user untuk testing
        $users = User::all();
        if ($users->count() < 4) {
            // Buat user sample jika belum ada
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
            User::factory()->create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ]);
            User::factory()->create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
            ]);
            User::factory()->create([
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
            ]);
            $users = User::all();
        }

        // Buat diskusi sample
        $diskusi1 = Diskusi::create([
            'user_id' => $users->first()->id,
            'teks' => 'Tim, saya ingin membahas mengenai implementasi fitur notifikasi real-time di sistem kita. Apakah ada yang punya pengalaman dengan WebSocket atau Server-Sent Events? Menurut kalian mana yang lebih cocok untuk kebutuhan kita?',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

        $diskusi2 = Diskusi::create([
            'user_id' => $users->skip(1)->first()->id,
            'teks' => 'Ada update terbaru mengenai kebijakan keamanan data. Mulai minggu depan, semua akses ke database production harus melalui VPN dan menggunakan 2FA. Mohon persiapkan credential masing-masing ya.',
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        $diskusi3 = Diskusi::create([
            'user_id' => $users->skip(2)->first()->id,
            'teks' => 'Meeting review sprint kemarin sangat produktif. Untuk sprint berikutnya, kita fokus pada optimasi performance dan penambahan fitur dashboard analytics. Ada masukan atau concern yang ingin disampaikan?',
            'created_at' => now()->subHours(6),
            'updated_at' => now()->subHours(6),
        ]);

        $diskusi4 = Diskusi::create([
            'user_id' => $users->first()->id,
            'teks' => 'Laporan bug dari QA team menunjukkan ada issue di module laporan. Sepertinya ada masalah dengan query pagination ketika data lebih dari 1000 records. Tim backend bisa investigate?',
            'created_at' => now()->subHours(3),
            'updated_at' => now()->subHours(3),
        ]);

        $diskusi5 = Diskusi::create([
            'user_id' => $users->skip(3)->first()->id,
            'teks' => 'Selamat untuk peluncuran fitur export PDF yang sukses! User feedback sangat positif. Selanjutnya kita akan fokus pada fitur import bulk data. Estimated timeline sekitar 2 minggu.',
            'created_at' => now()->subHour(),
            'updated_at' => now()->subHour(),
        ]);

        // Buat komentar untuk diskusi
        $komentar = [
            // Komentar untuk diskusi 1
            [
                'diskusi_id' => $diskusi1->id,
                'user_id' => $users->skip(1)->first()->id,
                'teks' => 'Saya pernah implement WebSocket dengan Socket.io untuk project sebelumnya. Cukup reliable dan mudah di-scale. Tapi untuk kebutuhan sederhana, Server-Sent Events lebih lightweight.',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'diskusi_id' => $diskusi1->id,
                'user_id' => $users->skip(2)->first()->id,
                'teks' => 'Setuju dengan John. Kalau cuma untuk notifikasi simple seperti update status atau alert, SSE sudah cukup. WebSocket lebih cocok kalau butuh komunikasi bidirectional.',
                'created_at' => now()->subDay()->addMinutes(30),
                'updated_at' => now()->subDay()->addMinutes(30),
            ],
            [
                'diskusi_id' => $diskusi1->id,
                'user_id' => $users->skip(3)->first()->id,
                'teks' => 'Ada benchmark comparison antara keduanya? Dari segi resource consumption dan scalability gimana?',
                'created_at' => now()->subHours(23),
                'updated_at' => now()->subHours(23),
            ],

            // Komentar untuk diskusi 2
            [
                'diskusi_id' => $diskusi2->id,
                'user_id' => $users->skip(2)->first()->id,
                'teks' => 'Thanks infonya. Sudah setup VPN dan 2FA dari kemarin. Processnya smooth, dokumentasinya juga lengkap.',
                'created_at' => now()->subHours(20),
                'updated_at' => now()->subHours(20),
            ],
            [
                'diskusi_id' => $diskusi2->id,
                'user_id' => $users->skip(3)->first()->id,
                'teks' => 'Credential 2FA saya belum aktif. Nanti siang mau setup dulu. Ada contact person IT yang bisa dibantu kalau ada issue?',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(18),
            ],
            [
                'diskusi_id' => $diskusi2->id,
                'user_id' => $users->first()->id,
                'teks' => '@Bob bisa contact Sarah dari IT support. Extension 234 atau email sarah.it@company.com',
                'created_at' => now()->subHours(17),
                'updated_at' => now()->subHours(17),
            ],

            // Komentar untuk diskusi 3
            [
                'diskusi_id' => $diskusi3->id,
                'user_id' => $users->skip(1)->first()->id,
                'teks' => 'Dashboard analytics sounds great! Apakah akan include real-time metrics atau historical data saja?',
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'diskusi_id' => $diskusi3->id,
                'user_id' => $users->skip(3)->first()->id,
                'teks' => 'Performance optimization sangat diperlukan, terutama di halaman yang load data besar. Priority tinggi.',
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],

            // Komentar untuk diskusi 4
            [
                'diskusi_id' => $diskusi4->id,
                'user_id' => $users->skip(2)->first()->id,
                'teks' => 'Issue pagination sudah saya reproduce di local. Sepertinya ada memory leak di query builder. Akan investigate lebih lanjut hari ini.',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'diskusi_id' => $diskusi4->id,
                'user_id' => $users->skip(1)->first()->id,
                'teks' => 'Temporary solution: bisa limit max records per page jadi 500 dulu sambil fix permanent solution.',
                'created_at' => now()->subMinutes(90),
                'updated_at' => now()->subMinutes(90),
            ],

            // Komentar untuk diskusi 5
            [
                'diskusi_id' => $diskusi5->id,
                'user_id' => $users->skip(1)->first()->id,
                'teks' => 'Great job team! User satisfaction score naik 15% sejak fitur PDF export diluncurkan.',
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(45),
            ],
            [
                'diskusi_id' => $diskusi5->id,
                'user_id' => $users->skip(2)->first()->id,
                'teks' => 'Untuk import bulk data, apakah akan support multiple file formats? CSV, Excel, JSON?',
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'diskusi_id' => $diskusi5->id,
                'user_id' => $users->first()->id,
                'teks' => 'Planning untuk support CSV dan Excel dulu. JSON bisa jadi enhancement di sprint selanjutnya.',
                'created_at' => now()->subMinutes(15),
                'updated_at' => now()->subMinutes(15),
            ],
        ];

        foreach ($komentar as $comment) {
            Komentar::create($comment);
        }
    }
}