<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();
    \App\Models\User::factory()->create([
      'name' => 'User',
      'password' => Hash::make('12345678'),
      'email' => 'user@gmail.com',
      'type_user' => 2
    ]);
    \App\Models\User::factory()->create([
      'name' => 'Admin',
      'password' => Hash::make('12345678'),
      'email' => 'admin@gmail.com',
      'type_user' => 1
    ]);
    $this->call([
      ProductSeeder::class,
      SaleSeeder::class,
    ]);
  }
}
