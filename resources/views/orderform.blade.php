@extends('layouts.standard')

@section('content')
<h2>Bestellung</h2>
<form action="{{ route('order.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <input type="datetime" name="start" id="start" class="form-control" placeholder="Strat">
    </div>

    <div class="form-group mb-3">
        <input type="datetime" name="end" id="end" class="form-control" placeholder="End">
    </div>

    <div class="form-group mb-3">
        <select name="customer_id" id="customer_id" class="form-control">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->lastname }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group mb-3">
        <select name="vehicle_id" id="vehicle_id" class="form-control">
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Speichern</button>
</form>
@endsection