<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void 
    { 
        User::create([ 
            'nama' => 'Administrator', 
            'email' => 'admin@gmail.com', 
            'role' => '1',
            'status' => 1, 
            'hp' => '0812345678901', 
            'password' => bcrypt('P@55word'), 
        ]); 

        User::create([ 
            'nama' => 'Akbar Achmad Budiman', 
            'email' => 'akbar@gmail.com', 
            'role' => '0', 
            'status' => 1, 
            'hp' => '081234567892', 
            'password' => bcrypt('akbar1987'), 
        ]); 

        User::create([
            'nama' => 'Rindiani Lutfia Romil',
            'email' => 'rindiani@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '0895600781495',
            'password' => bcrypt('P@55word'),
        ]);
    
        User::create([
            'nama' => 'Elinda Auliya Rahmawati',
            'email' => 'elinda@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081776960532',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama' => 'Anggi Calvin Hutagalung',
            'email' => 'calvin@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081776960532',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama' => 'Dzulfikar Triyadi Kusuma',
            'email' => 'dzulfikar@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081776960532',
            'password' => bcrypt('P@55word'),
        ]);


        #data kategori
        Kategori::create([
            'nama_kategori' => 'Begonia',
        ]);
        Kategori::create([
            'nama_kategori' => 'Hanging plants',
        ]);
        Kategori::create([
            'nama_kategori' => 'Philodendron',
        ]);
        Kategori::create([
            'nama_kategori' => 'Anthurium',
        ]);
        Kategori::create([
            'nama_kategori' => 'Aglaonema',
        ]);
        Kategori::create([
            'nama_kategori' => 'Growing Media',
        ]);
    }
}
