<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">GANTI PASSWORD</h3>
                    <h5 class="card-subtitle  mb-2">
                        Gunakan fitur search untuk mencari pegawai yang akan diganti passwordnya.
                    </h5>
                    <h5 class="card-subtitle mb-3" style="line-height: 1.3rem">
                        Jika data pegawai tidak ditemukan, kemungkinan dikarenakan pegawai tersebut masih terdaftar
                        sebagai pegawai di SKPD lain karena mutasi atau belum melakukan update data di SimasHebat.
                        <br>Ajukan permintaan ke super admin Inspektorat melalui menu
                        "<a href="{{ route('updaterequest') }}" class="text-dark">UBAH DATA PEGAWAI</a>", kemudian
                        ubah password setelah data SKPD diupdate.
                    </h5>

                    <table id="example1" class="table table-bordered table-hover table-sm " style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No.</th> --}}
                                <th width="28%">Nama</th>
                                <th width="15%">Nip</th>
                                {{-- <th>Unit Kerja</th> --}}
                                <th>Penempatan</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $n => $u)
                                <tr>
                                    {{-- <td style="text-align: center">{{ $n + 1 }} </td> --}}
                                    <td>{{ $u->name }} </td>
                                    <td>
                                        @if ($u->unit == 'PEJABAT NON-PNS')
                                            -
                                        @else
                                            {{ substr($u->nip, 0, 8) . ' ' }}{{ substr($u->nip, 8, 6) . ' ' }}{{ substr($u->nip, 14, 1) . ' ' }}{{ substr($u->nip, 15) }}
                                        @endif
                                    </td>

                                    {{-- <td>{{ $u->unit }}</td> --}}
                                    <td>{{ $u->tempat }}</td>
                                    <td style="text-align: center">
                                        <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2 ed-btn"
                                            data-quantity="{{ $u->id }}|{{ $u->name }}|{{ $u->nip }}"
                                            value="Ubah Password" data-bs-toggle="modal" data-bs-target="#edit-modal">
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
        $('input:button').click(function() {
            var data = $(this).data('quantity').split('|');
            $('#idu').val(data[0]);
            $('#nameu').val(data[1]);
            $('#nipu').val(data[2]);
            $('#password').val('');
            $('#confirmPassword').val('');
        });

    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 7,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "info": false,
                "order": [
                    [2, "asc"]
                ],
                "dom": 'ftp',
                // "buttons": ["excel", "pdf", "print", ],
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>
    @if (old('name') != null)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#edit-modal').modal('show');
            });

        </script>
    @endif

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="identicalForm" class="form-horizontal px-1" method="POST"
                        action="{{ route('gantiPassword') }}">
                        @csrf
                        <input type="hidden" id="idu" name="id" value="{{ old('id') }}">
                        <div class="row mb-2">
                            <div class="col-sm-12 fw-semibold">
                                Nama
                            </div>
                            <div class="col-sm-12">
                                <input type="text" id="nameu" class="form-control form-control-sm" name="name" readonly
                                    value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 fw-semibold">
                                NIP
                            </div>
                            <div class="col-sm-12">
                                <input type="text" id="nipu" class="form-control form-control-sm" name="nip" readonly
                                    value="{{ old('nip') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 position-relative mb-3">
                            <label class="control-label">Password baru</label>
                            <input type="text" class="form-control fake-password  form-control-sm" name="password"
                                id="password" data-bv-identical="true" data-bv-identical-field="confirmPassword"
                                data-bv-identical-message="Masukkan password yang sama" />
                            @error('password')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-12 position-relative mb-2">
                            <label class="control-label">Ulangi password</label>
                            <input type="text" class="form-control fake-password  form-control-sm"
                                name="confirmPassword" id="confirmPassword" data-bv-identical="true"
                                data-bv-identical-field="password"
                                data-bv-identical-message="Masukkan password yang sama" />
                        </div>

                        <small class="text-muted">Password minimal 8 karakter</small>
                        <div class=" text-end">
                            <button class="btn rounded btn-secondary" type="submit" disabled>
                                Ubah Password <i class="fas fa-caret-right"></i></button>
                        </div>

                    </form>

                    <script>
                        $(document).ready(function() {
                            $('#identicalForm').bootstrapValidator();
                        });

                    </script>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @if (Session::has('berhasil'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#success-alert-modal').modal('show');
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
</x-app-layout>
