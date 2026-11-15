# SI-NETINV — Sistem Informasi Manajemen Inventaris Jaringan & IT
**Tugas Proyek Mata Kuliah Pemrograman Framework (Sistem Informasi — Semester 3)**

Aplikasi web berbasis arsitektur **Model-View-Controller (MVC)** dengan **CodeIgniter 3 ([codeigniter.com](https://codeigniter.com/))**, **Bootstrap 5.3 ([getbootstrap.com](https://getbootstrap.com/))**, **PHP**, dan **MySQL/MariaDB** yang dijalankan melalui **Apache Web Server & phpMyAdmin ([apachefriends.org](https://www.apachefriends.org/download.html))**.

---

## Cakupan 7 Materi Perkuliahan
1. **Materi 1 — Pengenalan Framework**: Implementasi pola arsitektur *Model-View-Controller (MVC)* untuk memisahkan logika bisnis, pengolahan basis data, dan antarmuka pengguna.
2. **Materi 2 — Git dan GitHub**: Konfigurasi `.gitignore`, pengelolaan *commit history*, dan dokumentasi repositori standar menggunakan [Git SCM](https://git-scm.com/) dan [GitHub Docs](https://docs.github.com/en/repositories/creating-and-managing-repositories/quickstart-for-repositories).
3. **Materi 3 — Bootstrap**: Antarmuka responsif bergaya modern menggunakan [Bootstrap 5.3](https://getbootstrap.com/docs/5.3/getting-started/introduction/) dan ikon Font Awesome 6.
4. **Materi 4 — CodeIgniter**: Struktur modular `application/controllers`, `application/models`, `application/views`, `application/helpers`, dan `application/config`.
5. **Materi 5 — Sistem Login**: Autentikasi pengguna berbasis *session*, *password hashing* (`password_hash` & `password_verify`), registrasi akun baru, serta pembagian hak akses (*Role-Based Access Control* untuk **Administrator** dan **Member / Teknisi**).
6. **Materi 6 — Menu Management**: Pengelolaan menu navigasi *sidebar* dan *submenu* secara dinamis dari database (`user_menu`, `user_sub_menu`, `user_access_menu`).
7. **Materi 7 — CRUD (Create, Read, Update, Delete)**: Studi kasus manajemen inventaris perangkat infrastruktur jaringan & IT (Router MikroTik, NVR/IP Camera Hikvision, Radio Wireless Ubiquiti, Switch PoE, Fiber Optic Dropcore, dan OTDR) lengkap dengan pencarian, filter kondisi, dan cetak laporan.

---

## Akun Demo Login
| Role Pengguna | Email Login | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@siframework.ac.id` | `123456` | Akses penuh (Dashboard, Role Akses, Menu & Submenu Management, Profil, CRUD Inventaris, Materi) |
| **Member / Teknisi** | `teknisi@siframework.ac.id` | `123456` | Akses operasional (Profil, CRUD Inventaris, Laporan, Modul Materi) |

---

## Cara Instalasi di XAMPP (Apache & phpMyAdmin)
1. Pastikan aplikasi [XAMPP](https://www.apachefriends.org/download.html) sudah terinstal, lalu jalankan modul **Apache** dan **MySQL** melalui *XAMPP Control Panel*.
2. Ekstrak folder proyek ini ke dalam direktori `C:\xampp\htdocs\si_framework` (pastikan nama foldernya adalah `si_framework`, atau sesuaikan otomatis karena `base_url` telah diatur dinamis).
3. Buka [phpMyAdmin](https://www.phpmyadmin.net/) di browser melalui alamat `http://localhost/phpmyadmin`.
4. Buat database baru bernama **`db_si_framework`**, lalu klik tab **Import** dan pilih file `database/db_si_framework.sql` yang ada di dalam folder proyek ini.
5. Buka aplikasi di browser melalui alamat: **`http://localhost/si_framework`**
