<header>
    <div class="logoDiv">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/icon.png') }}" alt="Toll Stations App logo">
            <h1>Toll Stations App</h1>
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="{{ route('stationsHome') }}">Stations</a></li>
            <li><a href="{{ route('vehiclesHome') }}">Vehicles</a></li>
        </ul>
    </nav>
</header>