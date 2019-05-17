<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        
        $this->be($user);

        $this->assertDatabaseHas('users', $user->toArray());

        $this->patch("/admin/users/{$user->name}", ['role' => 'Test'])->assertSee('hello');
    }
}
