<?php

namespace App\Http\Controllers;

use App\ViewModels\DemoEventCatalog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('welcome', [
            'featuredEvent' => DemoEventCatalog::featured(),
            'events' => DemoEventCatalog::all(),
        ]);
    }

    public function events(Request $request): View
    {
        return view('pages.events.index', [
            'events' => DemoEventCatalog::filter($request->only('q', 'city', 'genre')),
            'allEvents' => DemoEventCatalog::all(),
            'filters' => $request->only('q', 'city', 'genre'),
        ]);
    }

    public function event(string $slug): View
    {
        $event = DemoEventCatalog::find($slug);
        abort_if($event === null, 404);

        return view('pages.events.show', ['event' => $event]);
    }

    public function checkout(): View
    {
        $event = DemoEventCatalog::featured();
        $ticketType = $event['ticket_types'][0];

        return view('pages.checkout-preview', [
            'event' => $event,
            'ticketType' => $ticketType,
            'quantity' => 1,
            'total' => $ticketType['price'],
        ]);
    }

    public function myTickets(): View
    {
        return view('pages.my-tickets', [
            'event' => DemoEventCatalog::featured(),
            'ticketCode' => 'DEMO-001',
        ]);
    }

    public function organizer(): View
    {
        return view('pages.organizer.dashboard', [
            'metrics' => [
                ['label' => 'Tiket terjual contoh', 'value' => '240'],
                ['label' => 'Pesanan contoh', 'value' => '86'],
                ['label' => 'Pendapatan contoh', 'value' => 'Rp28.500.000'],
            ],
            'event' => DemoEventCatalog::featured(),
        ]);
    }

    public function scanner(): View
    {
        return view('pages.scanner');
    }
}
