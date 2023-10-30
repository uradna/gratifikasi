<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">RESET PENGISIAN PERNYATAAN</h3>
                    <h5 class="card-subtitle text-muted"></h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <form class="row ps-2 needs-validation" method="POST" action="{{ route('reset') }}">
                            @csrf
                            <div class="col-12 mb-2"><label for="nip">Masukkan NIP, tanpa spasi</label></div>
                            <div class="col-6">

                                <input type="" class="form-control bg-white" id="nip" name="nip"
                                    placeholder="NIP, tanpa spasi" required
                                    value="@isset($alert){{ $alert }}@endisset">
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-secondary">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset($user)
                        <div class="card-body">
                            <h5 class="card-subtitle  mb-3">
                                HASIL PENCARIAN PEGAWAI
                            </h5>
                            <table id="example1" class="table table-bordered table-sm table-hover" style="width: 100%">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>HP</th>
                                        <th>Unit</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $n => $d)
                                        <tr>
                                            <td class="bg-white">{{ $d->name }} </td>
                                            <td class="bg-white"><a href="{{ route('deleteuser_search', $d->nip) }}"
                                                    class="text-secondary">
                                                    {{ $d->nip }} </a></td>
                                            <td class="bg-white"><a target="blank" class="text-secondary"
                                                    href="https://wa.me/{{ '62' . substr($d->hp, 1) }}?text=Halo Bapak/Ibu {{ $d->name }}...">
                                                    {{ $d->hp }}
                                                </a></td>
                                            <td class="bg-white">{{ $d->unit }} </td>
                                            <td class="bg-white">
                                                @if ($d->finish == '1')
                                                    <i class="fa-solid fa-check text-success"></i> Sudah
                                                @else
                                                    <i class="fa-solid fa-square-xmark text-danger"></i> Belum
                                                @endif
                                            </td>
                                            <td class="text-center bg-white">
                                                @if ($d->finish == '1')
                                                    <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2 ed-btn"
                                                        data-quantity="{{ $d->id }}|{{ $d->name }}|{{ $d->nip }}|{{ $d->unit }}"
                                                        value="Reset" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endisset

                </div>
            </div>
        </div>

        <script>
            $(function() {
                $("#example1").DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "info": false,
                    "bFilter": false

                    // "dom": '<"mb-1"t><"float-start"f>p',

                    // "buttons": ["excel", "pdf", "print", ],
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

        </script>
        {{-- MODAL START --}}
        <script>
            $('.ed-btn').click(function() {
                var data = $(this).data('quantity').split('|');
                $('#ed_id').val(data[0]);
                $('#ed_name').val(data[1]);
                $('#ed_nip').val(data[2]);
                $('#ed_unit').val(data[3]);
            });

        </script>
        <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reset Data Pegawai</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal validate-this px-2" novalidate method="POST"
                            action="{{ route('reset_post') }}">
                            @csrf
                            <input type="text" id="ed_id" name="id" value="{{ old('id') }}">
                            {{-- <input type="hidden" name="form" value="edit-modal"> --}}
                            <div class="row">
                                <div class="col-sm-6 position-relative mb-2">
                                    <label class="control-label">Nama</label>
                                    <input type="text" class="form-control form-control-sm" name="" id="ed_name"
                                        value="{{ old('name') }}" required readonly />
                                </div>
                                <div class="col-sm-6 position-relative mb-2">
                                    <label class="control-label">NIP</label>
                                    <input type="text" class="form-control form-control-sm" name="nip" id="ed_nip" required
                                        value="{{ old('nip') }}" readonly />
                                </div>
                            </div>
                            <div class="col-sm-12 position-relative mb-3">
                                <label class="control-label">SKPD</label>
                                <input class="form-control form-control-sm" id="ed_unit" name=""
                                    placeholder="Pilih instansi" value="{{ old('unit') }}" readonly>
                            </div>
                            <div class=" text-end">
                                <button class="btn rounded btn-success me-3" type="submit">Ya
                                    <i class="fas fa-check"></i>
                                </button>
                                <button id="tolak" href="" class="btn rounded btn-danger" data-bs-dismiss="modal"
                                    type="button">Tidak <i class="fas fa-xmark"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @isset($alert)
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#sukses').modal('show');
                });

            </script>
            <div id="sukses" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content ">
                        <div class="modal-body p-1">
                            <div class="text-center">
                                <i class="fa-solid fa-badge-check h2 text-success"></i>
                                <h4 class="mt-2">Berhasil!</h4>
                                <p class="mt-3 mb-2">Data pegawai dengan NIP {{ $alert }} berhasil direset</p>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endisset
    </x-app-layout>
