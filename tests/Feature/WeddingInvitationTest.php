<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeddingInvitationTest extends TestCase
{
    public function test_invitation_renders_static_wishes_without_a_database(): void
    {
        config(['database.default' => 'unavailable']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Salman Alfarisi')
            ->assertSee('const initialWishes = [];', false)
            ->assertDontSee('Selamat untuk kedua mempelai!')
            ->assertSee('wish-form')
            ->assertSee('wishes-container')
            ->assertDontSee('Ucapan tersimpan di browser ini saja')
            ->assertDontSee('Simpan Perubahan')
            ->assertDontSee('Batal Edit')
            ->assertDontSee('data-action')
            ->assertDontSee('window.confirm')
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
            ->assertSee('Kirim Ucapan')
            ->assertSee('Kirim Hadiah')
            ->assertSee('aria-label="Logo DANA"', false)
            ->assertSee('+62 856-8468-295')
            ->assertSee('08568468295', false)
            ->assertSee('navigator.clipboard.writeText(copyDanaButton.dataset.copyText)', false)
            ->assertSee('Salin Nomor DANA');
    }

    public function test_login_dashboard_and_wish_api_routes_are_removed(): void
    {
        $this->get('/admin/login')->assertNotFound();
        $this->get('/admin/dashboard')->assertNotFound();
        $this->get('/api/wishes')->assertNotFound();
        $this->post('/api/wishes')->assertNotFound();
    }
}
