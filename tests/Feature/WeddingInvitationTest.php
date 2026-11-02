<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeddingInvitationTest extends TestCase
{
    use RefreshDatabase;

    public function test_invitation_renders_database_wishes_and_invitation_details(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('const initialWishes = [];', false)
            ->assertDontSee('Selamat untuk kedua mempelai!')
            ->assertSee('wish-form')
            ->assertSee('wishes-container')
            ->assertDontSee('Ucapan tersimpan di browser ini saja')
            ->assertDontSee('Simpan Perubahan')
            ->assertDontSee('Batal Edit')
            ->assertDontSee('data-action')
            ->assertDontSee('window.confirm')
            ->assertSee('aria-label="Inisial mempelai pria"', false)
            ->assertSee('alt="Ilustrasi kartun mempelai wanita mengenakan gaun pengantin"', false)
            ->assertSee('Putra keempat dari')
            ->assertSee('Bapak Mirta dan Ibu Mulyati')
            ->assertSee('Putri pertama dari')
            ->assertSee('Bapak Dedi dan Ibu Anti')
            ->assertSeeText('© 2026 Zaki & Evi Navisa. Dibuat dengan cinta.')
            ->assertSee('Navigasi undangan')
            ->assertSee('href="#couple"', false)
            ->assertSee('href="#event"', false)
            ->assertSee('href="#gallery"', false)
            ->assertSee('href="#wishes"', false)
            ->assertSee('Kirim Ucapan')
            ->assertSee('id="wish-category"', false)
            ->assertSee('Khalaifa Generation')
            ->assertSee('Teman seperjuangan')
            ->assertSee('Kirim Hadiah')
            ->assertSee('aria-label="Logo DANA"', false)
            ->assertSee('/images/dana-logo.jpg', false)
            ->assertSee('08568468295')
            ->assertSee('08568468295', false)
            ->assertSee('navigator.clipboard.writeText(copyDanaButton.dataset.copyText)', false)
            ->assertSee('Salin Nomor DANA')
            ->assertSee('/images/bride-cartoon.jpg', false)
            ->assertSee('/images/couple-cartoon.jpg', false)
            ->assertSee('/images/cartoon-couple-navy.jpg', false)
            ->assertSee('/images/cartoon-couple-pink.jpg', false)
            ->assertDontSee('/images/wedding-flowers.svg', false)
            ->assertDontSee('/images/wedding-rings.svg', false)
            ->assertSee('object-contain');
    }

    public function test_invitation_starts_with_empty_wishes_and_groups_them_by_guest_category(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('const wishCategories =', false)
            ->assertSee("localStorage.removeItem('wedding-wishes-v1');", false)
            ->assertSee('function createWishTable(category, categoryWishes)', false)
            ->assertSee('wish.category === value', false)
            ->assertDontSee('Selamat untuk kedua mempelai!');
    }

    public function test_invitation_personalizes_and_escapes_the_guest_name(): void
    {
        $guestName = 'Khalaifa Generation <script>alert(1)</script>';

        $this->get('/?to='.urlencode($guestName))
            ->assertOk()
            ->assertSee('Khalaifa Generation')
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_invitation_uses_a_fallback_for_invalid_guest_names(): void
    {
        $this->get('/?to[]=Rekan+Kerja')
            ->assertOk()
            ->assertSee('id="guest-name"', false)
            ->assertSee('Tamu Undangan');
    }

    public function test_invitation_uses_a_fallback_when_guest_name_is_blank(): void
    {
        $this->get('/?to=+++')
            ->assertOk()
            ->assertSee('Tamu Undangan');
    }

    public function test_invitation_limits_guest_name_length(): void
    {
        $guestName = str_repeat('Tamu ', 20);
        $visibleName = mb_substr(trim($guestName), 0, 80);

        $this->get('/?to='.urlencode($guestName))
            ->assertOk()
            ->assertSee($visibleName)
            ->assertDontSee('Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu Tamu');
    }

    public function test_admin_dashboard_requires_an_authenticated_admin(): void
    {
        $this->get('/admin/login')->assertOk();
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/api/wishes')->assertNotFound();
        $this->post('/api/wishes')->assertNotFound();
    }
}
