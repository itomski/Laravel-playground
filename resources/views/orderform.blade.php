@extends('layouts.standard')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Bestellung</h2>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="start" class="form-label">Start</label>
                <input type="date" name="start" id="start" class="form-control @error('start') border border-danger @enderror" value="{{ old('start') }}">
                @error('start')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="end" class="form-label">Ende</label>
                <input type="date" name="end" id="end" class="form-control @error('end') border border-danger @enderror" value="{{ old('end') }}">
                @error('end')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="customer_id" class="form-label">Kunde</label>
                <select name="customer_id" id="customer_id" class="form-select @error('customer_id') border border-danger @enderror">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->lastname }}</option>
                    @endforeach
                </select>
                @error('customer_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="vehicle_id" class="form-label">Fahrzeug</label>
                <select name="vehicle_id" id="vehicle_id" class="form-select @error('vehicle_id') border border-danger @enderror">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                    @endforeach
                </select>
                @error('vehicle_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-success">Speichern</button>
        </form>
    </div>
</div>
@endsection