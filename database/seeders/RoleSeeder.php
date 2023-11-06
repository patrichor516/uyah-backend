<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleData =
            [
                'admin',
                'client'
            ];

        foreach ($roleData as $data) {
            Roles::create(['name role' => $data]);
        }
    }
}
