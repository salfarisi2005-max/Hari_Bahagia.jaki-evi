<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wish;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminWishManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_wishes(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('admin.wishes.store'), [
            'name' => 'Dewi',
            'message' => 'Selamat menempuh hidup baru.',
        ])->assertRedirect(route('admin.dashboard'));

        $wish = Wish::query()->where('name', 'Dewi')->firstOrFail();
        $this->assertDatabaseHas('wishes', [
            'id' => $wish->id,
            'name' => 'Dewi',
            'message' => 'Selamat menempuh hidup baru.',
        ]);

        $this->put(route('admin.wishes.update', $wish), [
            'wish_id' => $wish->id,
            'name' => 'Dewi Putri',
            'message' => 'Semoga selalu bahagia.',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('wishes', [
            'id' => $wish->id,
            'name' => 'Dewi Putri',
            'message' => 'Semoga selalu bahagia.',
        ]);

        $this->delete(route('admin.wishes.destroy', $wish))
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseMissing('wishes', ['id' => $wish->id]);
    }

    public function test_guest_cannot_open_admin_dashboard_or_create_wishes(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));

        $this->post(route('admin.wishes.store'), [
            'name' => 'Dewi',
            'message' => 'Semoga selalu bahagia.',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseCount('wishes', 0);
    }

    public function test_admin_cannot_create_a_wish_with_missing_fields(): void
    {
        $this->actingAs(User::factory()->create());

        $this->from(route('admin.dashboard'))
            ->post(route('admin.wishes.store'), [
                'name' => '',
                'message' => '',
            ])
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHasErrors(['name', 'message']);

        $this->assertDatabaseCount('wishes', 0);
    }

    public function test_invitation_shows_family_details_mobile_navigation_and_creator_credit(): void
    {
        $this->get(route('wedding.index'))
            ->assertOk()
            ->assertSee('ZA')
            ->assertSee('EN')
            ->assertSee('Putra keempat dari')
            ->assertSee('Bapak Mirta dan Ibu Mulyati')
            ->assertSee('Putri pertama dari')
            ->assertSee('Bapak Dedi dan Ibu Anti')
            ->assertSee('© 2026 Salman Alfarisi')
            ->assertSee('Navigasi undangan')
            ->assertSee('href="#couple"', false)
            ->assertSee('href="#event"', false)
            ->assertSee('href="#gallery"', false)
            ->assertSee('href="#wishes"', false)
            ->assertDontSee('photo-1507003211169-0a1dd7228f2d')
            ->assertDontSee('photo-1534528741775-53994a69daeb');
    }
}
