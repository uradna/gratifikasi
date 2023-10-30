<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">DELETE DATA PEGAWAI</h3>
                    <h5 class="card-subtitle  mb-3">
                        Delete/hapus data SKPD pegawai. Klik nomor HP untuk membuka WA. Klik NIP untuk melihat data
                        pegawai
                        saat ini.
                    </h5>

                    <table id="example1" class="table table-bordered table-sm table-hover" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="2%" class="text-center">No.</th>
                                <th class="text-center">ID</th>
                                <th>Pemohon</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>HP</th>
                                <th>Unit</th>
                                <th>Penempatan</th>
                                <th>Dokumen</th>
                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    <td class="text-center bg-white">{{ $n + 1 }} </td>
                                    <td class="text-center bg-white">{{ $d->id }} </td>
                                    <td class="bg-white">{{ $d->pemohon }} </td>
                                    <td class="bg-white">{{ $d->name }} </td>
                                    <td class="bg-white"><a href="{{ route('deleteuser_search', $d->nip) }}"
                                            class="text-secondary">
                                            {{ $d->nip }} </a></td>
                                    <td class="bg-white">{{ $d->email }} </td>
                                    <td class="bg-white"><a target="blank" class="text-secondary"
                                            href="https://wa.me/{{ '62' . substr($d->hp, 1) }}?text=Halo Bapak/Ibu {{ $d->name }}...">
                                            {{ $d->hp }}
                                        </a></td>
                                    <td class="bg-white">{{ $d->unit }} </td>
                                    <td class="bg-white">{{ $d->tempat }} </td>
                                    <td class="bg-white"><a href="../storage/{{ $d->file }}"
                                            target="_blank">Lihat</a> </td>
                                    <td class="text-center bg-white">
                                        <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2 ed-btn"
                                            data-quantity="{{ $d->id }}|{{ $d->pemohon }}|{{ $d->name }}|{{ $d->nip }}|{{ $d->unit }}|{{ $d->tempat }}|{{ $d->keterangan }}"
                                            value="Delete" data-bs-toggle="modal" data-bs-target="#edit-modal">
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
                "autoWidth": false,
                "info": false,
                "scrollY": 340,
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [{
                    "targets": [5], //No.
                    "visible": false,
                    // "searchable": false,
                    // "orderable": false
                }, {
                    "targets": [0], //No.
                    "visible": false,
                    // "searchable": false,
                    // "orderable": false
                }, {
                    "targets": [6], //No.
                    "visible": false,
                    // "searchable": false,
                    // "orderable": false
                }, {
                    "targets": [8], //No.
                    "visible": false,
                    // "searchable": false,
                    // "orderable": false
                }],
                // "dom": '<"mb-1"t><"float-start"f>p',
                "buttons": [{

                    extend: 'colvis',
                    text: 'Kolom',
                }],
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
        $('.ed-btn').click(function() {
            var data = $(this).data('quantity').split('|');
            var link_tolak = '/superadmin/deleteuser/tolak/' + data[0];
            $('#ed_id').val(data[0]);
            $('#pemohon').val(data[1]);
            $('#ed_name').val(data[2]);
            $('#ed_nip').val(data[3]);
            $('#ed_unit').val(data[4]);
            $('#ed_tempat').val(data[5]);
            $('#keterangan').val(data[6]);
            $('#tolak').attr('href', link_tolak);

        });

    </script>
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete data pegawai</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal validate-this px-2" novalidate method="POST"
                        action="{{ route('deleteuser_post') }}">
                        @csrf
                        <input type="hidden" id="ed_id" name="id" value="{{ old('id') }}">
                        {{-- <input type="hidden" name="form" value="edit-modal"> --}}
                        <div class="row">
                            <div class="col-sm-12 position-relative mb-2">
                                <label class="control-label">Pemohon delete data</label>
                                <input type="text" class="form-control form-control-sm" id="pemohon" readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">Nama</label>
                                <input type="text" class="form-control form-control-sm" name="" id="ed_name"
                                    value="{{ old('name') }}" required readonly />
                            </div>
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">NIP</label>
                                <input type="text" class="form-control form-control-sm" name="" id="ed_nip" required
                                    value="{{ old('nip') }}" readonly />
                            </div>
                        </div>
                        <div class="col-sm-12 position-relative mb-2">
                            <label class="control-label">SKPD</label>
                            <input class="form-control form-control-sm" id="ed_unit" name=""
                                placeholder="Pilih instansi" value="{{ old('unit') }}" readonly>
                        </div>
                        {{-- <div class="col-sm-12 position-relative mb-2">
                            <label class="control-label">Satuan Kerja</label>
                            <input class="form-control form-control-sm" id="ed_tempat" name=""
                                value="{{ old('unit') }}" autocomplete="off">
                        </div> --}}
                        <div class="col-sm-12 position-relative mb-2">
                            <label class="control-label">Keterangan / alasan</label>
                            <input class="form-control form-control-sm" id="keterangan" name=""
                                placeholder="Keterangan / alasan kosong" value="{{ old('keterangan') }}">
                        </div>

                        <div class=" text-end">
                            <button class="btn rounded btn-success" type="submit">Setuju
                                <i class="fas fa-check"></i>
                            </button>
                            <a id="tolak" href="" class="btn rounded btn-danger" type="button">Tolak <i
                                    class="fas fa-xmark"></i>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}


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
    @isset($pegawai)
        <div id="datapegawai" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data pegawai</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">Nama</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->name }}" readonly />
                            </div>
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">NIP</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->nip }}" readonly />
                            </div>
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">Email</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->email }}" readonly />
                            </div>
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">No. HP</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->hp }}" readonly />
                            </div>

                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">Jabatan</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->jabatan }}" readonly />
                            </div>
                            <div class="col-sm-6 position-relative mb-2">
                                <label class="control-label">Pangkat</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->pangkat }}" readonly />
                            </div>

                            <div class="col-sm-12 position-relative mb-2">
                                <label class="control-label">Unit/SKPD</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->unit }}" readonly />
                            </div>
                            <div class="col-sm-12 position-relative mb-2">
                                <label class="control-label">Penempatan</label>
                                <input class="form-control form-control-sm" value="{{ $pegawai->tempat }}" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(window).on('load', function() {
                $('#datapegawai').modal('show');
            });

        </script>
    @endisset
</x-app-layout>
