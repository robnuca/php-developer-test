<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the user avatars are displayed on the users index page.
     *
     * @return void
     */
    
    public function testUserAvatarsDisplayed()
    {
        // Create test users with avatar URLs
        User::factory()->create([
            'name' => 'Emma Wong',
            'email' => 'emma.wong@reqres.in',
            'avatar' => 'https://reqres.in/img/faces/3-image.jpg',
        ]);

        // Get the users index page
        $response = $this->get('/users');

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that each user's avatar is displayed in the HTML response
        $response->assertSee('https://reqres.in/img/faces/3-image.jpg');
    }
}
