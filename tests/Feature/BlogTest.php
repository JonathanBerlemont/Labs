<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Blog;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_blog_has_an_author()
    {
        $this->withoutExceptionHandling();

        \DB::table('users')->insert([
            'id' => 1,
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'bio' => 'Je suis le maitre',
            'password' => bcrypt('admin'),
        ]);

        $blog = factory('App\Blog')->create();

        //dd($blog->belongsTo(User::class));

        $author = User::find(1);

        //dd($author);
        //dd($blog->author());

        $this->assertEquals($author->name, $blog->author()->name);
    }
}
