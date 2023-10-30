<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">HAPUS PEGAWAI</h3>
                    <h5 class="card-subtitle mb-3" style="line-height: 1.3rem">
                        Gunakan fitur search untuk mengajukan penghapusan data data pegawai jika pegawai sudah tidak
                        lagi menjadi PNS, contoh: dikarenakan sudah pensiun.
                    </h5>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            @if ($mode == 'daftarhapus')
                                <a href="{{ route('deleterequest_list') }}"
                                    class="btn btn-secondary text-left mb-1">LIHAT
                                    DATA PEGAWAI
                                    <i class="fas fa-caret-right"></i></a>
                            @else
                                <a href="{{ route('deleterequest') }}" class="btn btn-secondary text-left mb-1">
                                    <i class="fas fa-caret-left"></i> LIHAT DATA PENGAJUAN
                                </a>
                            @endif

                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-hover table-sm " style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No.</th> --}}
                                <th>Nama</th>
                                <th width="15%">Nip</th>
                                {{-- <th>Unit Kerja</th> --}}
                                <th>Penempatan</th>
                                @if ($mode == 'daftarhapus')
                                    <th>Keterangan</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                @else
                                    <th width="10%">Aksi</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $u)
                                <tr>
                                    {{-- <td style="text-align: center">{{ $n + 1 }} </td> --}}
                                    <td>{{ $u->name }} </td>
                                    <td>{{ substr($u->nip, 0, 8) }} {{ substr($u->nip, 8, 6) }}
                                        {{ substr($u->nip, 14, 1) }} {{ substr($u->nip, 15) }}</td>

                                    {{-- <td>{{ $u->unit }}</td> --}}
                                    <td>{{ $u->tempat }}</td>
                                    @if ($mode == 'daftarhapus')
                                        <td>{{ $u->keterangan }}</td>
                                        <td><a href="../storage/{{ $u->file }}" target="_blank">Lihat</a></td>
                                        <td>
                                            @if ($u->status == 0)
                                                <i class="fa-solid fa-square-xmark text-danger"></i> menunggu
                                            @endif
                                            @if ($u->status == 1)
                                                <i class="fa-solid fa-square-check text-success"></i> disetujui
                                            @endif
                                            @if ($u->status == 2)
                                                <i class="fa-solid fa-square-check text-success"></i> ditolak
                                            @endif
                                        </td>
                                    @else
                                        <td style="text-align: center">
                                            <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2 ed-btn"
                                                data-quantity="{{ $u->id }}|{{ $u->name }}|{{ $u->nip }}|{{ $u->tempat }}"
                                                value="Hapus Data" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                        </td>
                                    @endif

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
            $('#id').val(data[0]);
            $('#name').val(data[1]);
            $('#nip').val(data[2]);
            $('#tempat').val(data[3]);
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
                    [0, "asc"]
                ],
                "dom": 't<"float-start"f>p',
                // "buttons": ["excel", "pdf", "print", ],
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>
    {{-- @if (old('name') != null)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#edit-modal').modal('show');
            });

        </script>
    @endif --}}

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal px-1 needs-validation" novalidate method="POST"
                        action="{{ route('sendDeleterequest') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" id="id" name="id" value="{{ old('id') }}"> --}}
                        <div class="row">
                            <div class="col-md-12 position-relative mb-3">
                                <label class="form-label ">Nama</label>
                                <input type="text" class="form-control form-control-sm" value="" readonly id="name"
                                    name="name">
                            </div>

                            <div class="col-md-12 position-relative mb-3">
                                <label class="form-label ">NIP</label>
                                <input type="text" class="form-control form-control-sm" value="" id="nip" name="nip">
                            </div>

                            <div class="col-md-12 position-relative mb-3">
                                <label class="form-label ">Keterangan / alasan</label>
                                <input type="text" class="form-control form-control-sm" value="" id="keterangan"
                                    name="keterangan" placeholder="Isi dengan keterangan/alasan penghapusan data."
                                    required>
                                <div class="invalid-tooltip">
                                    Harus diisi dengan keterangan atau alasan penghapusan data
                                </div>
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

                        </div>

                        <input type="hidden" id="unit" name="unit" value="{{ Auth::user()->unit }}">
                        <input type="hidden" id="tempat" name="tempat" value="">
                        <div class="mt-3 text-end">
                            <button class="btn rounded btn-secondary" type="submit">
                                Hapus Data <i class="fas fa-caret-right"></i></button>
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
