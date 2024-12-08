<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TransactionType;
use App\Models\Admin;
use App\Models\Subscription;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(RolePermissionSeeder::class);

    //First User
    $user = User::create([
      'name' => 'Brian Opiyo',
      'email' => 'brianmcopiyo@gmail.com',
      'status' => 'active',
      'password' => Hash::make('password'),
    ]);

    Admin::create([
      'status' => 'Active',
      'user_id' => $user->id,
    ]);

    UserSetting::create(['user_id' => $user->id, 'layout' => "horizontal"]);

    Subscription::insert([
      ['name' => "Starter", 'price' => 1, 'products' => 10, 'created_at' => now(), 'updated_at' => now()],
      ['name' => "Pro", 'price' => 3, 'products' => 100, 'created_at' => now(), 'updated_at' => now()],
      ['name' => "Enterprise", 'price' => 5, 'products' => 99999999, 'created_at' => now(), 'updated_at' => now()],
      ['name' => "Additional", 'price' => 1, 'products' => 0, 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
