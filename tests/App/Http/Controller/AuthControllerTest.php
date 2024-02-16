<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_of_user()
    {
        $user = User::get()->first();
        $response = $this->post('api/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertStatus(200);
    }
}
