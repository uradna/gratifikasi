<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">DATA PERNYATAAN</h3>
                    <h5 class="card-subtitle text-muted mb-3">
                        <u>{{ ucwords(strtolower($skpd)) }}</u>
                    </h5>

                    <table id="data" class="table table-bordered table-sm" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                {{-- 0 --}}<th width="5%">No.</th>
                                {{-- 1 --}}<th width="">Nama</th>
                                {{-- 2 --}}<th width="15%">NIP</th>
                                {{-- 3 --}}<th width="">Email</th>
                                {{-- 4 --}}<th width="">HP</th>
                                {{-- 5 --}}<th width="">Pangkat</th>
                                {{-- 6 --}}<th width="">Jabatan</th>
                                {{-- 7 --}}<th width="">Penempatan</th>
                                {{-- 8 <th width="">Status</th> --}}
                                {{-- 9 --}}<th width="">P. #1</th>
                                {{-- 10 --}}<th width="">P. #2</th>
                                {{-- 11 --}}<th width="">P. #3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    {{-- 0 --}} <td class="text-center">{{ $n + 1 }}</td>
                                    {{-- 1 --}} <td>{{ $d->name }}</td>
                                    {{-- 2 --}} <td>
                                        {{ substr($d->nip, 0, 8) . ' ' }}{{ substr($d->nip, 8, 6) . ' ' }}{{ substr($d->nip, 14, 1) . ' ' }}{{ substr($d->nip, 15) }}
                                    </td>
                                    {{-- 3 --}} <td>{{ $d->email }}</td>
                                    {{-- 4 --}} <td><a target="blank" class="text-secondary"
                                            href="https://wa.me/{{ '62' . substr($d->hp, 1) }}?text=Halo Bapak/Ibu {{ $d->name }}...">
                                            {{ $d->hp }}
                                        </a></td>
                                    {{-- 5 --}} <td>{{ $d->jabatan }}</td>
                                    {{-- 6 --}} <td>{{ $d->pangkat }}</td>
                                    {{-- 7 --}} <td>{{ $d->tempat }}</td>
                                    {{-- 8 --}}
                                    {{-- <td>
                                        @if ($d->finish == 0)
                                            <i class="fa-solid fa-square-xmark text-danger"></i> belum
                                        @endif
                                        @if ($d->finish == 1)
                                            <i class="fa-solid fa-square-check text-success"></i> sudah
                                        @endif
                                    </td> --}}
                                    {{-- 9 --}} <td>
                                        @if ($d->status_1 == '0')
                                            Tidak
                                        @else
                                            Ya
                                        @endif
                                    </td>
                                    {{-- 10 --}} <td>
                                        @if ($d->status_2 == '0')
                                            Tidak
                                        @else
                                            Ya
                                        @endif
                                    </td>
                                    {{-- 11 --}} <td>
                                        @if ($d->status_3 == '0')
                                            Tidak
                                        @else
                                            Ya
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="row">
                        <h5 class="mt-2">Keterangan:</h5>
                        <div class="col-12">
                            Pernyataan 1 : MENERIMA Gratifikasi <br>
                            Pernyataan 2 : MENERIMA Gratifikasi dan TELAH Melaporkannya Kepada UPG/KPK <br>
                            Pernyataan 3 : MENERIMA Gratifikasi dan BELUM Melaporkannya Kepada UPG/KPK <br>
                        </div>
                    </div>
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
                        "targets": [0], //No.
                        "visible": true,
                        "searchable": false
                    }, {
                        "targets": [1], //Nama
                        "visible": true,
                    }, {
                        "targets": [2], //NIP
                        "visible": true,
                    }, {
                        "targets": [3], //email
                        "visible": true,
                    }, {
                        "targets": [4], //hp
                        "visible": true,
                    }, {
                        "targets": [5], //pangkat
                        "visible": false
                    }, {
                        "targets": [6], //jabatan
                        "visible": false
                    }, {
                        "targets": [7], //penempatan
                        "visible": false
                    },
                    //  {
                    //     "targets": [8], //finish
                    //     "visible": true
                    // },
                    {
                        "targets": [8], //p1
                        "visible": true
                    }, {
                        "targets": [9], //p2
                        "visible": true
                    }, {
                        "targets": [10], //p3
                        "visible": true
                    }
                ],
                "buttons": [{
                    extend: 'excel',
                    title: 'DATA LAPORAN PERNYATAAN - {{ $skpd }}'
                }, {
                    extend: 'pdf',
                    title: 'DATA LAPORAN PERNYATAAN - {{ $skpd }}',
                    orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'DATA LAPORAN PERNYATAAN - {{ $skpd }}'
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
            $('#unit').val(data[2]);
            $('#tempat').val(data[3]);
            if (data[4] == 0) {
                $('#i1').html('<i class="far fa-square"></i>');
            } else {
                $('#i1').html('<i class="fas fa-check-square"></i>');
            }
            if (data[5] == 0) {
                $('#i2').html('<i class="far fa-square"></i>');
            } else {
                $('#i2').html('<i class="fas fa-check-square"></i>');
            }
            if (data[6] == 0) {
                $('#i3').html('<i class="far fa-square"></i>');
            } else {
                $('#i3').html('<i class="fas fa-check-square"></i>');
            }

        });
        // 4,5,6

    </script>

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pernyataan</h4>
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
                        <div class="col-sm-12 mb-2">
                            <label for="unit" class="form-label">SKPD</label>
                            <input type="text" id="unit" class="form-control" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="tempat" class="form-label">Penempatan</label>
                            <input type="text" id="tempat" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="unit" class="form-label">Pernyataan</label>
                        <table class="table table-hover table-sm mb-0">
                            <tr class="">
                                <td style="width: 10px;"><b id="i1"><i class="far fa-square"></i></b></td>
                                <td><b>TIDAK PERNAH Menerima Gratifikasi</b></td>
                            </tr>
                            <tr>
                                <td><b id="i2"><i class="fas fa-check-square"></i></b></td>
                                <td><b>MENERIMA Gratifikasi dan TELAH Melaporkannya Kepada UPG/KPK</b></td>
                            </tr>
                            <tr>
                                <td><b id="i3"><i class="fas fa-check-square"></i></b></td>
                                <td><b>MENERIMA Gratifikasi Namun BELUM Melaporkannya Kepada UPG/KPK</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</x-app-layout>
