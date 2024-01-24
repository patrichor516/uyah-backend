<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'kode_user' => 'AP0001',
                'nis' => '12345',
                'fullname' => 'surya pradipta',
                'username' => 'surya',
                'password' => Hash::make('surya'),
                'kelas' => 'XII-PPLG-1',
                'alamat' => 'jln batu no 3',
                'verif' => 'verif',
                'role_id' => 1,
                'join_date' => '5-1-2016',
                'terakhir_login' => '8-9-2024',
            ]
        );
        DB::table('users')->insert(
            [
                'kode_user' => 'AP0001',
                'nis' => '12345',
                'fullname' => 'surya pradipta',
                'username' => 'mansur',
                'password' => Hash::make('mansur'),
                'kelas' => 'XII-PPLG-1',
                'alamat' => 'jln batu no 3',
                'verif' => 'verif',
                'role_id' => 1,
                'join_date' => '5-1-2016',
                'terakhir_login' => '8-9-2024',
            ]
        );
    }
}
