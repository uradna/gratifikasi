@props(['reset'])

@if ($reset)
    <div class="alert alert-danger text-center mt-3" role="alert">
        <i class="fa-solid fa-circle-exclamation"></i> {{ $reset }}
    </div>
@endif
