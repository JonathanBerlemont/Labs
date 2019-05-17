<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Comment', 3)->create(['blog_id' => factory('App\Blog')->create()->id]);
        factory('App\Blog', 9)->create();
        factory('App\Activity', 10)->create();
        factory('App\Service', 15)->create();
        factory('App\Project', 10)->create();
        factory('App\Newsletter', 2)->create();
        factory('App\Mail', 10)->create();
        factory('App\Team', 10)->create();
        factory('App\Testimonial', 10)->create();
        factory('App\Mail', 5)->create(['subject' => 'testimonial']);

        DB::table('mails')->insert([
            'name' => 'Fouzzz',
            'email' => 'fouz@fouz.com',
            'subject' => 'Collection Ultimate Spiderman',
            'message' => 'Bonjour, j\'ai en ma possession la collection complète des ultimates spiderman (DELUXE) pour un peu moins de 200€',
            'read' => false
        ]);
        DB::table('teams')->insert([
            'name' => 'Fouzzz',
            'job' => 'Comics Owner',
            'flag' => true,
        ]);
    }
}