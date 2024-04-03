@extends('components.body')

@section('title', 'Register')

@section('links')
    @parent
    <script src="{{ asset('js/home.js') }}" defer></script>
@endsection

@section('content')
    <section class="w-100 h-100 d-flex justify-content-center align-items-center">
        <x-form-container title="Register" :action="route('register')" onsubmit="access(event)">
            <x-form-group label="Name" input-name="name" class="mb-3"/>

            <x-form-group label="User id" input-name="user_id" class="mb-3"/>

            <x-form-group input-type="password" label="Password" input-name="password" class="mb-3"/>
    
            <x-form-group input-type="password" label="Confirm Password" input-name="password_confirmation"/>

            <div class="form-group d-flex justify-content-between align-items-center mt-4">
                <p class="mb-0">
                    Have an account already?
                    <a href="{{ route('login') }}"> Login</a>
                </p>
               
                <x-button message="login" class="btn-secondary" message="register"/>
            </div>
        </x-form-container>
    </section>
@endsection