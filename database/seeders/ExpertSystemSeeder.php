<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hypothesis;
use App\Models\Symptom;
use App\Models\Rule;

class ExpertSystemSeeder extends Seeder
{
    public function run(): void
    {
        $h1 = Hypothesis::create([
            'code' => 'H01',
            'name' => 'Kerusakan Modul RAM atau Slot Memori',
            'category' => 'Hardware - Memori',
            'solution' => '1. Matikan perangkat dan cabut sumber daya.<br>2. Lepas modul RAM, bersihkan pin kuningan secara perlahan menggunakan penghapus karet lembut.<br>3. Pasang kembali ke slot yang berbeda dan uji menggunakan <em>Windows Memory Diagnostic</em>.'
        ]);

        $h2 = Hypothesis::create([
            'code' => 'H02',
            'name' => 'Kerusakan Media Penyimpanan (SSD/HDD Bad Sector)',
            'category' => 'Hardware - Storage',
            'solution' => '1. Masuk ke BIOS dan pastikan SSD/HDD terdeteksi.<br>2. Periksa sambungan kabel SATA atau slot M.2 NVMe.<br>3. Masuk ke <em>Windows Recovery (Command Prompt)</em> dan jalankan perintah <code>chkdsk C: /f /r</code> serta <code>bootrec /fixboot</code>.'
        ]);

        $h3 = Hypothesis::create([
            'code' => 'H03',
            'name' => 'Konflik Driver Perangkat Keras atau Update Windows',
            'category' => 'Software - OS & Driver',
            'solution' => '1. Boot ke dalam <em>Windows Safe Mode</em>.<br>2. Buka <em>Device Manager</em>, klik kanan pada driver yang baru diperbarui (seperti VGA/Chipset) lalu pilih <strong>Roll Back Driver</strong>.<br>3. Gunakan <em>System Restore</em> untuk kembali ke kondisi sistem sebelum pembaruan.'
        ]);

        $h4 = Hypothesis::create([
            'code' => 'H04',
            'name' => 'Gangguan Suplai Daya (PSU) atau Overheating Termal',
            'category' => 'Hardware - Daya & Termal',
            'solution' => '1. Bersihkan debu pada kipas pendingin (<em>heatsink</em>) dan ganti pasta termal prosesor.<br>2. Pastikan adapter charger atau Power Supply menyuplai tegangan yang stabil.<br>3. Hindari penggunaan laptop di atas permukaan empuk yang menutup ventilasi udara.'
        ]);

        $h5 = Hypothesis::create([
            'code' => 'H05',
            'name' => 'Kesalahan Konfigurasi BIOS / UEFI atau Baterai CMOS',
            'category' => 'Firmware - BIOS',
            'solution' => '1. Masuk ke menu BIOS saat startup (tombol F2/Del).<br>2. Pastikan mode booting (UEFI vs Legacy) dan urutan <em>Boot Priority</em> sudah sesuai.<br>3. Jika jam sistem selalu ter-reset, ganti baterai CMOS (CR2032) pada motherboard.'
        ]);

        $symptomsData = [
            ['code' => 'G01', 'desc' => 'Muncul stop code MEMORY_MANAGEMENT atau PAGE_FAULT_IN_NONPAGED_AREA', 'hyp' => $h1->id, 'cf' => 0.85],
            ['code' => 'G02', 'desc' => 'Komputer sering freeze atau random restart saat membuka aplikasi berat', 'hyp' => $h1->id, 'cf' => 0.65],
            ['code' => 'G03', 'desc' => 'Terdengar bunyi beep pendek berulang atau lampu indikator DRAM menyala', 'hyp' => $h1->id, 'cf' => 0.90],
            ['code' => 'G04', 'desc' => 'Muncul stop code INACCESSIBLE_BOOT_DEVICE atau CRITICAL_PROCESS_DIED', 'hyp' => $h2->id, 'cf' => 0.85],
            ['code' => 'G05', 'desc' => 'Sistem terjebak (stuck) di logo Windows atau Automatic Repair Loop', 'hyp' => $h2->id, 'cf' => 0.70],
            ['code' => 'G06', 'desc' => "Muncul pesan 'No Bootable Device Found' atau SSD/HDD hilang di BIOS", 'hyp' => $h2->id, 'cf' => 0.90],
            ['code' => 'G07', 'desc' => 'Muncul stop code DRIVER_IRQL_NOT_LESS_OR_EQUAL atau VIDEO_TDR_FAILURE', 'hyp' => $h3->id, 'cf' => 0.85],
            ['code' => 'G08', 'desc' => 'BSOD terjadi tepat setelah instalasi driver baru atau Windows Update', 'hyp' => $h3->id, 'cf' => 0.90],
            ['code' => 'G09', 'desc' => 'Komputer dapat masuk dan berjalan normal di mode Windows Safe Mode', 'hyp' => $h3->id, 'cf' => 0.75],
            ['code' => 'G10', 'desc' => 'Muncul error KERNEL_POWER (Event ID 41) atau mati mendadak tanpa layar biru', 'hyp' => $h4->id, 'cf' => 0.80],
            ['code' => 'G11', 'desc' => 'Suhu bodi terasa sangat panas dan kipas berputar kencang sebelum mati', 'hyp' => $h4->id, 'cf' => 0.75],
            ['code' => 'G12', 'desc' => 'Muncul peringatan Secure Boot Violation atau Boot Configuration Data (BCD)', 'hyp' => $h5->id, 'cf' => 0.85],
            ['code' => 'G13', 'desc' => 'Pengaturan tanggal dan jam di BIOS selalu kembali ke awal (reset)', 'hyp' => $h5->id, 'cf' => 0.80],
        ];

        foreach ($symptomsData as $item) {
            $sym = Symptom::create([
                'code' => $item['code'],
                'description' => $item['desc']
            ]);

            Rule::create([
                'hypothesis_id' => $item['hyp'],
                'symptom_id' => $sym->id,
                'cf_pakar' => $item['cf']
            ]);
        }
    }
}