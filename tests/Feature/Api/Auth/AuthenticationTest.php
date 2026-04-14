<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_users_can_authenticate(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertJson(
            fn(AssertableJson $json) =>
            $json->has('token')
        );
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('api.logout'));

        $response->assertStatus(204);
    }
}
