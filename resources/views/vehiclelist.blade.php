@extends('layouts.standard')

@section('content')
<div class="row">
    <div class="col">

        @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}
            </div>
        @endif

        @if(count($vehicles))
            @foreach($vehicles as $vehicle)
                <div class="card" style="width: 18rem;">
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
            @endforeach
        
        @else
        <div>
            <h2>Aktuell keine Fahrzeuge Verfügbar.</h2>
            <p><a href="{{ route('vehicle.create') }}">Neues Fahrzeug</a></p>
        </div>
        @endif
    </div>
</div>

@endsection