<?php

use Illuminate\Support\Facades\DB;

it('shows a read-only checkout preview with a path to sample tickets', function () {
    DB::connection()->enableQueryLog();
    DB::connection()->flushQueryLog();

    $this->get('/checkout/demo')
        ->assertOk()
        ->assertSee('Checkout contoh')
        ->assertSee('Contoh data')
        ->assertSee('Pulang Sebelum Pagi')
        ->assertSee('href="'.url('/my-tickets').'"', false)
        ->assertDontSee('<form', false);

    $this->post('/checkout/demo')->assertMethodNotAllowed();

    $writes = collect(DB::connection()->getQueryLog())
        ->filter(fn (array $query): bool => preg_match('/^\s*(insert|update|delete|replace)\b/i', $query['query']) === 1);

    expect($writes)->toBeEmpty();
    DB::connection()->disableQueryLog();
});

it('shows a clearly labeled sample e-ticket without a real QR code', function () {
    $this->get('/my-tickets')
        ->assertOk()
        ->assertSee('Pesanan &amp; e-ticket', false)
        ->assertSee('Tiket contoh')
        ->assertSee('QR contoh, tidak dapat digunakan untuk check-in');

    $this->post('/my-tickets')->assertMethodNotAllowed();
});
