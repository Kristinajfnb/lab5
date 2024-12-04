<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Создание ролей
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
         // Создание администратора
         $adminRole = Role::where('name', 'admin')->first();
         User::create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('admin123'), // Используйте хороший пароль
         ])->roles()->attach($adminRole);
    }

}
