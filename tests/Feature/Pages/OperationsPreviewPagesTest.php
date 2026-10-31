<?php

use Illuminate\Support\Facades\DB;

it('renders an organizer dashboard marked as sample content', function () {
    $this->get('/organizer')
        ->assertOk()
        ->assertSee('Dashboard organizer')
        ->assertSee('Ringkasan penjualan contoh')
        ->assertSee('Angka ini bukan data transaksi');

    $this->post('/organizer')->assertMethodNotAllowed();
});

it('renders a scanner preview without camera or check-in behavior', function () {
    DB::connection()->enableQueryLog();
    DB::connection()->flushQueryLog();

    $this->get('/scanner')
        ->assertOk()
        ->assertSee('Preview scanner panitia')
        ->assertSee('Kamera tidak diakses')
        ->assertSee('Hasil contoh')
        ->assertDontSee('<video', false)
        ->assertDontSee('<form', false);

    $this->post('/scanner')->assertMethodNotAllowed();

    $writes = collect(DB::connection()->getQueryLog())
        ->filter(fn (array $query): bool => preg_match('/^\s*(insert|update|delete|replace)\b/i', $query['query']) === 1);

    expect($writes)->toBeEmpty();
    DB::connection()->disableQueryLog();
});
