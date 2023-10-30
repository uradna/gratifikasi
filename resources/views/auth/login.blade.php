<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SUPER GRATIFIKASI - Aplikasi Surat Pernyataan Gratifikasi Inspektorat Kabupaten Ponorogo</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://bkpsdm.ponorogo.go.id/wp-content/uploads/2017/07/cropped-logokab-32x32.png"
        sizes="32x32" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Fontawesome -->
    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/duotone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/regular.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/light.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/js_bootstrap.bundle.min.js') }}"></script>

    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">

</head>

<body>
    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box pt-0">
            <div class="align-items-center d-flex h-100">
                <div class="card-body" style="margin-top:85px;">

                    <!-- Logo -->
                    <div class="auth-brand">
                        <a href="/" class="logo-dark">
                            <span><img src="{{ asset('img/insp.png') }}" alt="Inspektorat Kabupaten Ponorogo"
                                    height="80"></span>
                        </a>
                    </div>


                    <!-- title-->
                    <h4 class="mt-2">LOGIN</h4>
                    <p class="small mt-1">Gunakan NIP dan password Simpeg/SimasHebat anda untuk
                        login.</p>
                    <hr>

                    <!-- form -->
                    <x-auth-validation-errors class="mb-2" :errors="$errors" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP/Username</label>
                            <input class="form-control" type="text" id="nip" name="nip" required
                                placeholder="Masukkan NIP anda...">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" required id="password" name="password"
                                placeholder="Masukkan password anda...">

                        </div>
                        <div class="d-grid mb-4 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In </button>
                        </div>
                        <div class="mb-3">
                            Lupa password?<a class="form-check-label" href="#" data-bs-toggle="modal"
                                data-bs-target="#reset-modal">
                                Klik di sini.</a>
                        </div>
                        <div class="mb-3">
                            Panduan pengguna, <a class="form-check-label"
                                href="/Juknis Pengguna Aplikasi Supergratifikasi.pdf"> Klik di sini.</a>
                        </div>

                        <!-- social-->

                    </form>
                    <!-- end form-->
                    {{-- <div class="text-center mt-1">

                    </div> --}}
                    <!-- Footer-->
                    <footer class="footer footer-alt mt-1">
                        <p class="text-muted" style="font-size: 0.7em">
                            <a href="https://inspektorat.ponorogo.go.id/" class="text-muted">
                                Inspektorat Kabupaten Ponorogo</a> <br>
                            bekerja sama dengan<br>
                            <a href="https://kominfo.ponorogo.go.id/" class="text-muted">
                                Dinas Komunikasi,
                                Informatika dan Statistik Kabupaten Ponorogo </a>
                        </p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->
        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-left">
            {{-- <img src="img/pos.png"> --}}
            <footer class="footer"></footer>
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

    {{-- modal for invalid date START --}}
    @if (Session::has('error'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#dangerx').modal('show');
            });

        </script>
    @endif

    <div id="dangerx" data-bs-backdrop="static" data-bs-keyboard="false" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="danger-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-danger">
                    <h4 class="modal-title" id="danger-header-modalLabel">Aplikasi Ditutup</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <b>Mohon maaf, masa pengisian pernyataan belum dibuka atau telah ditutup. <br><br>Anda dapat
                        menghubungi
                        Inspektorat Ponorogo untuk informasi lebih lanjut di inspektorat@ponorogo.go.id</b>
                </div>
            </div>
        </div>
    </div>
    {{-- modal for invalid date END --}}
    @if (Session::has('reset'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#reset-modal').modal('show');
            });

        </script>

    @endif
    <div id="reset-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reset Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('password.email') }}" class="ps-3 pe-3">
                        @csrf
                        {{ __('Lupa password anda? Tidak masalah, masukkan alamat email anda, kami akan kirimkan link yang dapat anda gunakan untuk memilih password baru.') }}
                        <x-auth-session-reset class=" mt-3" :reset="session('reset')['email']" />
                        <div class="mb-3 mt-3">
                            <label for="emailaddress1" class="form-label"><b>Alamat Email</b></label>
                        <input class="form-control" type="email" id="email" name="email" required="" @if (old('email') != null) value="{{ old('email') }}" @else
                            placeholder="Masukkan alamat email di sini" @endif>
                        </div>
                        <div class="mb-3 text-end">
                            <button class="btn rounded btn-dark" type="submit">Reset Password</button>
                        </div>

                        <ul style="padding-left: 0;">
                            <li style="list-style-type: none;"><small>Catatan:</small></li>
                            <li><small>Reset password pada aplikasi ini tidak mengubah password SimasHebat anda.</small>
                            </li>
                            <li><small>Jika anda tidak bisa mengakses atau lupa alamat email, hubungi admin di
                                    sekretariat SKPD
                                    anda masing-masing untuk mereset password.</small></li>
                        </ul>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    @if (Session::has('status'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#reset-success-modal').modal('show');
            });

        </script>
    @endif

    <div id="reset-success-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title">Reset Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">

                    <form class="ps-3 pe-3">


                        <x-auth-session-status class=" mb-3" :status="session('status')" />

                        <ul style="padding-left: 0;">
                            <li style="list-style-type: none;"><small>Catatan:</small></li>
                            <li><small>Reset password pada aplikasi ini tidak mengubah password SimasHebat anda.</small>
                            </li>
                            <li><small>Jika anda tidak bisa mengakses atau lupa alamat email, hubungi admin di
                                    sekretariat SKPD
                                    anda masing-masing untuk mereset password.</small></li>
                        </ul>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</body>

</html>
