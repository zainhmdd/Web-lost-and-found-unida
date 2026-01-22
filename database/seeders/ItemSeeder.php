<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            echo "⚠️ Tidak ada user! Buat user dulu dengan: php artisan make:seeder UserSeeder\n";
            return;
        }

        // Ambil atau buat kategori
        $categories = [
            'Tas & Dompet' => Category::firstOrCreate(['name' => 'Tas & Dompet', 'slug' => 'tas-dompet', 'color' => '#3B82F6']),
            'Elektronik' => Category::firstOrCreate(['name' => 'Elektronik', 'slug' => 'elektronik', 'color' => '#8B5CF6']),
            'Jam Tangan' => Category::firstOrCreate(['name' => 'Jam Tangan', 'slug' => 'jam-tangan', 'color' => '#e74c3c']),
            'Buku & Alat Tulis' => Category::firstOrCreate(['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis', 'color' => '#F59E0B']),
            'Botol Minum' => Category::firstOrCreate(['name' => 'Botol Minum', 'slug' => 'botol-minum', 'color' => '#10B981']),
        ];

        // Ambil atau buat lokasi
        $locations = [
            'Perpustakaan' => Location::firstOrCreate(['name' => 'Perpustakaan', 'slug' => 'perpustakaan']),
            'Masjid Kampus' => Location::firstOrCreate(['name' => 'Masjid Kampus', 'slug' => 'masjid-kampus']),
            'Lapangan' => Location::firstOrCreate(['name' => 'Lapangan', 'slug' => 'lapangan']),
            'Ruang Kelas A' => Location::firstOrCreate(['name' => 'Ruang Kelas A', 'slug' => 'ruang-kelas-a']),
            'Kantin' => Location::firstOrCreate(['name' => 'Kantin', 'slug' => 'kantin']),
        ];

        // Data items dengan path gambar yang BENAR
        $items = [
            [
                'user_id' => $user->id,
                'name' => 'Tas Ransel Hitam Eiger',
                'description' => 'Tas ransel warna hitam merk Eiger ukuran sedang dengan beberapa kantong',
                'category_id' => $categories['Tas & Dompet']->id,
                'location_id' => $locations['Perpustakaan']->id,
                'type' => 'found',
                'date' => '2024-12-26',
                'images' => ['items/eiger_hitam.jpg'], // ✅ Path yang benar
                'status' => 'verified',
                'has_reward' => false,
            ],
            [
                'user_id' => $user->id,
                'name' => 'HP Samsung Galaxy A52',
                'description' => 'HP Samsung Galaxy A52 warna biru dengan casing transparan',
                'category_id' => $categories['Elektronik']->id,
                'location_id' => $locations['Masjid Kampus']->id,
                'type' => 'found',
                'date' => '2024-12-25',
                'images' => ['items/samsung_a52.jpg'], // ✅ Path yang benar
                'status' => 'verified',
                'has_reward' => false,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Jam Tangan Casio G-Shock',
                'description' => 'Jam tangan digital Casio G-Shock warna hitam',
                'category_id' => $categories['Jam Tangan']->id,
                'location_id' => $locations['Lapangan']->id,
                'type' => 'found',
                'date' => '2024-12-24',
                'images' => ['items/wK65pVOkRgTJ1RwzzuOeywvYUlbGaYIiEOQKTU7n.jpg'], // ✅ Sesuaikan dengan nama file kamu
                'status' => 'verified',
                'has_reward' => false,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Buku Catatan & Kotak Pensil',
                'description' => 'Buku catatan dengan sampul coklat dan kotak pensil warna hitam',
                'category_id' => $categories['Buku & Alat Tulis']->id,
                'location_id' => $locations['Ruang Kelas A']->id,
                'type' => 'found',
                'date' => '2024-12-23',
                'images' => ['items/buku_catatan_kotak_pensil.png'], // ✅ Path yang benar
                'status' => 'verified',
                'has_reward' => false,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Botol Minum Tupperware Hijau',
                'description' => 'Botol minum Tupperware warna hijau ukuran 1 liter',
                'category_id' => $categories['Botol Minum']->id,
                'location_id' => $locations['Kantin']->id,
                'type' => 'found',
                'date' => '2024-12-22',
                'images' => ['items/tupperware_hijau.png'], // ✅ Path yang benar
                'status' => 'verified',
                'has_reward' => false,
            ],
        ];

        foreach ($items as $itemData) {
            Item::create($itemData);
        }

        echo "✅ " . count($items) . " items berhasil ditambahkan!\n";
    }
}