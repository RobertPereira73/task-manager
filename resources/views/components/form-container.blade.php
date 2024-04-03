<form action="{{ $action }}" method="{{ $method }}" class="col-8 form-container {{ $class }}" {{ $attributes }}>
    @if ($title)
        <h2 class="tahoma bold text-center">{{ $title }}</h2>
    @endif
    
    {{ $slot }}
</form>

@section('links')
    <link rel="stylesheet" href="{{ asset('css/formContainer.css') }}">
@endsection