@extends('layouts.standard')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Fahrzeug @if(isset($order)) bearbeiten. @else erzeugen. @endif</h2>

        @if(isset($order))
        <form action="{{ route('vehicle.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
        @else
        <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form-group mb-3">
                <label for="registration" class="form-label">Kennzeichen</label>
                <input type="text" name="registration" id="registration" 
                    class="form-control @error('registration') border border-danger @enderror" 
                    value="{{ old('registration', $vehicle->registration ?? '') }}">
                @error('registration')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="brand" class="form-label">Marke</label>
                <input type="text" name="brand" id="brand" 
                    class="form-control @error('brand') border border-danger @enderror" 
                    value="{{ old('brand', $vehicle->brand ?? '') }}">
                @error('brand')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="type" class="form-label">Typ</label>
                <input type="text" name="type" id="type" 
                    class="form-control @error('type') border border-danger @enderror" 
                    value="{{ old('type', $vehicle->type ?? '') }}">
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Datei</label>
                <input type="file" name="file" id="file" 
                    class="form-control @error('file') border border-danger @enderror" 
                    value="{{ old('file', $vehicle->file ?? '') }}">
                @error('file')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Beschreibung</label>
                <textarea name="description" id="description" 
                    class="form-control @error('description') border border-danger @enderror">{{ old('description', $vehicle->description ?? '') }}</textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-success">Speichern</button>
        </form>
    </div>
</div>
@endsection