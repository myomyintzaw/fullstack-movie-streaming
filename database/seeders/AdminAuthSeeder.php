<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Admin::create([
        'name'=>'Admin',
        'email'=>'mgmg@a.com',
        'password'=>Hash::make('mgmg1234'),
        ]);
    }
}
