<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\TahunAkademik;
use App\Models\User;
use App\Models\DataDiriSantri;
use App\Models\PengaturanPembayaran;
use App\Models\RekeningPembayaran;
use App\Models\PembayaranSantri;
use App\Models\KategoriSoal;
use App\Models\Soal;
use App\Models\TimelineSeleksi;
use App\Models\JadwalTesSantri;
use App\Models\HasilTesSantri;
use App\Models\PengumumanHasil;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SEEDER: TAHUN AKADEMIK
        |--------------------------------------------------------------------------
        */
        $tahunAktif = TahunAkademik::create([
            'tahun' => '2025/2026',
            'aktif' => true,
        ]);

        TahunAkademik::create([
            'tahun' => '2024/2025',
            'aktif' => false,
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEEDER: USERS (Admin + Santri)
        |--------------------------------------------------------------------------
        */
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@psb.test',
            'no_telp' => '0800000000',
            'nik' => '1234567890',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEEDER: PENGATURAN PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        $reg = PengaturanPembayaran::create([
            'jenis' => 'registrasi',
            'nominal' => 100000,
            'tahun_akademik_id' => $tahunAktif->id,
        ]);

        $du = PengaturanPembayaran::create([
            'jenis' => 'daftar_ulang',
            'nominal' => 500000,
            'tahun_akademik_id' => $tahunAktif->id,
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEEDER: REKENING PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        $rek1 = RekeningPembayaran::create([
            'bank' => 'Mandiri',
            'nomor_rekening' => '1244678209236',
            'atas_nama' => 'PPFM',
        ]);

        RekeningPembayaran::create([
            'bank' => 'BRI',
            'nomor_rekening' => '145789276543862',
            'atas_nama' => 'PPFM',
        ]);

        RekeningPembayaran::create([
            'bank' => 'BNI',
            'nomor_rekening' => '1457629875',
            'atas_nama' => 'PPFM',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEEDER: KATEGORI SOAL
        |--------------------------------------------------------------------------
        */
        // Kategori dikembalikan ke 3 item dengan bobot 40-40-20
        $kategori = [
            [
                'nama_kategori' => 'Materi Tajwid',
                'tipe_kriteria' => 'benefit',
                'minimal_benar' => null,
                'bobot' => 40,
            ],
            [
                'nama_kategori' => 'Hafalan Bacaan Salat',
                'tipe_kriteria' => 'benefit',
                'minimal_benar' => null,
                'bobot' => 40,
            ],
            [
                'nama_kategori' => 'Tulis Ayat',
                'tipe_kriteria' => 'benefit',
                'minimal_benar' => null,
                'bobot' => 20,
            ],
        ];

        foreach ($kategori as $kat) {
            KategoriSoal::create($kat);
        }


        /*
        |--------------------------------------------------------------------------
        | SEEDER: SOAL (BANK SOAL 3 KATEGORI)
        |--------------------------------------------------------------------------
        */
        
        $bankSoal = [
            // Kategori: Tajwid
            'tajwid' => [
                [
                    'tanya' => 'Apabila ada Nun Sukun atau Tanwin bertemu dengan huruf Ba, maka hukum bacaannya adalah...',
                    'opsi' => ['Iqlab', 'Idgham Bighunnah', 'Izhar Halqi', 'Ikhfa Haqiqi'],
                ],
                [
                    'tanya' => 'Huruf-huruf Qalqalah (memantul) terkumpul dalam kalimat...',
                    'opsi' => ['Ba - Ju - Di - Tho - Qo (baju di toko)', 'Ya - Nun - Mim - Wau (yanmu)', 'Hamzah - Ha - Kho - Ain - Ghain - Ha', 'Lam - Ro'],
                ],
                [
                    'tanya' => 'Panjang bacaan Mad Thabi\'i (Mad Asli) adalah...',
                    'opsi' => ['1 Alif atau 2 Harakat', '2 Alif atau 4 Harakat', '3 Alif atau 6 Harakat', 'Setengah Alif'],
                ],
                [
                    'tanya' => 'Apa arti dari "Izhar" secara bahasa?',
                    'opsi' => ['Jelas atau Terang', 'Samar-samar', 'Mendengung', 'Memasukkan'],
                ],
                [
                    'tanya' => 'Hukum bacaan "Al" (Alif Lam) jika bertemu dengan huruf Qomariyah (seperti Mim, Kaf, Ba) harus dibaca...',
                    'opsi' => ['Jelas (Al-nya terdengar)', 'Lebur ke huruf depannya', 'Samar-samar', 'Mendengung lama'],
                ],
                [
                    'tanya' => 'Jika Mim Mati bertemu dengan huruf Mim, maka hukum bacaannya adalah...',
                    'opsi' => ['Idgham Mimi (Mutamatsilain)', 'Ikhfa Syafawi', 'Izhar Syafawi', 'Idgham Bilaghunnah'],
                ],
                [
                    'tanya' => 'Huruf Ikhfa Haqiqi berjumlah...',
                    'opsi' => ['15 huruf', '6 huruf', '4 huruf', '2 huruf'],
                ],
                [
                    'tanya' => 'Tanda "Tasydid" pada huruf hijaiyah berfungsi untuk...',
                    'opsi' => ['Menekan atau menggandakan huruf', 'Mematikan huruf', 'Memanjangkan huruf', 'Menipiskan huruf'],
                ],
                [
                    'tanya' => 'Hukum membaca Lafadz Allah (Lam Jalalah) jika didahului harakat kasrah adalah...',
                    'opsi' => ['Tarqiq (Tipis)', 'Tafkhim (Tebal)', 'Qalqalah', 'Gunnah'],
                ],
                [
                    'tanya' => 'Tanda waqaf "Mim" kecil di atas ayat menandakan Waqaf Lazim, yang artinya...',
                    'opsi' => ['Harus berhenti', 'Dilarang berhenti', 'Boleh berhenti boleh tidak', 'Lebih baik terus'],
                ],
            ],

            // Kategori: Salat
            'salat' => [
                [
                    'tanya' => 'Bacaan takbir pertama kali untuk memulai salat disebut...',
                    'opsi' => ['Takbiratul Ihram', 'Takbir Intiqal', 'Takbir Lail', 'Takbir Tasyrik'],
                ],
                [
                    'tanya' => 'Bunyi bacaan doa ketika Ruku\' adalah...',
                    'opsi' => ['Subhana Rabbiyal \'Adzimi wa bihamdih', 'Subhana Rabbiyal A\'la wa bihamdih', 'Sami\'allahu liman hamidah', 'Rabbighfirli warhamni'],
                ],
                [
                    'tanya' => 'Membaca Surat Al-Fatihah dalam setiap rakaat salat hukumnya adalah...',
                    'opsi' => ['Wajib (Rukun Salat)', 'Sunnah', 'Makruh', 'Mubah'],
                ],
                [
                    'tanya' => 'Doa yang dibaca pada rakaat kedua salat Subuh setelah ruku\' (I\'tidal) disebut doa...',
                    'opsi' => ['Qunut', 'Iftitah', 'Tasyahud', 'Walimah'],
                ],
                [
                    'tanya' => 'Potongan doa "Rabbighfirli warhamni wajburni..." dibaca pada saat...',
                    'opsi' => ['Duduk di antara dua sujud', 'I\'tidal', 'Sujud', 'Tahiyat Akhir'],
                ],
                [
                    'tanya' => 'Bacaan "Attahiyatul mubarakaatus salawatut thayyibatu lillah" merupakan bagian dari...',
                    'opsi' => ['Tasyahud (Tahiyat)', 'Iftitah', 'Surat Pendek', 'Dzikir setelah salam'],
                ],
                [
                    'tanya' => 'Gerakan bangkit dari ruku\' sambil membaca "Sami\'allahu liman hamidah" disebut...',
                    'opsi' => ['I\'tidal', 'Tuma\'ninah', 'Sujud Syukur', 'Salam'],
                ],
                [
                    'tanya' => 'Arti dari bacaan "Allahu Akbar" adalah...',
                    'opsi' => ['Allah Maha Besar', 'Allah Maha Pengasih', 'Allah Maha Mendengar', 'Allah Maha Mengetahui'],
                ],
                [
                    'tanya' => 'Sebelum membaca Al-Fatihah pada rakaat pertama, disunnahkan membaca doa...',
                    'opsi' => ['Iftitah', 'Sapu Jagat', 'Qunut Nazilah', 'Selamat'],
                ],
                [
                    'tanya' => 'Salat diakhiri dengan gerakan menoleh ke kanan dan ke kiri sambil mengucapkan...',
                    'opsi' => ['Salam', 'Amin', 'Takbir', 'Hamdalah'],
                ],
            ],

            // Kategori: Penulisan Ayat
            'penulisan' => [
                [
                    'tanya' => 'Arah penulisan huruf Arab atau ayat Al-Qur\'an yang benar dimulai dari...',
                    'opsi' => ['Kanan ke kiri', 'Kiri ke kanan', 'Atas ke bawah', 'Bawah ke atas'],
                ],
                [
                    'tanya' => 'Huruf Hijaiyah yang TIDAK bisa menyambung ke huruf setelahnya (di depannya) adalah...',
                    'opsi' => ['Alif, Dal, Dzal, Ra, Zai, Wau', 'Ba, Ta, Tsa, Jim', 'Sin, Syin, Shad, Dhad', 'Fa, Qaf, Kaf, Lam'],
                ],
                [
                    'tanya' => 'Tanda baca (harakat) yang berbunyi "u" disebut...',
                    'opsi' => ['Dhammah', 'Fathah', 'Kasrah', 'Sukun'],
                ],
                [
                    'tanya' => 'Jika huruf "Ba" ditulis di AWAL kata dan disambung, maka posisi titiknya berada di...',
                    'opsi' => ['Bawah satu titik', 'Atas dua titik', 'Atas tiga titik', 'Bawah dua titik'],
                ],
                [
                    'tanya' => 'Huruf "Ain" jika ditulis di TENGAH kalimat dan bersambung, bentuk kepalanya akan...',
                    'opsi' => ['Tertutup/Rapat', 'Tetap terbuka lebar', 'Hilang', 'Menjadi seperti huruf Mim'],
                ],
                [
                    'tanya' => 'Huruf Arab yang tidak memiliki titik sama sekali di bawah ini adalah...',
                    'opsi' => ['Ha (ح)', 'Jim (ج)', 'Kho (خ)', 'Tsa (ث)'],
                ],
                [
                    'tanya' => 'Tanda baca yang bentuknya seperti angka nol kecil atau lingkaran kecil di atas huruf disebut...',
                    'opsi' => ['Sukun (Mati)', 'Tasydid', 'Tanwin', 'Mad'],
                ],
                [
                    'tanya' => 'Penulisan kata "Bismillah" dalam bahasa Arab diawali dengan huruf...',
                    'opsi' => ['Ba', 'Alif', 'Mim', 'Lam'],
                ],
                [
                    'tanya' => 'Jumlah huruf hijaiyah standar (tanpa memasukkan Lam-Alif) umumnya berjumlah...',
                    'opsi' => ['28 atau 29 huruf', '20 huruf', '26 huruf', '33 huruf'],
                ],
                [
                    'tanya' => 'Manakah kelompok huruf berikut yang memiliki bentuk penulisan serupa (hanya beda titik)?',
                    'opsi' => ['Ba, Ta, Tsa', 'Alif, Kaf, Lam', 'Mim, Wau, Ha', 'Dal, Sin, Fa'],
                ],
            ],
        ];

        // LOGIKA PENCOCOKAN KATEGORI DAN INSERT SOAL
        foreach (KategoriSoal::all() as $k) {
            $namaKategori = strtolower($k->nama_kategori);
            $soalYgAkanDiinput = [];

            // Menggunakan str_contains agar fleksibel
            if (str_contains($namaKategori, 'tajwid')) {
                $soalYgAkanDiinput = $bankSoal['tajwid'];
            } elseif (str_contains($namaKategori, 'salat') || str_contains($namaKategori, 'sholat')) {
                $soalYgAkanDiinput = $bankSoal['salat'];
            } elseif (str_contains($namaKategori, 'tulis') || str_contains($namaKategori, 'imla') || str_contains($namaKategori, 'ayat')) {
                $soalYgAkanDiinput = $bankSoal['penulisan'];
            }

            // Loop untuk create soal ke database
            if (!empty($soalYgAkanDiinput)) {
                foreach ($soalYgAkanDiinput as $data) {
                    Soal::create([
                        'kategori_id' => $k->id,
                        'pertanyaan'  => $data['tanya'],
                        'pilihan'     => $data['opsi'], 
                        // PERBAIKAN DI SINI: Menyimpan INDEX 0 (angka), bukan TEKS jawaban.
                        'jawaban'     => 0, 
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SEEDER: TIMELINE SELEKSI
        |--------------------------------------------------------------------------
        */
        TimelineSeleksi::insert([
            [
                'tahun_akademik_id' => $tahunAktif->id,
                'nama_gelombang' => 'Gelombang 1',
                'mulai' => '2025-01-01',
                'selesai' => '2025-03-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun_akademik_id' => $tahunAktif->id,
                'nama_gelombang' => 'Gelombang 2',
                'mulai' => '2025-04-01',
                'selesai' => '2025-06-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun_akademik_id' => $tahunAktif->id,
                'nama_gelombang' => 'Gelombang 3 (Terakhir)',
                'mulai' => '2025-07-01',
                'selesai' => '2025-08-15', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}