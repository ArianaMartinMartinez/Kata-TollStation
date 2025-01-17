@extends('layout.app')

@section('content')
    <h3>Stations list</h3>

    <div class="cardSection container">
        @foreach ($stations as $station)
        <div class="card" style="width: 20rem; height: 13rem">
            <div class="card-body">
              <h5 class="card-title">{{ $station->name }}</h5>
              <div class="card-text">
                <div class="city">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{ $station->city }}</p>
                </div>
                  <p><strong>Total collected:</strong> {{ $station->total_collected }}€</p>
              </div>
              <a href="#" class="btn btn-details">Details</a>
            </div>
          </div>
        @endforeach
    </div>
@endsection