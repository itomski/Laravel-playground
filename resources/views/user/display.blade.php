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
        <ul>
        @foreach($users as $user)
            <li>{{ $user->name }}
                <ul>
                    @foreach($user->roles() as $role)
                        <li>{{ $role }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
        </ul>
    </div>
</div>

@endsection