@extends('layouts.standard')

@section('content')
<div class="row">
    <div class="col">

        @if(session('msg'))
            {{ session('msg') }}
            {{-- session()->pull('msg') --}}
            {{-- pull entfernt den Wert beim AUslesen aus der Session --}}
        @endif

        @if(count($orders))
        <table class="table">
            <thead>
                <tr>
                    <th>Kunde</th>
                    <th>Fahrzeug</th>
                    <th>Start</th>
                    <th>Ende</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->customer->firstname }} {{ $order->customer->lastname }}</td>
                    <td>{{ $order->vehicle->registration }}, {{ $order->vehicle->brand }}, {{ $order->vehicle->type }} </td>
                    <td>{{ $order->start->format('d.m.Y') }}</td>
                    <td>{{ $order->end->format('d.m.Y') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('order.edit', $order->id)}}" method="GET">
                            <button class="btn btn-warning">Bearbeiten</button>
                        </form>

                        <form action="{{ route('order.destroy', $order)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Löschen</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div>
            <h2>Aktuell keine Bestellungen Verfügbar.</h2>
            <p><a href="{{ route('order.create') }}">Neue Bestellung</a></p>
        </div>
        @endif
    </div>
</div>

@endsection