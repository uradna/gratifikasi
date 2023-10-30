<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">USER ADMIN</h3>
                    <h5 class="card-subtitle  mb-2">
                        Tambah dan edit user admin dan super admin.
                    </h5>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <a href="#" class="btn btn-secondary text-left mb-1" data-bs-toggle="modal"
                                data-bs-target="#add-modal">TAMBAH <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-sm table-hover" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                {{-- <th width="5%">No.</th> --}}
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Unit</th>
                                <th>Akses</th>
                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    {{-- <td class="text-center bg-white">{{ $n + 1 }} </td> --}}
                                    <td class="bg-white">{{ $d->name }} </td>
                                    <td class="bg-white">{{ $d->nip }} </td>
                                    <td class="bg-white">{{ $d->unit }} </td>
                                    <td class="bg-white">
                                        @if ($d->admin == 1)
                                            <i class="fa-regular fa-square-a"></i> Admin SKPD
                                        @else
                                            <i class="fa-solid fa-square-s"></i> Super Admin
                                        @endif
                                    </td>
                                    <td class="text-center bg-white">

                                        <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2 ed-btn"
                                            data-quantity="{{ $d->id }}|{{ $d->name }}|{{ $d->nip }}|{{ $d->unit }}|{{ $d->admin }}"
                                            value="Edit" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                        <input type="button"
                                            class="btn btn-secondary btn-sm font-11 ppx-2 mx-1 pass-btn"
                                            data-quantity="{{ $d->id }}|{{ $d->name }}" value="Password"
                                            data-bs-toggle="modal" data-bs-target="#pass-modal">
                                        <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2 del-btn"
                                            data-quantity="{{ $d->id }}|{{ $d->name }}" value="Hapus"
                                            data-bs-toggle="modal" data-bs-target="#del-modal">
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-body pt-1">

                </div>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 10,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "info": false,
                "scrollY": 340,
                "order": [
                    [3, "desc"]
                ],
                "dom": '<"mb-1"t><"float-start"f>p',
                // "buttons": ["excel", "pdf", "print", ],
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>


    @if (Session::has('errors'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#{{ old('form') }}').modal('show');
            });

        </script>
    @endif
    {{-- MODAL START --}}
    <script>
        $('.pass-btn').click(function() {
            var data = $(this).data('quantity').split('|');
            $('#id_p').val(data[0]);
            $('#name_p').val(data[1]);
        });

    </script>
    <div id="pass-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin_password') }}">
                        @csrf
                        <input type="hidden" id="id_p" name="id" value="{{ old('id') }}">
                        <input type="hidden" name="form" value="pass-modal">
                        <div class="row mb-3">
                            <div class="col-sm-12 position-relative">
                                <label for="name_p" class="control-label">Nama</label>
                                <input type="text" id="name_p" class="form-control form-control-sm" name="name" readonly
                                    value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Password baru</label>
                            <input type="text" class="form-control fake-password form-control-sm" name="password"
                                id="password" />
                            @error('password')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Ulangi password</label>
                            <input type="text" class="form-control fake-password  form-control-sm"
                                name="confirmPassword" id="confirmPassword" />
                            @error('confirmPassword')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <small class="text-muted">Password minimal 8 karakter</small>

                        <div class=" text-end">
                            <button class="btn rounded btn-secondary" type="submit">Ubah Password <i
                                    class="fas fa-caret-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}
    {{-- MODAL START --}}
    <script>
        $('.ed-btn').click(function() {
            var data = $(this).data('quantity').split('|');
            $('#ed_id').val(data[0]);
            $('#ed_name').val(data[1]);
            $('#ed_nip').val(data[2]);
            $('#ed_unit').val(data[3]);
            $('#ad').val(data[4]);
            if (data[4] == 1) {
                $('#ad').html('ADMIN SKPD');
            } else if (data[4] == 2) {
                $('#ad').html('SUPER ADMIN');
            }

        });

    </script>
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal validate-this" novalidate method="POST"
                        action="{{ route('admin_patch') }}">
                        @csrf
                        <input type="hidden" id="ed_id" name="id" value="{{ old('id') }}">
                        <input type="hidden" name="form" value="edit-modal">
                        <div class="row">
                            <div class="col-sm-6 position-relative mb-3">
                                <label class="control-label">Nama</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="ed_name"
                                    value="{{ old('name') }}" required />
                                <div class="invalid-tooltip">
                                    Harus diisi
                                </div>
                                @error('name')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 position-relative mb-3">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control form-control-sm" name="nip" id="ed_nip" required
                                    value="{{ old('nip') }}" />
                                <div class="invalid-tooltip">
                                    Harus diisi
                                </div>
                                @error('nip')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Unit</label>
                            <input class="form-control form-control-sm" list="datalistOptions" id="ed_unit" name="unit"
                                placeholder="Pilih instansi" required value="{{ old('unit') }}" autocomplete="off">
                            <datalist id="datalistOptions">
                                @foreach ($unit as $u)
                                    <option value="{{ $u->unit }}">
                                @endforeach
                            </datalist>
                            <div class="invalid-tooltip">
                                Harus diisi
                            </div>
                            @error('unit')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Hak akses</label>
                            <select class="form-select form-select-sm" id="ed_admin" name="admin">
                                <option id="ad" value="{{ old('admin') }}">
                                    @if (old('admin') == 1)
                                        ADMIN SKPD
                                    @elseif (old('admin') == 2)
                                        SUPER ADMIN
                                    @endif
                                </option>
                                <option value="1">ADMIN SKPD</option>
                                <option value="2">SUPER ADMIN</option>
                            </select>
                            <div class="invalid-tooltip">
                                Harus dipilih
                            </div>
                            @error('admin')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class=" text-end">
                            <button class="btn rounded btn-secondary" type="submit">Simpan <i
                                    class="fas fa-caret-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}
    {{-- MODAL START --}}
    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat user baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal validate-this" novalidate method="POST"
                        action="{{ route('admin_create') }}">
                        @csrf
                        <input type="hidden" name="form" value="add-modal">

                        <div class="row  mb-3">
                            <div class="col-sm-6 position-relative">
                                <label class="control-label">Nama</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="ed_name"
                                    value="{{ old('name') }}" required placeholder="Nama akun" />
                                <div class="invalid-tooltip">
                                    Harus diisi
                                </div>
                                @error('name')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 position-relative">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control form-control-sm" name="nip" id="ed_nip" required
                                    value="{{ old('nip') }}" placeholder="Username akun" />
                                <div class="invalid-tooltip">
                                    Harus diisi
                                </div>
                                @error('nip')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6 position-relative">
                                <label class="control-label">Password baru</label>
                                <input type="text" class="form-control fake-password form-control-sm" name="password"
                                    id="password" required autocomplete="off" />
                                <div class="invalid-tooltip">
                                    Harus diisi
                                </div>
                                @error('password')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 position-relative">
                                <label class="control-label">Ulangi password</label>
                                <input type="text" class="form-control fake-password  form-control-sm"
                                    name="confirmPassword" id="confirmPassword" required autocomplete="off" />
                                <div class="invalid-tooltip">
                                    Harus diisi
                                </div>
                                @error('confirmPassword')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">Password minimal 8 karakter</small>
                        </div>

                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Unit</label>
                            <input class="form-control" list="datalistOptions" id="ed_unit" name="unit"
                                placeholder="Pilih instansi" required value="{{ old('unit') }}" autocomplete="off">
                            <datalist id="datalistOptions">
                                @foreach ($unit as $u)
                                    <option value="{{ $u->unit }}">
                                @endforeach
                            </datalist>
                            <div class="invalid-tooltip">
                                Harus diisi
                            </div>
                            @error('unit')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Hak akses</label>
                            <select class="form-select form-select-sm" id="ed_admin" name="admin">
                                <option hidden="true">Pilih hak akses</option>
                                <option value="1" @if (old('admin') == 1) selected @endif>ADMIN SKPD</option>
                                <option value="2" @if (old('admin') == 2) selected @endif>SUPER ADMIN</option>
                            </select>
                            <div class="invalid-tooltip">
                                Harus dipilih
                            </div>
                            @error('admin')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class=" text-end">
                            <button class="btn rounded btn-secondary" type="submit">Simpan <i
                                    class="fas fa-caret-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}
    <script>
        $('.del-btn').click(function() {
            var data = $(this).data('quantity').split('|');
            $('#del_id').val(data[0]);
            $('#del_name').html(data[1]);
        });

    </script>
    <div id="del-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-2">
                    <div class="text-center">
                        <i class="fa-solid fa-trash-can h1"></i>
                        <h4 class="mt-1">Hapus user?</h4>
                        <h5 class="mt-1" id="del_name"></h5>
                        <form method="POST" action="{{ route('admin_delete') }}">
                            @csrf
                            <input type="hidden" name="id" id="del_id">
                            <button type="button" class="btn btn-light my-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-light my-2 ms-2" type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.validate-this')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

    </script>
    {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
</x-app-layout>
