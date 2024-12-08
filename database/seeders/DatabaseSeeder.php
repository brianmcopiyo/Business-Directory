<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TransactionType;
use App\Models\Admin;
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

    TransactionType::insert([
      ['type' => "Income"],
      ['type' => "Expense"],
      ['type' => "Loans"],
    ]);
  }
}
