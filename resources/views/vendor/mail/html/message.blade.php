@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ __('SUPER GRATIFIKASI: Inspektorat Kabupaten Ponorogo. Bekerja sama dengan Dinas Komunikasi, Informatika dan Statistik Kabupaten Ponorogo') }}
@endcomponent
@endslot
@endcomponent
