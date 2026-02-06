Project Management System 

Aplikasi manajemen proyek berbasis web ini dirancang dengan sistem Role-Based Access Control (RBAC) untuk memfasilitasi kolaborasi tim dalam mengelola tugas, anggota, dan progres kerja secara real-time.

I. Cara Install & Run (Step-by-Step)
    Dari Gitbash
        Pastikan perangkat Anda sudah terinstal PHP >= 8.2, Composer, Node.js & NPM, serta MySQL.

1. Clone Repository Buka terminal dan jalankan perintah:

GitBash
    git clone <https://github.com/raafllyy/project_management.git>
    cd project_management

2. Install Dependencies Instal paket PHP dan JavaScript yang diperlukan:

GitBash
    composer install
    npm install

3. Konfigurasi Environment Salin file .env.example menjadi .env:

GitBash
    cp .env.example .env

4. Buka file .env dan sesuaikan bagian database (pastikan database sudah dibuat di MySQL Anda):

Cuplikan kode
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=management_app
    DB_USERNAME=root
    DB_PASSWORD=

5. Generate App Key

GitBash
    php artisan key:generate

6. Migrasi Database & Seeding Jalankan perintah ini untuk membuat tabel otomatis dan mengisi data awal (Admin, PM, Member) sesuai spesifikasi soal:

GitBash
    php artisan migrate --seed
    
7. Compile Frontend Asset

GitBash
    npm run build
    
8. Jalankan Aplikasi

GitBash
    php artisan serve
        Aplikasi dapat diakses di: http://127.0.0.1:8000

II. Struktur Database
        Sistem menggunakan database relasional MySQL dengan struktur modular untuk mendukung skalabilitas:


users: Menyimpan identitas pengguna dan kredensial login.


projects: Menyimpan data utama proyek termasuk nama, deskripsi, deadline, dan creator (Project Manager).


tasks: Menyimpan daftar pekerjaan spesifik dengan atribut deskripsi, deadline, dan status (Todo, In Progress, Done).


roles & permissions: Mengelola hak akses berdasarkan role (Admin, Project Manager, Member).


project_user (Pivot): Tabel penghubung untuk fitur penugasan anggota tim ke dalam proyek tertentu.

III. Deskripsi Singkat Arsitektur
        Aplikasi dikembangkan menggunakan Laravel Framework dengan pola MVC (Model-View-Controller) untuk memastikan kode modular dan aman.

Role-Based Access Control (RBAC):


Admin: Memiliki otoritas penuh untuk mengelola user dan role.


Project Manager: Berwenang membuat proyek, mengelola data proyek, dan menentukan anggota tim.


Member: Dibatasi hanya untuk melihat proyek yang ditugaskan dan memperbarui progres task (status).


Dashboard Ringkasan: Dashboard menyajikan data progres proyek secara otomatis yang dihitung berdasarkan persentase task yang telah mencapai status 'Done'.


Keamanan: Implementasi validasi input yang ketat dan sanitasi data di setiap layer untuk mencegah celah keamanan seperti SQL Injection dan XSS.


API Integration: Menyediakan minimal 5 API endpoint berbasis JSON untuk kebutuhan integrasi data eksternal.

Link Aplikasi Live (Railway): "https://projectmanagement-production-fcb6.up.railway.app/"

Akun Tester:
1. Admin: 
    email : admin@example.com 
    Pass: password
2.
Project Manager: 
    email : pm@example.com 
    Pass: password
3.
Member: 
    email : member@example.com 
    Pass: password
