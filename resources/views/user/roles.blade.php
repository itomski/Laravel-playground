@extends('layouts.standard')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Rolen zuweisen</h2>

        <form action="{{ route('user.role.attach') }}" method="POST">
            @csrf
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
                <label for="role_id" class="form-label">Role</label>
                <select name="role_id[]" multiple id="role_id" class="form-select @error('role_id') border border-danger @enderror">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name }}
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