@extends('layouts.standard')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Bestellung</h2>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="start" class="form-label">Start</label>
                <input type="date" name="start" id="start" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="end" class="form-label">Ende</label>
                <input type="date" name="end" id="end" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="customer_id" class="form-label">Kunde</label>
                <select name="customer_id" id="customer_id" class="form-select">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->lastname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="vehicle_id" class="form-label">Fahrzeug</label>
                <select name="vehicle_id" id="vehicle_id" class="form-select">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">Speichern</button>
        </form>
    </div>
</div>
@endsection