@extends('layouts.standard')

@section('content')
<div class="row">
    <div class="col">
        @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}
            </div>
        @endif
    </div>
</div>


@if(count($vehicles))
<div class="row">
    @foreach($vehicles as $vehicle)
        <div class="col-sm-6 col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('/storage/images/'.($vehicle->file ?? 'standard.jpg')) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $vehicle->registration }}, {{ $vehicle->brand }}, {{ $vehicle->type }}</h5>
                    <p class="card-text">{{ $vehicle->description }}</p>
                    <form action="{{ route('vehicle.destroy', $vehicle) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Löschen</button>
                    </form>
                </div>
            </div>
        </div>    
    @endforeach
</div>

@else
<div class="row">
    <div class="col">
        <h2>Aktuell keine Fahrzeuge Verfügbar.</h2>
        <p><a href="{{ route('vehicle.create') }}">Neues Fahrzeug</a></p>
    </div>
</div>
@endif

@endsection