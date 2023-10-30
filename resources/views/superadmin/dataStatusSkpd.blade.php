<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">REKAP DATA PENGISIAN PERNYATAAN </h3>
                    <h5 class="card-subtitle text-muted mb-3">
                        <u>{{ ucwords(strtolower($skpd)) }}</u>
                    </h5>

                    <table id="data" class="table table-bordered table-sm" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                {{-- 0 --}} <th width="5%">No.</th>
                                {{-- 1 --}} <th width="25%">Nama </th>
                                {{-- 2 --}} <th width="15%">NIP</th>
                                {{-- 3 --}} <th width="">Email</th>
                                {{-- 4 --}} <th width="">No. HP</th>
                                {{-- 5 --}} <th width="">Jabatan</th>
                                {{-- 6 --}} <th width="">Pangkat</th>
                                {{-- 7 --}} <th width="">Penempatan</th>
                                {{-- 8 --}} <th width="">Pengisian</th>
                                {{-- 8 --}} <th width="">P #1</th>
                                {{-- 8 --}} <th width="">P #2</th>
                                {{-- 8 --}} <th width="">P #3</th>
                                {{-- 9 <th width="">Detail</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    <td class="text-center">{{ $n + 1 }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td> {{ substr($d->nip, 0, 8) . ' ' }}{{ substr($d->nip, 8, 6) . ' ' }}{{ substr($d->nip, 14, 1) . ' ' }}{{ substr($d->nip, 15) }}
                                    </td>
                                    <td>{{ $d->email }}</td>
                                    <td><a target="blank" class="text-secondary"
                                            href="https://wa.me/{{ '62' . substr($d->hp, 1) }}?text=Halo Bapak/Ibu {{ $d->name }}...">
                                            {{ $d->hp }}
                                        </a></td>
                                    <td>{{ $d->jabatan }}</td>
                                    <td>{{ $d->pangkat }}</td>
                                    <td>{{ $d->tempat }}</td>
                                    <td class="text-center">
                                        @if ($d->finish == 0)
                                            <i class="fa-solid fa-square-xmark text-danger"></i> belum
                                        @endif
                                        @if ($d->finish == 1)
                                            <i class="fa-solid fa-square-check text-success"></i> sudah
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        <input type="button" class="btn btn-secondary btn-sm font-11 ppx-2"
                                            data-quantity="{{ $d->name }}|{{ $d->nip }}|{{ $d->email }}|{{ $d->hp }}|{{ $d->unit }}|{{ $d->tempat }}|{{ $d->finish }}|{{ $d->jabatan }}|{{ $d->pangkat }}"
                                            value="lihat" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                    </td> --}}
                                    <td>{{ $d->status_1 }}</td>
                                    <td>{{ $d->status_2 }}</td>
                                    <td>{{ $d->status_3 }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <b class="mt-3">Klik pada nomor HP untuk membuka Whatsapp dan mengirim pesan pada nomor
                        tersebut.</b>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <script>
        $(function() {
            $("#data").DataTable({
                "pageLength": 10,
                "responsive": false,
                "lengthChange": true,
                "autoWidth": true,
                "order": [
                    [0, "asc"]
                ],
                "scrollY": 340,
                "columnDefs": [{
                    "targets": [0],
                    "visible": true,
                    "searchable": false
                }, {
                    "targets": [7],
                    "visible": false,
                }, {
                    "targets": [5],
                    "visible": false,
                }, {
                    "targets": [6],
                    "visible": false,
                }],
                "buttons": [{
                    extend: 'excel',
                    title: 'DATA PENGISIAN PERNYATAAN - {{ $skpd }}'
                }, {
                    extend: 'pdf',
                    title: 'DATA PENGISIAN PERNYATAAN - {{ $skpd }}',
                    orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'DATA PENGISIAN PERNYATAAN - {{ $skpd }}'
                }, {
                    extend: 'colvis',
                    text: 'Kolom',
                }],
            }).buttons().container().appendTo('#data_wrapper .col-md-6:eq(0)');
        });

        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    </script>
    <script>
        $('input:button').click(function() {
            var data = $(this).data('quantity').split('|');
            $('#nama').val(data[0]);
            $('#nip').val(data[1]);
            $('#email').val(data[2]);
            $('#hp').val(data[3]);
            $('#unit').val(data[4]);
            $('#tempat').val(data[5]);
            if (data[6] == 0) {
                var st = 'BELUM MEMBUAT PERNYATAAN';
                $('#fin').removeClass('text-success').addClass('text-danger');
            } else {
                var st = 'SUDAH MEMBUAT PERNYATAAN';
                $('#fin').removeClass('text-danger').addClass('text-success')
            }
            $('#fin').val(st);
            $('#jabatan').val(data[7]);
            $('#pangkat').val(data[8]);
        });

    </script>

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pegawai</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6  mb-2">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" id="nip" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="hp" class="form-label">No. HP</label>
                            <input type="text" id="hp" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" id="jabatan" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <input type="text" id="pangkat" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <label for="unit" class="form-label">SKPD</label>
                            <input type="text" id="unit" class="form-control" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="tempat" class="form-label">Penempatan</label>
                            <input type="text" id="tempat" class="form-control" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label class="form-label">Status Pengisian</label>
                            <input type="text" id="fin" class="form-control bolder">
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</x-app-layout>
