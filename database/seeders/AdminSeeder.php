<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin();
        $admin->name = 'Mahidul Islam';
        $admin->email = 'admin@gmail.com';
        $admin->image = 'uploads/avatar.png';
        $admin->password = Hash::make('admin');
        $admin->status = 1;
        $admin->save();
    }
}
