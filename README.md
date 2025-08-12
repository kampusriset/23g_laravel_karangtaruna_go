<p align="center">
<img src="public/images/Logo1.jpg" alt="KarangTarunaGO" width="600px"/>
    
<p align="center">
    <a href="https://laravel.com"><img alt="Laravel v11+" src="https://img.shields.io/badge/Laravel-v11+-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://php.net"><img alt="PHP 8.2+" src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php"></a>
</p>
<h2 align="center">KarangTarunaGO</h2>
 <p align="center">Manajemen Kegiatan Pemuda Dusun</p>
</p>


>Laravel

>[!NOTE]\
> Framework PHP yang populer untuk membangun aplikasi web modern dengan arsitektur MVC (Model-View-Controller). Laravel menyediakan sintaks yang elegan, fitur bawaan seperti routing, autentikasi, dan ORM Eloquent untuk mempermudah pengembangan aplikasi.
> A popular PHP framework for building modern web applications using the MVC (Model-View-Controller) architecture. Laravel offers elegant syntax and built-in features such as routing, authentication, and the Eloquent ORM to simplify application development.

>Filament

>[!NOTE]\
> Paket (package) Laravel berbasis PHP yang menyediakan antarmuka admin modern, responsif, dan mudah digunakan untuk mengelola data aplikasi. Filament memiliki komponen siap pakai seperti tabel, formulir, dan grafik, serta dapat dikustomisasi sesuai kebutuhan proyek.
> A PHP package for Laravel that provides a modern, responsive, and easy-to-use admin interface for managing application data. Filament includes ready-to-use components such as tables, forms, and charts, and can be customized to fit project needs.

# Awalan Install

Untuk meng-clone proyek ini, ikuti langkah-langkah berikut:

1. Pada **XAMPP** > **Config** > **php.ini**, cari `;extension=intl` lalu ubah menjadi `extension=intl`.  
   Simpan, matikan XAMPP, lalu nyalakan kembali.
2. Pada **phpMyAdmin** > **Import**, cari folder `sql` pada proyek > pilih file `karangtaruna_go` > klik **Kirim**.

Selanjutnya jalankan perintah berikut:

```md
git clone https://github.com/kampusriset/23g_laravel_karangtaruna_go.git

cd karangtaruna_go

composer install

php artisan filament:install --panels

php artisan serve
```

> [!WARNING]\
> Pastikan composer dan php versi terbaru, laravel versi 12.

#### Mengunakan Teknologi

Pada projek KarangTarunaGo: Manajemen Kegiatan Pemuda Dusun mengunakan teknoligi laravel 12 dan Filament dengan fitur sebagai berikut (`Dahsbord`, `Agenda Kegiatan`, `Data Anggota`, `Kategori Keuangan`, `Pencatatan Keuangan`).

</p>

| Keunggulan + Kekurangan | Description (ID + EN)                                                                                                                                                                   |
| ----------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Keunggulan              | Antarmuka admin modern dan responsif yang memudahkan navigasi / Modern and responsive admin interface for easier navigation.                                                            |
| Keunggulan              | Integrasi mudah dengan Laravel sehingga proses pengembangan lebih cepat / Easy integration with Laravel for faster development.                                                         |
| Keunggulan              | Mendukung berbagai komponen siap pakai seperti tabel, form, grafik / Supports various ready-to-use components like tables, forms, and charts.                                           |
| Keunggulan              | Dokumentasi lengkap dan komunitas aktif untuk membantu pemula / Comprehensive documentation and active community support for beginners.                                                 |
| Keunggulan              | Mudah dikustomisasi sesuai kebutuhan proyek / Highly customizable to suit project needs.                                                                                                |
| Kekurangan              | Membutuhkan pemahaman Laravel terlebih dahulu sehingga kurang cocok untuk pemula yang belum mengenal Laravel / Requires Laravel knowledge, making it less ideal for complete beginners. |
| Kekurangan              | Fitur lanjutan memerlukan konfigurasi tambahan yang cukup kompleks / Advanced features require additional, sometimes complex, configuration.                                            |
| Kekurangan              | Performa bisa berkurang jika memuat data sangat besar tanpa optimisasi / Performance may degrade with very large datasets if not optimized.                                             |
| Kekurangan              | Desain bawaan cenderung seragam sehingga butuh penyesuaian jika ingin tampilan unik / Default design is somewhat uniform, requiring customization for a unique look.                    |
| Kekurangan              | Bergantung pada update Laravel dan Filament sehingga perlu menyesuaikan versi / Dependent on Laravel and Filament updates, requiring version compatibility adjustments.                 |

### Tampilan

Tampilan projek :

<img src="public/images/Dashboard.png" alt="KarangTarunaGO" width="600px"/>

<img src="public/images/Dokumentasi.png" alt="KarangTarunaGO" width="600px"/>

<img src="public/images/Komentar.png" alt="KarangTarunaGO" width="600px"/>

<img src="public/images/Diskusi.png" alt="KarangTarunaGO" width="600px"/>

Thanks! :heart:

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    <img src="https://github.com/filamentphp/filament/assets/41773797/8d5a0b12-4643-4b5c-964a-56f0db91b90a" alt="Banner" style="width: 100%; max-width: 800px;" />
</p>
