@extends('layouts.standard')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Bestellung @if(isset($order)) bearbeiten. @else erzeugen. @endif</h2>

        @if(isset($order))
        <form action="{{ route('order.update', $order->id) }}" method="POST">
            @method('put')
        @else
        <form action="{{ route('order.store') }}" method="POST">
        @endif
            @csrf

            <div class="form-group mb-3">
                <label for="start" class="form-label">Start</label>
                <input type="date" name="start" id="start" 
                    class="form-control @error('start') border border-danger @enderror" 
                    value="{{ old('start', isset($order) ? $order->start->format('Y-m-d') : '') }}">
                @error('start')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="end" class="form-label">Ende</label>
                <input type="date" name="end" id="end" 
                    class="form-control @error('end') border border-danger @enderror" 
                    value="{{ old('end', isset($order) ? $order->end->format('Y-m-d') : '') }}">
                @error('end')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="user_id" class="form-label">Kunde</label>
                <select name="user_id" id="user_id" class="form-select @error('user_id') border border-danger @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" 
                            @selected(old('user_id', isset($order) ? $order->user_id : 0) == $user->id)>
                            {{ $user->profile->firstname }} {{ $user->profile->lastname }}
                        </option>
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
                        <option value="{{ $vehicle->id }}" 
                            @selected(old('vehicle_id', isset($order) ? $order->vehicle_id : 0) == $vehicle->id)>
                            {{ $vehicle->registration }}
                        </option>
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