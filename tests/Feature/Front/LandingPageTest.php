<?php

namespace Tests\Feature\Front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_is_displayed(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }
}
