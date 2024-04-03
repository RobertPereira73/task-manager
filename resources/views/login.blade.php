@extends('components.body')

@section('title', 'Login')

@section('links')
    @parent
    <script src="{{ asset('js/home.js') }}" defer></script>
@endsection

@section('content')
    <section class="w-100 h-100 d-flex justify-content-center align-items-center">
        <x-form-container title="Login" :action="route('login')" onsubmit="access(event)">
            <x-form-group label="User id" input-name="user_id" class="mb-3"/>

            <x-form-group input-type="password" label="Password" input-name="password" class="mb-3"/>
    
            <div class="form-group d-flex justify-content-between align-items-center mt-4">
                <p class="mb-0">
                    Doesn't have an account?
                    <a href="{{ route('register') }}"> Register</a>
                </p>
               
                <x-button message="login" class="btn-secondary" message="login"/>
            </div>
        </x-form-container>
    </section>
@endsection