<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_available(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Masuk ke Dashboard');
    }

    public function test_admin_can_log_in_and_open_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $this->post(route('admin.login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($user);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Admin');
    }

    public function test_invalid_admin_credentials_show_an_error(): void
    {
        $this->from(route('login'))
            ->post(route('admin.login.submit'), [
                'email' => 'admin@example.com',
                'password' => 'wrong-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');
    }

    public function test_database_seeder_creates_the_admin_account(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->post(route('admin.login.submit'), [
            'email' => 'admin@wedding.com',
            'password' => 'password123',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticated();
    }
}
