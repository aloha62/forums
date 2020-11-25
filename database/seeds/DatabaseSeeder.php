<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $posts = factory(App\Posts::class, 10)->create();
        $comments = factory(App\Comments::class, 100)->create();
    }
}
