@extends('layout.app')

@section('content')
    <div class="homeSection">
        <a href="{{ route('stationsHome') }}">
            <img src="{{ asset('img/home/homeBarrier.png') }}" alt="Home Barrier">
            <h2>Stations</h2>
        </a>
        <a href="{{ route('vehiclesHome') }}">
            <img src="{{ asset('img/home/homeCar.png') }}" alt="Home Car">
            <h2>Vehicles</h2>
        </a>
    </div>
@endsection