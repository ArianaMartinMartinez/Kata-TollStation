@extends('layout.app')

@section('content')
    <div class="container">
        <a href="{{ route('vehiclesHome') }}" class="btn btn-details">Back</a>
        <h3>{{ $vehicle->license }}</h3>

        <div class="showInfo">
            <div class="type">
                <i class="fa-solid fa-car"></i>
                <p>{{ ucfirst($vehicle->type->type) }}</p>
            </div>

            <p><strong>Num of axles:</strong> {{ $vehicle->axles ? $vehicle->axles : 0 }}</p>
        </div>

        <h4>Stations it has passed through:</h4>

        <div class="cardSection container">
            @foreach ($vehicle->tolls as $toll)
                <div class="card" style="width: 20rem; height: 15rem">
                    <div class="card-body">
                    <h5 class="card-title">{{ $toll->station->name }}</h5>
                    <div class="card-text">
                        <div class="city">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>{{ $toll->station->city }}</p>
                        </div>
                        <p><strong>Total collected:</strong> {{ $toll->station->total_collected }}€</p>
                        <p><strong>Amount paid:</strong> {{ $toll->amount }}€</p>
                    </div>
                    <a href="{{ route('stationsShow', $toll->station->id) }}" class="btn btn-details">Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection