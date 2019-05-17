<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Blog;
use App\Category;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_blogs_filtered_by_categories()
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

        $test1 = Category::create(['name' => 'Test1']);
        $test2 =Category::create(['name' => 'Test2']);
        $test3 =Category::create(['name' => 'Test3']);

        $blog = factory(Blog::class)->create([
            'categories' => ["Test1", "Test2", "Test3"]
        ]);

        $this->assertDatabaseHas('blogs', ['title' => $blog->title]);

        $this->assertDatabaseHas('categories', $test1->toArray());
        $this->assertDatabaseHas('categories', $test2->toArray());
        $this->assertDatabaseHas('categories', $test3->toArray());
        
        $this->get('/blog/categories/Test1')->assertSee($blog->title);
    }
}
