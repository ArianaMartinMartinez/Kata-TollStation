@extends('layout.app')

@section('content')
    <div class="container">
        <a href="{{ route('stationsHome') }}" class="btn btn-details">Back</a>
        <h3>{{ $station->name }}</h3>
    
        <div class="showInfo">
            <div class="city">
                <i class="fa-solid fa-location-dot"></i>
                <p>{{ $station->city }}</p>
            </div>
    
            <p><strong>Total collected:</strong> {{ $station->total_collected }}€</p>
        </div>
    
        <h4>Vehicles that have passed:</h4>
    
        <div class="cardSection container">
            @foreach ($station->tolls as $toll)
                <div class="card" style="width: 20rem; height: 13rem">
                    <div class="card-body">
                    <h5 class="card-title">{{ $toll->vehicle->license }}</h5>
                    <div class="card-text vehicle-info">
                        <div class="type">
                            <i class="fa-solid fa-car"></i>
                            <p>{{ ucfirst($toll->vehicle->type->type) }}</p>
                        </div>
                        <p><strong>Num of axles:</strong> {{ $toll->vehicle->axles ? $toll->vehicle->axles : 0 }}</p>
                        <p><strong>Amount paid:</strong> {{ $toll->amount }}€</p>
                    </div>
                    <a href="" class="btn btn-details">Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection