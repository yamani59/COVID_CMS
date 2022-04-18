<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use App\Models\Slide;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $category = [
      'hot news',
      'dki jakarta',
      'ibu kota',
      'new normal'
    ];

    $role = ['admin', 'super admin'];

    array_map(function ($make) use ($role) {
      $faker = Faker::create('id_ID');

      NewsCategory::create([
        'title' => $make,
        'description' => 'It is a long established fact that a reader will be distracted by the readable of a   page when looking at its layout',
      ]);

      News::create([
        'category_id' => random_int(1, 4),
        'title' => 'news-00' . random_int(1, 99),
        'content' => 'it is a long established fact that a reader will be distracted by the readable of a   page when looking at its layout',
        'poster' => 'belum ada'
      ]);

      Slide::create([
        'title' => 'slide-00' . random_int(1, 99),
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
        'link' => 'belum',
        'image' => 'belum',
      ]);

      User::create([
        'username' => $faker->name(),
        'email' => $faker->email(),
        'password' => bcrypt(12345678),
        'role' => $role[random_int(0,1)],
        'no_telp' => $faker->phoneNumber()
      ]);

    }, $category);
  }
}
