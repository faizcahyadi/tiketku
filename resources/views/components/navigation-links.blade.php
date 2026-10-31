<a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Beranda</a>
<a href="{{ route('events.index') }}" @if (request()->is('events*')) aria-current="page" @endif>Event</a>
<a href="{{ route('organizer.dashboard') }}" @if (request()->routeIs('organizer.*')) aria-current="page" @endif>Penyelenggara</a>
<a href="{{ route('scanner.preview') }}" @if (request()->routeIs('scanner.*')) aria-current="page" @endif>Panitia</a>
@auth
    <a href="{{ route('profile.edit') }}" @if (request()->routeIs('profile.*')) aria-current="page" @endif>Akun saya</a>
    <form method="POST" action="{{ route('logout') }}" class="site-logout">
        @csrf
        <button type="submit">Keluar</button>
    </form>
@else
    <a href="{{ route('login') }}">Masuk</a>
    <a class="site-navigation-cta" href="{{ route('register') }}">Daftar</a>
@endauth
