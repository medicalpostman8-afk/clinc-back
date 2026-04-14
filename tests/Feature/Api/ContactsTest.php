<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected string $storeRoute;

    protected function setUp(): void
    {
        parent::setUp();

        $this->storeRoute = route('api.contact-requests.store');
    }

    public function test_user_can_create_contact_with_right_credentials(): void
    {
        $response = $this->postJson($this->storeRoute, [
            'subject' => fake()->sentence(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->paragraph(),
        ]);

        $response->assertStatus(201);
    }

    public function test_user_cannot_create_contact_with_wrong_credentials(): void
    {
        $response = $this->postJson($this->storeRoute);

        $response->assertStatus(422);
    }
}
