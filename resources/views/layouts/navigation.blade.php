@if (Auth::user()->admin == 0)
    <nav class="navbar navbar-expand-lg border-bottom navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/insp.png') }}" style="height:50px;">
            </a>
            @mobile()

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endmobile()

            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                @mobile()
                <ul class="navbar-nav">
                    <li>
                        <button type="button" class="btn btn-secondary shadow-sm mt-3" style="margin-right:12px;"
                            data-bs-toggle="modal" data-bs-target="#pass-modal"">
                            GANTI PASSWORD <i class=" fad fa-gear"></i></button>
                    </li>
                    <li class="">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary shadow-sm mt-3" style="margin-right:12px;">
                                LOG OUT <i class="fad fa-sign-out"></i></button>
                        </form>
                    </li>
                </ul>
                @endmobile()
            </div>
            @desktop()
            <a href="/"><span class="navbar-brand">{{ Auth::user()->name }}</span></a>
            <button type="button" class="btn btn-secondary shadow-sm" style="margin-right:12px;"
                onclick="location.href='{{ route('ganti_password') }}';"><i class=" fad fa-gear"></i></button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary shadow-sm" style="margin-right:12px">
                    <i class="fad fa-sign-out"></i></button>
            </form>
            @enddesktop()
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            @mobile()
            <a class="navbar-brand" href="{{ route('home') }}">{{ Auth::user()->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endmobile()
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                @if (Auth::user()->admin == 1)
                    <ul class="navbar-nav">
                        <li class="">
                            <a class="nav-link" href="{{ route('home') }}">
                                DASHBOARD
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none me-2" href="#"
                                id="navbarDarkDropdownMenuLink1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                DATA PEGAWAI<div class="arrow-down"></div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark border border-0"
                                aria-labelledby="navbarDarkDropdownMenuLink1">
                                <li><a class="dropdown-item" href="{{ route('data_pegawai', 'semua') }}">SEMUA</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('data_pegawai', 'belum') }}">BELUM
                                        MENGISI</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('data_pegawai', 'sudah') }}">SUDAH
                                        MENGISI</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none me-2" href="#"
                                id="navbarDarkDropdownMenuLink2" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                DATA USER<div class="arrow-down"></div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark border border-0"
                                aria-labelledby="navbarDarkDropdownMenuLink2">
                                <li>
                                    <a class="dropdown-item" href="{{ route('createrequest') }}">TAMBAH PEGAWAI</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('password') }}">UBAH
                                        PASSWORD</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('updaterequest') }}">UBAH DATA
                                        PEGAWAI</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('deleterequest') }}">HAPUS PEGAWAI</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="">
                            <a class="nav-link" href="{{ route('superadmin') }}">
                                DASHBOARD
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none me-2" href="#"
                                id="navbarDarkDropdownMenuLink1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                REKAPITULASI DATA<div class="arrow-down"></div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark border border-0"
                                aria-labelledby="navbarDarkDropdownMenuLink1">
                                <li><a class="dropdown-item" href="{{ route('status') }}">DATA PENGISIAN</a></li>
                                <li><a class="dropdown-item" href="{{ route('pernyataan') }}">DATA PERNYATAAN</a>
                                <li><a class="dropdown-item" href="{{ route('gratifikasi') }}">DATA LAPORAN
                                        GRATIFIKASI</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none me-2" href="#"
                                id="navbarDarkDropdownMenuLink3" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                USER ADMIN<div class="arrow-down"></div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark border border-0"
                                aria-labelledby="navbarDarkDropdownMenuLink3">
                                <li><a class="dropdown-item" href="{{ route('dataadmin') }}">KELOLA USER ADMIN</a>
                                </li>
                                {{-- <li><a class="dropdown-item" href="{{ route('updatedata') }}">PERMINTAAN UPDATE
                                        DATA</a></li> --}}
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none me-2" href="#"
                                id="navbarDarkDropdownMenuLink4" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                PERMINTAAN UPDATE DATA @if (session('notif') != 0)
                                    <sup class="badge bg-danger">{{ session('notif') }}</sup>
                                    @endif<div class="arrow-down"></div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark border border-0"
                                aria-labelledby="navbarDarkDropdownMenuLink4">
                                <li><a class="dropdown-item" href="{{ route('createuser') }}">PERMINTAAN CREATE
                                        PEGAWAI @if (session('createuser') != 0)
                                            <sup class="badge bg-danger">{{ session('createuser') }}</sup>
                                        @endif</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('updatedata') }}">PERMINTAAN UPDATE
                                        DATA PEGAWAI @if (session('updatedata') != 0)
                                            <sup class="badge bg-danger">{{ session('updatedata') }}</sup>
                                        @endif</a></li>
                                <li><a class="dropdown-item" href="{{ route('deleteuser') }}">PERMINTAAN DELETE
                                        PEGAWAI @if (session('deleteuser') != 0)
                                            <sup class="badge bg-danger">{{ session('deleteuser') }}</sup>
                                        @endif</a></li>
                                <li><a class="dropdown-item" href="{{ route('reset') }}">RESET PENGISIAN </a></li>
                            </ul>
                        </li>
                    </ul>

                    {{-- <ul class="navbar-nav">
                        <li class="">
                            <a class="nav-link" href="{{ route('dataadmin') }}">
                                <span title="3 New Messages">USER ADMIN </span>

                            </a>
                        </li>
                    </ul> --}}
                    {{-- @if (session('updatedata') != 0)
                        <ul class="navbar-nav">
                            <li class="">
                                <a class="nav-link" href="{{ route('updatedata') }}">
                                    <span title="3 New Messages">PERMINTAAN UPDATE/BUAT?
                                        @if (session('updatedata') != 0)
                                            <sup class="badge bg-danger">{{ session('updatedata') }}</sup>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        </ul>
                    @endif --}}
                @endif


                @mobile()
                <ul class="navbar-nav">
                    <li>
                        <button type="button" class="btn btn-secondary shadow-sm mt-3" style="margin-right:12px;"
                            data-bs-toggle="modal" data-bs-target="#pass-modal"">
                            GANTI PASSWORD <i class=" fad fa-gear"></i></button>
                    </li>
                    <li class="">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary shadow-sm mt-3" style="margin-right:12px;">
                                LOG OUT <i class="fad fa-sign-out"></i></button>
                        </form>
                    </li>
                </ul>
                @endmobile()
            </div>
            @desktop()
            <a class="navbar-brand" href="{{ route('home') }}">{{ Auth::user()->name }} </a>
            <button type="button" class="btn btn-secondary shadow-sm" style="margin-right:12px;"
                onclick="location.href='{{ route('ganti_password') }}';"><i class=" fad fa-gear"></i></button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary shadow-sm" style="margin-right:12px;">
                    <i class="fad fa-sign-out"></i></button>
            </form>
            @enddesktop()
        </div>
    </nav>
@endif
