@extends('layouts.standard')

@section('content')
<div class="row">
    <div class="col">

        @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}
            </div>
        @endif

        @guest {{-- Prüft, ob der User NICHT angemeldet ist --}}
            <div class="alert alert-danger">Du bist noch nicht angemeldet.</div>
        @endguest
        @auth {{-- Prüft, ob der User angemeldet ist --}}
            <div class="alert alert-success">Hallo {{ auth()->user()->name }}</div>
        @endauth

        @if(count($orders))
        <table class="table">
            <thead>
                <tr>
                    <th>Kunde</th>
                    <th>Fahrzeug</th>
                    <th>Start</th>
                    <th>Ende</th>
                    <th>Status</th>
                    @auth
                    <th>&nbsp;</th>
                    @endauth
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
                    @auth {{-- Prüft, ob der User angemeldet ist --}}
                    <td>
                        <a href="{{ route('order.edit', $order->id)}}" class="btn btn-warning">Bearbeiten</a>

                        <form action="{{ route('order.destroy', $order)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Löschen</button>
                        </form>
                    </td>
                    @endauth
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