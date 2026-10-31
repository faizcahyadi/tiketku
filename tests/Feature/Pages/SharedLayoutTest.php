<?php

use App\Models\User;

it('renders the shared shell and links all primary areas for guests', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('<html lang="id">', false)
        ->assertSee('Navigasi utama')
        ->assertSee('<details class="mobile-navigation">', false)
        ->assertSee('<summary class="mobile-menu-toggle">', false)
        ->assertSee('Menu navigasi')
        ->assertSee('href="'.url('/events').'"', false)
        ->assertSee('href="'.url('/organizer').'"', false)
        ->assertSee('href="'.url('/scanner').'"', false)
        ->assertSee('href="'.route('login').'"', false)
        ->assertSee('href="'.route('register').'"', false)
        ->assertSee('TiketKu', false);
});

it('renders the complete home concept without presenting sample content as real metrics', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Pernyataan')
        ->assertSee('Rencana')
        ->assertSee('pengembangan.')
        ->assertSee('Jadwal contoh berikutnya')
        ->assertSee('Musik')
        ->assertSee('Prinsip produk')
        ->assertSee('Preview');
});

it('uses the shared shell on the existing login screen', function () {
    $this->get('/login')
        ->assertOk()
        ->assertSee('Navigasi utama')
        ->assertSee('name="email"', false)
        ->assertSee('name="password"', false);
});

it('shows account links to signed-in users without changing guest links', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/')
        ->assertOk()
        ->assertSee('Akun saya')
        ->assertSee('Keluar')
        ->assertSee('href="'.route('profile.edit').'"', false)
        ->assertSee('action="'.route('logout').'"', false)
        ->assertDontSee('href="'.route('register').'"', false);
});
