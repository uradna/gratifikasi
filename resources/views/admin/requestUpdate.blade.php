<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">UBAH DATA PEGAWAI</h3>
                    <h5>Gunakan menu ini jika ada pegawai yang tidak ditemukan di daftar pegawai dikarenakan belum
                        update data SKPD. Contoh, pegawai yang baru saja mutasi.
                        <h5 class="card-subtitle mb-3" style="line-height: 1.3rem">
                            Perubahan data akan dilakukan oleh super admin Inspektorat. Jika status "sudah diupdate",
                            anda dapat mengubah password melalui menu "<a href="{{ route('password') }}"
                                class="text-dark">UBAH
                                PASSWORD</a>"
                        </h5>

                        <div class="row">
                            <div class="col-md-12 text-end">
                                <a href="#" class="btn btn-secondary text-left mb-1" data-bs-toggle="modal"
                                    data-bs-target="#edit-modal">TAMBAH <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-hover table-sm " style="width: 100%">
                            <thead>
                                <tr>
                                    {{-- <th width="5%">No.</th> --}}
                                    <th>id</th>
                                    <th width="18%">Nama</th>
                                    <th width="15%">Nip</th>
                                    {{-- <th>Unit Kerja</th> --}}
                                    <th>SKPD Sebelumnya</th>
                                    <th>Keterangan</th>
                                    <th>Dokumen</th>
                                    <th style="text-align: center" width="10%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $n => $u)
                                    <tr>
                                        {{-- <td style="text-align: center">{{ $n + 1 }} </td> --}}
                                        <td>{{ $u->id }} </td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ substr($u->nip, 0, 8) }} {{ substr($u->nip, 8, 6) }}
                                            {{ substr($u->nip, 14, 1) }} {{ substr($u->nip, 15) }}</td>

                                        <td>{{ $u->unit_2 }}</td>
                                        <td>{{ $u->keterangan }}</td>
                                        <td><a href="../storage/{{ $u->file }}" target="_blank">Lihat</a></td>
                                        <td style="">
                                            @if ($u->status == 0)
                                                <i class="fa-solid fa-square-question text-warning"></i></i> menunggu
                                            @endif
                                            @if ($u->status == 1)
                                                <i class="fa-solid fa-square-check text-success"></i> diupdate
                                            @endif
                                            @if ($u->status == 2)
                                                <i class="fa-solid fa-square-xmark text-danger"></i> ditolak
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
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
                "ordering": true,
                "dom": 't<"float-start"f>p',
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }],
                "order": [
                    [0, "desc"]
                ],
                // "responsive": true,
                // "lengthChange": false,
                // "autoWidth": true,
                // "info": false,
                // "bFilter": false,
                // "order": [
                //     [2, "asc"]
                // ],
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

    <div id="edit-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Permintaan Ubah Data Pegawai</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate method="POST"
                        action="{{ route('sendUpdaterequest') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6 position-relative">
                            <label for="name" class="form-label ">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name"
                                value="{{ old('name') }}" required
                                placeholder="Nama pegawai, huruf besar semua, tanpa gelar">
                            <div class="invalid-tooltip">
                                Nama lengkap harus diisi
                            </div>
                            @error('name')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control form-control-sm" id="nip" name="nip"
                                value="{{ old('nip') }}" required placeholder="NIP pegawai, angka, tanpa spasi">
                            <div class="invalid-tooltip">
                                NIP harus diisi
                            </div>
                            @error('nip')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12 position-relative">
                            <label for="unit_1" class="form-label">Instansi/SKPD Sekarang</label>
                            <input class="form-control form-control-sm" id="unit_1" name="unit_1"
                                value="{{ $admin->unit }}" disabled readonly>
                        </div>
                        <div class="col-md-12 position-relative">
                            <label for="unit_2" class="form-label">Instansi/SKPD Bebelumnya</label>
                            <input class="form-control form-control-sm" list="datalistOptions" id="unit_2" name="unit_2"
                                placeholder="Pilih instansi" required value="{{ old('unit_2') }}" autocomplete="off">
                            <datalist id="datalistOptions">
                                @foreach ($unit as $u)
                                    <option value="{{ $u->unit }}">
                                @endforeach
                            </datalist>
                            <div class="invalid-tooltip">
                                Unit kerja sebelumnya, diisi sesuai dengan pilihan yang tersedia
                            </div>
                            @error('unit_2')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12 position-relative">
                            <label for="keterangan" class="form-label">Keterangan / alasan</label>
                            <input class="form-control form-control-sm" id="keterangan" name="keterangan"
                                placeholder="Beri keterangan/alasan update data. Contoh:mutasi" required
                                value="{{ old('keterangan') }}">
                        </div>

                        <div class="col-md-12 position-relative">
                            <label for="file" class="form-label">Dokumen pendukung</label>
                            <input type="file" id="file" name="file" class="form-control form-control-sm mb-2"
                                placeholder="Beri keterangan/alasan tambah pegawai. Contoh:CPNS" required>
                            <small class="text-muted">Upload scan dokumen pendukung seperti SK, dalam bentuk file
                                JPG atau PDF</small>
                            <div class="invalid-tooltip">
                                Harus dilengkapi dengan dokumen pendukung seperti SK
                            </div>
                            @error('file')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="col-12" style="text-align: right">
                            <button class="btn btn-secondary float-sm-end" type="submit">SIMPAN
                                <i class="fas fa-caret-right"></i></button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

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
    @if (Session::has('message'))
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
                        <p class="mt-3 mb-2">{!! session('message') !!}</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</x-app-layout>
