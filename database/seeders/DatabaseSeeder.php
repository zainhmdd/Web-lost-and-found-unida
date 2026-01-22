<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Kunci', 'slug' => 'kunci', 'color' => '#17bbb9'],
            ['name' => 'Tas & Dompet', 'slug' => 'tas-dompet', 'color' => '#26607d'],
            ['name' => 'Elektronik', 'slug' => 'elektronik', 'color' => '#17bbb9'],
            ['name' => 'Jam Tangan', 'slug' => 'jam-tangan', 'color' => '#e74c3c'],
            ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis', 'color' => '#f39c12'],
            ['name' => 'Botol Minum', 'slug' => 'botol-minum', 'color' => '#27ae60'],
            ['name' => 'Pakaian & Aksesoris', 'slug' => 'pakaian-aksesoris', 'color' => '#9b59b6'],
            ['name' => 'Lainnya', 'slug' => 'lainnya', 'color' => '#95a5a6'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Locations
        $locations = [
            ['name' => 'Parkiran Motor', 'slug' => 'parkiran-motor'],
            ['name' => 'Perpustakaan', 'slug' => 'perpustakaan'],
            ['name' => 'Masjid Kampus', 'slug' => 'masjid-kampus'],
            ['name' => 'Lapangan', 'slug' => 'lapangan'],
            ['name' => 'Ruang Kelas A', 'slug' => 'ruang-kelas-a'],
            ['name' => 'Kantin', 'slug' => 'kantin'],
            ['name' => 'Gedung Rektorat', 'slug' => 'gedung-rektorat'],
            ['name' => 'Asrama', 'slug' => 'asrama'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }

        // Create Sample User
        $user = User::create([
            'name' => 'Muhammad Ahmad',
            'email' => 'ahmad@unida.gontor.ac.id',
            'nim' => '202412345',
            'telegram_username' => 'ahmad_gontor', // ✅ WAJIB ADA!
            'password' => Hash::make('password'),
            'points' => 35,
        ]);

        // Create Sample Items WITHOUT IMAGES (akan kosong/placeholder)
        // Sample Items - Gunakan array kosong untuk images
        $sampleItems = [
            [
                'category_id' => 2,
                'location_id' => 2,
                'name' => 'Tas Ransel Hitam Eiger',
                'description' => 'Tas ransel warna hitam merk Eiger ukuran sedang dengan beberapa kantong. Di dalam ada buku catatan dan kotak pensil warna hijau.',
                'date' => '2024-12-26',
            ],
            [
                'category_id' => 3,
                'location_id' => 3,
                'name' => 'HP Samsung Galaxy A52',
                'description' => 'HP Samsung warna putih dengan case transparan. Ada stiker Islamic quotes di belakang.',
                'date' => '2024-12-25',
            ],
            [
                'category_id' => 4,
                'location_id' => 4,
                'name' => 'Jam Tangan Casio G-Shock',
                'description' => 'Jam tangan digital Casio G-Shock warna hitam. Tali agak longgar.',
                'date' => '2024-12-24',
            ],
            [
                'category_id' => 5,
                'location_id' => 5,
                'name' => 'Buku Catatan & Kotak Pensil',
                'description' => 'Buku catatan bersampul coklat dan kotak pensil hitam dengan stiker kaligrafi.',
                'date' => '2024-12-23',
            ],
            [
                'category_id' => 6,
                'location_id' => 6,
                'name' => 'Botol Minum Tupperware Hijau',
                'description' => 'Botol minum Tupperware warna hijau tosca ukuran 1 liter. Masih setengah penuh.',
                'date' => '2024-12-22',
            ],
        ];

        foreach ($sampleItems as $itemData) {
            Item::create([
                'user_id' => $user->id,
                'category_id' => $itemData['category_id'],
                'location_id' => $itemData['location_id'],
                'type' => 'found',
                'name' => $itemData['name'],
                'description' => $itemData['description'],
                'date' => $itemData['date'],
                'images' => [], // Kosong - akan tampil placeholder
                'has_reward' => false,
                'status' => 'verified',
            ]);
        }



        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Email: ahmad@unida.gontor.ac.id');
        $this->command->info('🔑 Password: password');
    }
}