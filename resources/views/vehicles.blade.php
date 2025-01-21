@extends('layout.app')

@section('content')
    <h3>Vehicles list</h3>

    <div class="cardSection container">
        @foreach ($vehicles as $vehicle)
        <div class="card" style="width: 20rem;">
            <div class="card-body">
            <h5 class="card-title">{{ $vehicle->license }}</h5>
            <div class="card-text vehicle-info">
                <div class="type">
                    <i class="fa-solid fa-car"></i>
                    <p>{{ ucfirst($vehicle->type->type) }}</p>
                </div>
                <p><strong>Num of axles:</strong> {{ $vehicle->axles ? $vehicle->axles : 0 }}</p>
            </div>
            <a href="" class="btn btn-details">Details</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection