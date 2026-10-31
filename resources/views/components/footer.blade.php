<footer class="site-footer">
    <div class="site-footer-inner">
        <div>
            <p class="site-eyebrow">Sampai jumpa di venue</p>
            <h2>Rencanakan <span class="text-accent">momen</span> berikutnya.</h2>
        </div>
        <nav class="footer-links" aria-label="Tautan halaman">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('events.index') }}">Katalog event</a>
            <a href="{{ route('checkout.demo') }}">Preview checkout</a>
            <a href="{{ route('tickets.preview') }}">Pesanan &amp; e-ticket</a>
            <a href="{{ route('organizer.dashboard') }}">Dashboard organizer</a>
            <a href="{{ route('scanner.preview') }}">Preview scanner</a>
        </nav>
    </div>
    <p class="footer-wordmark" aria-hidden="true">TIKETKU</p>
    <p class="footer-copyright">© {{ now()->year }} TiketKu · Platform event dan tiket</p>
</footer>
