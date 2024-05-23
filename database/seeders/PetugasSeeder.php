<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Yusuf', 'role_status' => 'petugas', 'email' => 'yusuf@petugas.amwp.com', 'password' => Hash::make('63935845')]
        ];

        foreach ($data as $val){
            Petugas::insert([
                'nama' => $val['nama'],
                'role_status' => $val['role_status'],
                'email' => $val['email'],
                'password' => $val['password']
            ]);
        }
    }
}
