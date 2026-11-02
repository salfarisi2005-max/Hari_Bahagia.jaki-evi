<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\User;
use App\Models\Wish;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_rejects_non_admin_accounts(): void
    {
        $user = User::factory()->create([
            'email' => config('admin.email'),
            'password' => 'A-strong-password-2026',
        ]);

        $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'A-strong-password-2026',
        ])
            ->assertRedirect('/admin/login')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_can_login_and_manage_guests_and_wishes(): void
    {
        $admin = User::factory()->create([
            'email' => config('admin.email'),
            'password' => 'A-strong-password-2026',
            'is_admin' => true,
        ]);

        $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'A-strong-password-2026',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);

        $this->get('/admin')->assertOk()->assertSee('Dashboard Undangan');

        $this->post('/admin/guests', [
            'name' => 'Tamu Uji',
            'category' => 'teman-seperjuangan',
        ])->assertRedirect();

        $guest = Guest::query()->where('name', 'Tamu Uji')->firstOrFail();
        $this->assertDatabaseHas('guests', ['id' => $guest->id, 'category' => 'teman-seperjuangan']);

        $this->put("/admin/guests/{$guest->id}", [
            'name' => 'Tamu Diperbarui',
            'category' => 'rekan-kerja',
        ])->assertRedirect();

        $this->assertDatabaseHas('guests', ['id' => $guest->id, 'name' => 'Tamu Diperbarui']);

        $wish = Wish::query()->create([
            'guest_id' => $guest->id,
            'category' => 'rekan-kerja',
            'name' => 'Tamu Diperbarui',
            'message' => 'Semoga bahagia.',
        ]);

        $this->put("/admin/wishes/{$wish->id}", [
            'name' => 'Tamu Uji',
            'category' => 'bapak-ibu',
            'message' => 'Doa terbaik untuk kalian.',
        ])->assertRedirect();

        $this->assertDatabaseHas('wishes', [
            'id' => $wish->id,
            'name' => 'Tamu Uji',
            'category' => 'bapak-ibu',
            'message' => 'Doa terbaik untuk kalian.',
        ]);

        $this->delete("/admin/wishes/{$wish->id}")->assertRedirect();
        $this->assertDatabaseMissing('wishes', ['id' => $wish->id]);

        $this->delete("/admin/guests/{$guest->id}")->assertRedirect();
        $this->assertDatabaseMissing('guests', ['id' => $guest->id]);
    }

    public function test_non_admin_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => config('admin.email'),
            'is_admin' => false,
        ]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_public_wish_submission_is_saved_and_rejects_unknown_categories(): void
    {
        $guest = Guest::query()->create([
            'name' => 'Bapak Ahmad',
            'category' => 'bapak-ibu',
        ]);

        $this->postJson('/wishes', [
            'category' => 'bapak-ibu',
            'name' => 'Bapak Ahmad',
            'message' => 'Semoga menjadi keluarga sakinah.',
        ])
            ->assertCreated()
            ->assertJsonPath('wish.category', 'bapak-ibu');

        $this->assertDatabaseHas('wishes', [
            'guest_id' => $guest->id,
            'name' => 'Bapak Ahmad',
            'message' => 'Semoga menjadi keluarga sakinah.',
        ]);

        $this->postJson('/wishes', [
            'category' => 'admin',
            'name' => 'Penyusup',
            'message' => 'Ucapan tidak valid.',
        ])->assertUnprocessable();

        $this->assertDatabaseMissing('wishes', ['name' => 'Penyusup']);
    }

    public function test_admin_sync_rejects_weak_passwords_and_stores_a_hash_for_strong_passwords(): void
    {
        config([
            'admin.email' => 'salman@unilam.ac.id',
            'admin.name' => 'Salman Alfarisi',
            'admin.password' => 'password',
        ]);

        $this->artisan('app:sync-admin-user')->assertFailed();
        $this->assertDatabaseMissing('users', ['email' => 'salman@unilam.ac.id']);

        config(['admin.password' => 'Strong-secret-2026!']);

        $this->artisan('app:sync-admin-user')->assertSuccessful();

        $admin = User::query()->where('email', 'salman@unilam.ac.id')->firstOrFail();

        $this->assertTrue($admin->is_admin);
        $this->assertTrue(Hash::check('Strong-secret-2026!', $admin->password));
        $this->assertNotSame('Strong-secret-2026!', $admin->password);
    }
}
