@extends('layouts.standard')

@section('content')

<div class="row">
    <div class="col-md-6">
        <p>{{ $profile->firstname ?? 'Leer' }}</p>
        <p>{{ $profile->lastname ?? 'Leer' }}</p>
        <p>{{ $profile->birthdate ?? 'Leer' }}</p>
        <p>{{ $profile->street ?? 'Leer' }}</p>
        <p>{{ $profile->street_nr ?? 'Leer' }}</p>
        <p>{{ $profile->city ?? 'Leer' }}</p>
        <p>{{ $profile->zip ?? 'Leer' }}</p>
    </div>
</div>

@endsection