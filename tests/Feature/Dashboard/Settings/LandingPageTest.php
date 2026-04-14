<?php

namespace Tests\Feature\Dashboard\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected $editRoute;

    protected $updateRoute;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->editRoute = route('dashboard.settings.index', ['tab' => 'landing-page']);

        $this->updateRoute = route('dashboard.settings.update_landing_page');
    }

    public function test_unauthenticated_user_cannot_edit_landing_page(): void
    {
        $response = $this->get($this->editRoute);

        $response->assertStatus(302);
    }

    public function test_authenticated_user_with_wrong_permissions_cannot_edit_landing_page(): void
    {
        $response = $this->actingAs($this->user)
            ->get($this->editRoute);

        $response->assertStatus(403);
    }

    public function test_authenticated_user_with_right_permissions_can_view_landing_page(): void
    {
        $this->user->givePermissionTo('manage settings');

        $response = $this->actingAs($this->user)
            ->get($this->editRoute);

        $response->assertSee(__('ui.update'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_with_right_permissions_can_update_landing_page(): void
    {
        $this->user->givePermissionTo('manage settings');

        $response = $this->actingAs($this->user)
            ->put($this->updateRoute, [
                'welcome_message_title' => [
                    'ar' => 'test',
                    'en' => 'test',
                ],
                'welcome_message' => [
                    'ar' => 'test',
                    'en' => 'test',
                ],
                'welcome_message_description' => [
                    'ar' => 'test',
                    'en' => 'test',
                ],
            ]);

        $response->assertRedirect($this->editRoute)
            ->assertSessionHas('status');
    }
}
