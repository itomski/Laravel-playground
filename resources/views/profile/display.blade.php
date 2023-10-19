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
        <form action="{{ route('profile.store') }}" method="post">
            @csrf

            <div class="form-group mb-3">
                <label for="firstname">Vorname</label>
                <input type="text" name="firstname" id="firstname" value="{{ $profile->firstname}}" 
                    placeholder="Vorname" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="lastname">Nachname</label>
                <input type="text" name="lastname" id="lastname" value="{{ $profile->lastname}}" 
                    placeholder="Nachname" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="birhdate">Geburtsdatum</label>
                <input type="date" name="birthdate" id="birthdate" value="{{ $profile->birthdate}}" 
                    placeholder="Geburtsdatum" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="street">Straße</label>
                <input type="text" name="street" id="street" value="{{ $profile->street}}" 
                    placeholder="Straße" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="street_nr">Hausnummer</label>
                <input type="text" name="street_nr" id="street_nr" value="{{ $profile->street_nr}}" 
                    placeholder="Hausnummer" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="city">Stadt</label>
                <input type="text" name="city" id="city" value="{{ $profile->city}}" 
                    placeholder="Stadt" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="zip">PLZ</label>
                <input type="text" name="zip" id="zip" value="{{ $profile->zip}}" 
                    placeholder="PLZ" class="form-control">
            </div>

            <button class="btn btn-success">Speichern</button>
        </form>
    </div>
</div>

@endsection