<?php

use Illuminate\Database\Seeder;
use App\User;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'bio' => 'Bio de l\'admin',
            'password' => bcrypt('admin'),
        ]);

        Auth::login(User::find(1));
        $this->call([
            DummySeeder::class,
        ]);
    }
}
