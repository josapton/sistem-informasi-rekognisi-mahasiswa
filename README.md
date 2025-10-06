# Sistem Informasi Rekognisi Mahasiswa

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) ![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

Repositori ini berisi kode sumber untuk aplikasi web Sistem Informasi Rekognisi Mahasiswa. Aplikasi ini dirancang untuk memfasilitasi proses pengajuan, validasi, dan konversi kegiatan non-akademik mahasiswa menjadi Satuan Kredit Semester (SKS) atau bentuk pengakuan lainnya.



---

## 🎯 Tujuan Aplikasi

Tujuan utama dari sistem ini adalah untuk:
1.  **Mendigitalkan Proses**: Mengubah proses manual pengajuan dan validasi rekognisi menjadi sistem online yang terpusat dan efisien.
2.  **Memberikan Apresiasi**: Memberikan pengakuan formal terhadap prestasi dan kegiatan mahasiswa di luar kelas.
3.  **Transparansi**: Menyediakan alur kerja yang transparan bagi mahasiswa, dosen (Kaprodi), dan admin dalam melacak status pengajuan.
4.  **Pelaporan Terpusat**: Memudahkan pihak akademik dalam melakukan rekapitulasi dan pelaporan kegiatan rekognisi mahasiswa.

---

## ✨ Fitur Utama

Sistem ini memiliki tiga hak akses utama dengan fitur yang berbeda:

### 👤 Admin
- **Manajemen User**: Dapat menambah, mengubah, dan menghapus data semua user (Admin, Kaprodi, Mahasiswa).
- **Manajemen Kegiatan**: Mengelola daftar kegiatan MBKM atau lainnya yang dapat diikuti oleh mahasiswa.
- **Validasi Pengajuan**: Memiliki wewenang penuh untuk memvalidasi semua jenis pengajuan (pendaftaran kegiatan, konversi SKS).
- **Dashboard Global**: Melihat statistik keseluruhan sistem, seperti jumlah user, total kegiatan, dan jumlah pengajuan yang tertunda.

### 🎓 Kaprodi (Kepala Program Studi)
- **Validasi Alur**: Memvalidasi pendaftaran kegiatan mahasiswa dan menyetujui/menolak pengajuan konversi SKS.
- **Modifikasi Pengajuan**: Dapat memodifikasi detail pengajuan konversi dari mahasiswa sebelum divalidasi.
- **Pengembalian untuk Revisi**: Dapat mengembalikan pengajuan kepada mahasiswa untuk diperbaiki.
- **Dashboard Jurusan**: Melihat statistik pengajuan yang relevan dengan program studinya.

### 👨‍🎓 Mahasiswa
- **Tabungan SKS**: Memiliki "Tabungan SKS" yang didapat dari kegiatan yang telah divalidasi.
- **Pendaftaran Kegiatan**: Dapat mendaftar pada kegiatan yang tersedia dan mengunggah laporan.
- **Pengajuan Konversi**:
    - Mengajukan konversi kegiatan menjadi SKS.
    - Mengajukan konversi "Tabungan SKS" menjadi mata kuliah atau mikrokredensial (proyek, praktik, dll.) melalui form dinamis.
- **Dashboard Personal**: Melihat ringkasan status semua kegiatan dan pengajuan miliknya, serta sisa "Tabungan SKS".
- **Riwayat**: Melihat seluruh riwayat pengajuan yang pernah dilakukan.

### 🔒 Keamanan
- **Login dengan reCAPTCHA**: Halaman login diamankan dengan Google reCAPTCHA v2 untuk mencegah bot.
- **Manajemen Role & Middleware**: Hak akses setiap halaman dibatasi secara ketat berdasarkan role pengguna.
- **Redirect Aman**: Link eksternal (seperti WhatsApp) disembunyikan di balik route untuk menjaga privasi.

---

## 🛠️ Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal.

**Prasyarat:**
- PHP >= 8.1
- Composer
- Node.js & NPM
- Database (MySQL/MariaDB)

**Langkah-langkah:**

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/josapton/sistem-informasi-rekognisi-mahasiswa.git
    cd sistem-informasi-rekognisi-mahasiswa
    ```

2.  **Install Dependensi**
    Install semua package PHP yang dibutuhkan dengan Composer.
    ```bash
    composer install
    ```

3.  **Setup File `.env`**
    Salin file `.env.example` menjadi `.env` dan konfigurasikan koneksi database Anda.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan sesuaikan baris berikut:
    ```env
    APP_LOCALE=id
    APP_FALLBACK_LOCALE=id
    APP_FAKER_LOCALE=id_ID

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=password_anda

    WHATSAPP_CONTACT_NUMBER=62123456789
    ```

4.  **Tambahkan Kunci reCAPTCHA**
    Tambahkan Site Key dan Secret Key Google reCAPTCHA Anda ke file `.env`.
    ```env
    NOCAPTCHA_SITEKEY=ISI_DENGAN_SITE_KEY_ANDA
    NOCAPTCHA_SECRET=ISI_DENGAN_SECRET_KEY_ANDA
    ```

5.  **Generate Kunci Aplikasi**
    ```bash
    php artisan key:generate
    ```

6.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan di database Anda.
    ```bash
    php artisan migrate
    ```
    *Opsional: Jika Anda ingin mengisi data awal (dummy data), jalankan seeder.*
    ```bash
    php artisan db:seed
    ```

7.  **Jalankan Server Pengembangan**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

---

## 🤝 Kontribusi
Kontribusi ke branch `dev` dalam bentuk *pull request*, laporan *bug*, atau saran fitur sangat kami hargai.

---

© 2025 - Teknik Informatika Universitas Boyolali