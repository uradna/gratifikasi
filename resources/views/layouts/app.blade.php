<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::user()->admin == 0)
        <title>{{ config('app.name', 'Laravel') }}</title>

    @else
        <title>{{ session('title') }}</title>
    @endif
    <link rel="icon" href="https://bkpsdm.ponorogo.go.id/wp-content/uploads/2017/07/cropped-logokab-32x32.png"
        sizes="32x32" />

    <!-- Fonts -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <!-- Fontawesome -->
    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/duotone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/regular.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/light.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/js_bootstrap.bundle.min.js') }}"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}" />

    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/bootstrapValidator.min.css') }}">
    <script type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
</head>

<body class="font-sans antialiased">
    @if (Session::has('berhasil'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#success-alert-modal').modal('show');
            });

        </script>
    @endif
    @if (Session::has('gagal'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#fail-alert-modal').modal('show');
            });

        </script>
    @endif
    @if (Session::has('warning'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#warning-alert-modal').modal('show');
            });

        </script>
    @endif
    <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body p-1">
                    <div class="text-center">
                        <i class="fa-solid fa-badge-check h2 text-success"></i>
                        <h4 class="mt-2">Berhasil!</h4>
                        <p class="mt-3 mb-2">{!! session('berhasil')['status'] !!}</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="fail-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body p-1">
                    <div class="text-center">
                        <i class="fa-solid fa-circle-exclamation h2 text-danger"></i>
                        <h4 class="mt-2">Gagal!</h4>
                        <p class="mt-3 mb-2">{!! session('gagal')['status'] !!}</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body p-1">
                    <div class="text-center">
                        <i class="fa-solid fa-circle-exclamation h2 text-warning"></i>
                        <h4 class="mt-2">Perhatian!</h4>
                        <p class="mt-3 mb-2">{!! session('warning')['status'] !!}</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <main>
        <div class="mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm min-h-screen">
                <div class="bg-white">
                    @include('layouts.navigation')
                </div>
                @if (!Auth::user()->admin == 1)
                    <div class="mx-auto px-3 sm:px-6 lg:px-8">
                        <div align="right" class="font-semibold py-1">Status :
                            @if (Auth::user()->status_laporan == 0)
                                <span class="alert bg-danger text-white p-0 px-1">Belum mengisi</span>
                            @elseif (Auth::user()->status_laporan == 5 && Auth::user()->finish == 1)
                                <span class="alert bg-success text-white p-0 px-1">Selesai</span>
                            @else
                                <span class="alert bg-warning p-0 px-1 text-white">Belum selesai</span>
                            @endif
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </div>
    </main>
    {{-- <script src="{{ asset('js/timepicker.js') }}" defer></script> --}}
</body>

</html>
