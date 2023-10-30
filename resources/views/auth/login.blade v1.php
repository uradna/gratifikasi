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

    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">

</head>

<body class="authentication-bg">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box pt-0">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand">
                        <a href="/" class="logo-dark">
                            <span><img src="{{ asset('img/insp.png') }}" alt="Inspektorat Kabupaten Ponorogo"
                                    height="55"></span>
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
                            <label for="nip" class="form-label">NIP</label>
                            <input class="form-control" type="text" id="nip" name="nip" required
                                placeholder="Masukkan NIP anda...">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" required id="password" name="password"
                                placeholder="Masukkan password anda...">

                        </div>
                        <div class="mb-3">

                            Lupa password?<a class="form-check-label"
                                href="https://wa.me/6281225181060?text=Saya%20tertarik%20dengan%20mobil%20Anda%20yang%20dijual">
                                Klik
                                di
                                sini.</a>
                        </div>
                        <div class="d-grid mb-4 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In </button>
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
            <footer class="footer"></footer>
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>
