@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        {{-- <div class="font-medium text-red-600">
            {{ __('Login Gagal.') }}
        </div> --}}
        {{-- <div class="alert alert-danger text-center py-1" role="alert">
            Login Gagal...
        </div> --}}

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center py-1" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $error }}
            </div>
        @endforeach

    </div>
@endif
