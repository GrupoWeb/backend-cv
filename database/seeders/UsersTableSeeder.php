<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'              => 'Admin',
                'first_name'        => 'Carlos',
                'second_name'       => 'alejandro',
                'surname'           => 'Gomez',
                'second_surname'    => 'Cabrera',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('password'),
                'remember_token'    => Str::random(60),
                'role_id'           => $role->id,
            ]);

            $role = Role::where('name', 'Administrator')->firstOrFail();

            User::create([
                'name'              => 'Administración CVISUAL',
                'first_name'        => 'Juan',
                'second_name'       => 'José',
                'surname'           => 'Jolón',
                'second_surname'    => 'Granados',
                'email'             => 'admin@cvisual.com',
                'password'          => bcrypt('123456789'),
                'remember_token'    => Str::random(60),
                'role_id'           => $role->id,
            ]);
        }
    }
}
