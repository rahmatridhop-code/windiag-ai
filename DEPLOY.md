# Deploy Windiag AI ke Vercel (Laravel + FrankenPHP)

Panduan ini menyiapkan aplikasi Laravel ini sebagai **Vercel Container Function**
menggunakan FrankenPHP. Database tidak disimpan di Vercel, melainkan di
PostgreSQL eksternal (contoh: Neon).

## File yang ditambahkan / diubah

- `Dockerfile.vercel` — build asset Vite + install Composer produksi + menjalankan FrankenPHP.
- `Caddyfile` — hanya membuka `public/`, meneruskan request ke `index.php`.
- `vercel.json` — mendefinisikan service container dan rewrite semua request ke app.
- `.dockerignore` — mencegah `.env`, `vendor`, `node_modules`, dan asset lama masuk ke image.
- `bootstrap/app.php` — mempercayai proxy Vercel agar URL asset tetap `https://`.
- `app/Database/NeonPostgresConnector.php` + `app/Providers/AppServiceProvider.php`
  — meneruskan opsi `endpoint=<id>` **hanya jika** `DB_ENDPOINT` diisi. Ini
  dibutuhkan PHP lokal dengan libpq lama. Di Vercel, `DB_ENDPOINT` sengaja
  **tidak** diisi karena libpq bawaan container sudah mendukung SNI; mengisi
  opsi ini di Vercel justru menyebabkan error "Inconsistent project name".

---

## 1. Buat database eksternal (Neon/PostgreSQL)

1. Daftar/masuk ke <https://neon.tech> → **New Project**.
2. Pilih region **Singapore (ap-southeast-1)** bila tersedia.
3. Setelah database dibuat, salin **connection string pooled**-nya.
   Bentuknya seperti:

   ```text
   postgresql://user:password@ep-xxx-pooler.ap-southeast-1.aws.neon.tech/neondb?sslmode=require
   ```

4. Simpan sementara di tempat aman. String ini akan dipakai sebagai `DB_URL`.

> Alternatif: jika lebih nyaman dengan MySQL, gunakan `DB_CONNECTION=mysql`
> dan `DB_URL=mysql://user:pass@host:3306/db`. Komputer Anda sudah memiliki
> `pdo_mysql`, jadi tidak perlu mengaktifkan ekstensi tambahan.

### Cara aman menyerahkan DB_URL ke agent

Jangan menempel connection string di chat. Simpan ke file berikut di folder proyek:

```powershell
notepad .db-url.local
```

Tempel connection string, simpan, lalu tutup. File ini sudah masuk `.gitignore`
dan akan saya hapus setelah dibaca ke Environment Variables Vercel.

---

## 2. Aktifkan ekstensi PostgreSQL di PHP lokal (khusus Neon)

Migration dijalankan dari komputer Anda, jadi PHP CLI perlu `pdo_pgsql`.

1. Buka `C:\xampp\php\php.ini`.
2. Cari dan hapus tanda `;` di depan baris ini:

   ```ini
   extension=pdo_pgsql
   extension=pgsql
   ```

3. Cek kembali:

   ```powershell
   php -m | findstr pgsql
   ```

   Harus muncul `pdo_pgsql` dan `pgsql`.

---

## 3. Buat APP_KEY

Jalankan di folder proyek:

```powershell
php artisan key:generate --show
```

Salin nilai yang muncul (diawali `base64:`). Nilai ini akan dimasukkan ke
Environment Variables Vercel sebagai `APP_KEY`. Jangan commit ke Git.

---

## 4. Login dan link project Vercel

```powershell
npx vercel login
```

Selesaikan login lewat browser yang terbuka. Setelah itu:

```powershell
npx vercel link
```

Ikuti prompt: pilih scope/team dan nama project (misalnya `windiag-ai`).

---

## 5. Isi Environment Variables di Vercel

Jalankan satu per satu, lalu paste nilainya saat diminta:

```powershell
npx vercel env add APP_NAME production
npx vercel env add APP_KEY production
npx vercel env add APP_ENV production
npx vercel env add APP_DEBUG production
npx vercel env add APP_URL production
npx vercel env add DB_CONNECTION production
npx vercel env add DB_URL production
npx vercel env add DB_SSLMODE production
npx vercel env add SESSION_DRIVER production
npx vercel env add CACHE_STORE production
npx vercel env add QUEUE_CONNECTION production
npx vercel env add LOG_CHANNEL production
```

Nilai yang disarankan:

| Variable | Nilai |
| --- | --- |
| `APP_NAME` | `Windiag AI` |
| `APP_KEY` | hasil `php artisan key:generate --show` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://windiag-ai.vercel.app` (sesuaikan dengan URL asli) |
| `DB_CONNECTION` | `pgsql` |
| `DB_URL` | connection string Neon dari langkah 1 |
| `DB_SSLMODE` | `require` |
| `SESSION_DRIVER` | `database` |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `sync` |
| `LOG_CHANNEL` | `stderr` |

> `sync` dipilih karena aplikasi ini belum memakai job antrean. Jika nanti
> ada job berat, gunakan antrean eksternal + worker terpisah.

---

## 6. Migrasi + seed data pakar

Jalankan dari folder proyek dengan env sementara (menimpa `.env` lokal):

```powershell
$env:DB_CONNECTION = 'pgsql'
$env:DB_URL = 'postgresql://user:password@ep-xxx-pooler.ap-southeast-1.aws.neon.tech/neondb?sslmode=require'
$env:DB_PORT = '5432'
$env:DB_SSLMODE = 'require'
# Hanya jika PHP lokal Anda masih memakai libpq lama (error "Endpoint ID is not specified"):
$env:DB_ENDPOINT = 'ep-xxx'

php artisan migrate --force
php artisan db:seed --class=ExpertSystemSeeder --force
```

`ExpertSystemSeeder` adalah seeder yang mengisi gejala, hipotesis, dan aturan
diagnosa. `DatabaseSeeder` hanya membuat user contoh dan tidak diperlukan.

> Lakukan ini sebelum/segera setelah deploy pertama. Jangan menjalankan
> migrasi dari dalam container, karena beberapa instance bisa start bersamaan.

---

## 7. Deploy

```powershell
npx vercel deploy --prod
```

Setelah deployment selesai, buka URL yang diberikan Vercel. Jika `APP_URL`
berbeda, perbarui env `APP_URL`, lalu deploy ulang:

```powershell
npx vercel env rm APP_URL production
npx vercel env add APP_URL production
npx vercel deploy --prod
```

---

## 8. Git + auto-deploy (sudah aktif)

- Repository: <https://github.com/rahmatridhop-code/windiag-ai> (public)
- Branch produksi: `main`
- Setiap `git push origin main` otomatis memicu deployment production di Vercel.
- Vercel GitHub App sudah terhubung ke project `ridho-z/windiag-ai`.
- Environment variable tetap disimpan di Vercel, tidak ikut ke repository.

```powershell
git add .
git commit -m "Deskripsi perubahan"
git push origin main
```

Aliases yang aktif:

- <https://windiag-ai.vercel.app>
- <https://windiag-ai-ridho-z.vercel.app>
- <https://windiag-ai-git-main-ridho-z.vercel.app>

---

## Catatan operasional

- File system container tidak awet. Jangan menyimpan upload ke `storage/app/public`;
  gunakan object storage bila nanti dibutuhkan.
- Log aplikasi bisa dilihat di **Vercel → Project → Runtime Logs**
  (`LOG_CHANNEL=stderr`).
- Tidak ada queue worker / scheduler di container. Aplikasi ini belum
  memakai keduanya.
- Jika response `502`: cek Runtime Logs. Penyebab umum adalah `APP_KEY`
  belum diisi atau FrankenPHP gagal start.
- Jika asset tampil tanpa CSS karena mixed content, pastikan
  `$middleware->trustProxies(at: '*')` tetap ada di `bootstrap/app.php`.
