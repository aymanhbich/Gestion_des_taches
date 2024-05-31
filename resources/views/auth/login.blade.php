@extends('layouts.app')

@section('content')
    <form action="{{ route('login.login') }}" method="post" class="w-50 shadow p-5 mx-auto">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @if (session()->has('error'))
            <p class="text-danger text-center">{{ session('error') }}</p>
        @endif
        <button class="btn btn-primary d-block w-50 mx-auto">Connexion</button>
    </form>
@endsection
