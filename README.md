# WinDiag.AI — Sistem Pakar Diagnosa BSOD

Aplikasi berbasis Laravel 12 untuk membantu mendiagnosa **Bug Check Code / BSOD**
dan kegagalan booting Windows menggunakan metode **Certainty Factor (CF)**.

## Teknologi

- Laravel 12 + PHP 8.2/8.4
- Vite + Tailwind CSS
- PostgreSQL (Neon) — connection string disimpan sebagai `DB_URL`
- Vercel Container Runtime + FrankenPHP (Caddy)
- Auto-deploy dari GitHub ke Vercel

## Fitur

- Daftar gejala dan aturan (`symptoms`, `rules`, `hypotheses`) dari `ExpertSystemSeeder`.
- Form konsultasi gejala dengan nilaiCF user.
- Perhitungan CF tunggal dan CF gabungan antar aturan.
- Tampilan hasil diagnosa utama beserta langkah perhitungan dan saran perbaikan.

## Menjalankan secara lokal

```powershell
composer install
npm install
cp .env.example .env
php artisan key:generate

# Isi DB_CONNECTION/DB_URL di .env, lalu:
php artisan migrate --force
php artisan db:seed --class=ExpertSystemSeeder --force

npm run build
php artisan serve
```

Jika memakai Neon dengan PHP lokal yang masih memakai libpq lama, aktifkan
`extension=pdo_pgsql` di `php.ini` dan set `DB_ENDPOINT=<endpoint-id>` saat
menjalankan migrasi (lihat `DEPLOY.md`).

## Deployment

Panduan lengkap ada di [`DEPLOY.md`](DEPLOY.md).

**Production URL:** <https://windiag-ai.vercel.app>

Setiap push ke branch `main` akan otomatis di-build dan di-deploy ke Vercel.
Environment variable disimpan di Vercel Project Settings, bukan di repository.

Repository GitHub: <https://github.com/rahmatridhop-code/windiag-ai>
