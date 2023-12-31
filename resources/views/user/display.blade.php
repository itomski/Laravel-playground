@extends('layouts.standard')

@section('content')

@if(session('msg'))
<div class="row">
    <div class="col">
        <div class="alert alert-success" role="alert">
        {{ session('msg') }}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        @can('isAdmin')
        <p><a href="{{ route('user.role.select') }}" class="btn btn-success">Rechtevergabe</a></p>
        @endcan

        <ul>
        @foreach($users as $user)
            <li>{{ $user->name }}
                <ul>
                    @foreach($user->roles as $role)
                        <li>{{ $role->name }} zugewiesen am {{ $role->pivot->created_at->format('d.m.Y') }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
        </ul>
    </div>
</div>

@endsection