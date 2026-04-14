<?php

namespace Tests\Feature\Front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_us_form_is_displayed(): void
    {
        $response = $this->get(route('front.contacts.index'));

        $response->assertStatus(200);
    }

    public function test_contact_request_can_sent(): void
    {
        $response = $this->post(route('front.contacts.store'), [
            'subject' => fake()->sentence(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->paragraph(),
        ]);

        $response->assertSessionHas('status');
    }
}
