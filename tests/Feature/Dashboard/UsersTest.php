<?php

namespace Tests\Feature\Dashboard;

use App\Livewire\Dashboard\UsersTable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected User $modelToEdit;

    protected string $indexRoute;

    protected string $createRoute;

    protected string $storeRoute;

    protected string $showRoute;

    protected string $editRoute;

    protected string $updateRoute;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');

        $this->user = User::factory()->create();

        $this->modelToEdit = User::factory()->create();

        $this->indexRoute = route('dashboard.users.index');

        $this->createRoute = route('dashboard.users.create');

        $this->storeRoute = route('dashboard.users.store');

        $this->showRoute = route('dashboard.users.show', [
            'user' => $this->modelToEdit->id
        ]);

        $this->editRoute = route('dashboard.users.edit', [
            'user' => $this->modelToEdit->id
        ]);

        $this->updateRoute = route('dashboard.users.update', [
            'user' => $this->modelToEdit->id
        ]);
    }

    public function test_add_users_link_is_displayed()
    {
        $this->user->givePermissionTo('create users');

        $response = $this->actingAs($this->user)
            ->get($this->createRoute);

        $response->assertStatus(200)
            ->assertSee(__('ui.add_users'))
            ->assertSee($this->createRoute);
    }

    public function test_view_users_link_is_displayed()
    {
        $this->user->givePermissionTo('view users');

        $response = $this->actingAs($this->user)
            ->get($this->indexRoute);

        $response->assertStatus(200)
            ->assertSee(__('ui.view_users'))
            ->assertSee($this->indexRoute);
    }

    public function test_authenticated_user_with_right_permissions_can_create_users(): void
    {
        $this->user->givePermissionTo('create users');

        $response = $this->actingAs($this->user)
            ->get($this->createRoute);

        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($this->user)
            ->post($this->storeRoute, [
                'name' => 'Test User',
                'email' => 'test3@example.com',
                'password' => 'password',
                'image' => $file
            ]);

        $response->assertRedirect($this->createRoute)
            ->assertSessionHas('status');
    }

    public function test_unauthenticated_user_cannot_create_users(): void
    {
        $response = $this->get($this->createRoute);

        $response->assertStatus(302);
    }

    public function test_authenticated_user_with_wrong_permissions_cannot_create_users(): void
    {
        $response = $this->actingAs($this->user)
            ->get($this->createRoute);

        $response->assertStatus(403);
    }

    public function test_authenticated_user_with_right_permissions_can_edit_users()
    {
        $this->user->givePermissionTo('update users');

        $response = $this->actingAs($this->user)
            ->get($this->editRoute);

        $response->assertStatus(200);

        $response = $this->actingAs($this->user)
            ->put($this->updateRoute, [
                'name' => 'Test User',
                'email' => 'test2@example.com',
            ]);

        $response->assertRedirect($this->editRoute)
            ->assertSessionHas('status');
    }

    public function test_unauthenticated_user_cannot_edit_users(): void
    {
        $response = $this->get($this->editRoute);

        $response->assertStatus(302);
    }

    public function test_authenticated_user_with_right_permissions_can_show_users()
    {
        $this->user->givePermissionTo('view users');

        $response = $this->actingAs($this->user)
            ->get($this->showRoute);

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_show_users()
    {
        $response = $this->get($this->showRoute);

        $response->assertStatus(302);
    }

    public function test_authenticated_user_with_wrong_permissions_cannot_delete_users()
    {
        Livewire::actingAs($this->user)
            ->test(UsersTable::class)
            ->assertStatus(403);
    }

    public function test_authenticated_user_with_right_permissions_can_delete_users()
    {
        $this->user->givePermissionTo(['view users', 'delete users']);

        Livewire::actingAs($this->user)
            ->test(UsersTable::class)
            ->call('delete', [1, 2])
            ->assertDispatched('showModal', ['id' => 'deleteConfirmationModal'])
            ->call('confirmDelete')
            ->assertDispatched('hideModal', ['id' => 'deleteConfirmationModal']);
    }
}
