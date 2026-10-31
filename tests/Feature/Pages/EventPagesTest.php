<?php

it('renders the home page with a clearly marked featured sample event', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Momen berikutnya dimulai di sini')
        ->assertSee('Contoh data')
        ->assertSee('Pulang Sebelum Pagi');
});

it('lists sample events and filters them by search text', function () {
    $this->get('/events')
        ->assertOk()
        ->assertSee('Katalog event')
        ->assertSee('Pulang Sebelum Pagi')
        ->assertSee('Ruang Nada')
        ->assertSee('Contoh data');

    $this->get('/events?q=Ruang')
        ->assertOk()
        ->assertSee('href="'.route('events.show', 'ruang-nada').'"', false)
        ->assertDontSee('href="'.route('events.show', 'pulang-sebelum-pagi').'"', false);

    $this->get('/events?city=Bandung')
        ->assertOk()
        ->assertSee('href="'.route('events.show', 'ruang-nada').'"', false)
        ->assertDontSee('href="'.route('events.show', 'pulang-sebelum-pagi').'"', false);

    $this->get('/events?genre=Olahraga')
        ->assertOk()
        ->assertSee('href="'.route('events.show', 'langkah-malam-5k').'"', false)
        ->assertDontSee('href="'.route('events.show', 'ruang-nada').'"', false);
});

it('renders event detail and links to the checkout preview', function () {
    $this->get('/events/pulang-sebelum-pagi')
        ->assertOk()
        ->assertSee('Pulang Sebelum Pagi')
        ->assertSee('Contoh data')
        ->assertSee('href="'.url('/checkout/demo').'"', false);
});

it('returns 404 for an unknown sample event', function () {
    $this->get('/events/event-yang-tidak-ada')->assertNotFound();
});
