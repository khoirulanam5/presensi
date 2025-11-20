# 🚀 Aplikasi Presensi Pegawai  
### *Presensi berbasis Geolocation & Selfie – Role Admin, Pegawai, dan Pimpinan*

Aplikasi ini merupakan sistem presensi pegawai yang dibangun menggunakan **CodeIgniter 3**, dengan fitur utama **presensi berbasis lokasi (geolocation)** serta **verifikasi foto selfie**. Sistem mendukung multi-role (Admin, Pegawai, dan Pimpinan) sehingga pengelolaan data menjadi lebih terstruktur dan modern.

---

## 📌 Fitur Utama

### 👤 Pegawai
- Presensi masuk dan pulang menggunakan **GPS + Selfie**
- Validasi jarak berdasarkan titik lokasi kantor
- Histori presensi pribadi
- Tampilan mobile-friendly

### 🧑‍💼 Admin
- Kelola data pegawai
- Kelola absensi (approve/reject/edit)
- Kelola titik lokasi kantor
- Rekap presensi harian, mingguan, bulanan
- Export laporan ke PDF/Excel (jika tersedia)

### 🧑‍⚖️ Pimpinan
- Lihat laporan presensi seluruh pegawai
- Statistik absensi (grafik dan ringkasan)
- Monitoring keterlambatan secara real-time

---

## 🛠️ Teknologi yang Digunakan

| Bagian         | Teknologi                       |
|----------------|----------------------------------|
| Backend        | CodeIgniter 3                    |
| Frontend       | HTML, CSS, JavaScript, Bootstrap |
| Database       | MySQL                            |
| Geolocation    | HTML5 Geolocation API            |
| Upload Selfie  | Kamera Browser + File Upload CI  |

---

## 📂 Struktur Direktori (Ringkas)

```
/application
    /controllers
    /models
    /views
/assets
    /css
    /js
    /images
/database
    presensi.sql
/uploads
    /absensi
```

---

## 📥 Instalasi & Setup

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/nama-project.git
```

### 2️⃣ Pindahkan ke Folder Server Local
Letakkan pada:
```
htdocs/ (XAMPP) atau public_html (hosting)
```

### 3️⃣ Import Database
- Buka **phpMyAdmin**
- Buat database baru
- Import file:
```
database/presensi.sql
```

### 4️⃣ Konfigurasi Database

**application/config/database.php**
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'presensi',
    'dbdriver' => 'mysqli'
);
```

### 5️⃣ Setting Base URL

**application/config/config.php**
```php
$config['base_url'] = 'http://localhost/nama-project/';
```

---

## 🌍 Pengaturan Geolocation

Agar fitur lokasi berjalan dengan optimal:
- Pastikan browser mengizinkan akses lokasi
- GPS aktif (khusus mobile)
- Gunakan browser modern seperti Chrome/Firefox
- Koneksi internet stabil

---

## 📸 Mekanisme Foto Selfie

Aplikasi menggunakan kamera perangkat (webcam atau kamera smartphone).  
Hasil foto otomatis disimpan ke:

```
/uploads/absensi/
```

Format file: `.jpg` atau `.png`

---

## 🔐 Akun Login Default

| Role      | Username | Password |
|-----------|----------|----------|
| Admin     | admin    | admin    |
| Pegawai   | pegawai  | pegawai  |
| Pimpinan  | pimpinan | pimpinan |

> **Segera ganti password setelah login untuk keamanan.**

---

## 📊 Screenshot (Opsional)

Tambahkan screenshot seperti:
- Halaman presensi
- Dashboard Admin
- Statistik presensi

---

## 📝 Lisensi

Project ini bersifat internal dan bebas kamu modifikasi sesuai kebutuhan.

---

## 💡 Kontribusi

Pull request sangat diterima.  
Jika kamu menemukan bug atau memiliki ide fitur baru, silakan buat *issue*.

---

### ⭐ Jika repo ini membantu, jangan lupa beri **Star** di GitHub!
