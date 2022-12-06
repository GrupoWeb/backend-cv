<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VoyagerDummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PermissionRoleTableSeeder::class,
            PostsTableSeeder::class,
//            CategoriesTableSeeder::class,
//            PagesTableSeeder::class,
//            TranslationsTableSeeder::class,
        ]);
    }
}
