<article class="event-row">
    <a class="event-art" href="{{ route('events.show', $event['slug']) }}" aria-label="Lihat {{ $event['title'] }}">
        <span class="event-art-label">Contoh data</span>
        <span class="event-art-mark" aria-hidden="true">{{ str_pad((string) $index, 2, '0', STR_PAD_LEFT) }}</span>
    </a>
    <div class="event-row-info">
        <p class="event-row-meta">{{ $event['date'] }} · {{ $event['city'] }}</p>
        <h3><a href="{{ route('events.show', $event['slug']) }}">{{ $event['title'] }}</a></h3>
        <p>{{ $event['venue'] }} · {{ $event['time'] }}</p>
    </div>
    <div class="event-row-price">
        <span>Mulai dari</span>
        <strong>Rp{{ number_format($event['price'], 0, ',', '.') }}</strong>
    </div>
    <a class="event-row-action" href="{{ route('events.show', $event['slug']) }}">Lihat event</a>
</article>
