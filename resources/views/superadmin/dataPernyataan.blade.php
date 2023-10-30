<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">REKAP DATA PERNYATAAN SEMUA SKPD</h3>
                    <h5 class="card-subtitle text-muted mb-3">
                        Klik pada nama SKPD untuk melihat detail data pernyataan.
                    </h5>
                    <table id="data" class="table table-bordered table-sm" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="">No.</th>
                                <th width="">SKPD </th>
                                <th width="">Jumlah Pegawai </th>
                                <th width="">Sudah Mengisi </th>
                                <th width="">Pernyataan 1 </th>
                                <th width="">Pernyataan 2 </th>
                                <th width="">Pernyataan 3 </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    <td class="text-center">{{ $n + 1 }}</td>
                                    <td>
                                        @if ($d->unit == '')
                                            <b> PEGAWAI TANPA DATA SKPD</b>
                                        @else<a href="{{ route('pernyataanskpd', $d->unit) }}"
                                                class="text-secondary">{{ $d->unit }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $d->n }}</td>
                                    <td>{{ $d->c }}</td>
                                    <td>{{ $d->p1 }}</td>
                                    <td>{{ $d->p2 }}</td>
                                    <td>{{ $d->p3 }}</td>
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
                    "targets": [0],
                    "visible": true,
                    "searchable": false
                }],
                "buttons": [{
                    extend: 'excel',
                    title: 'REKAP DATA PENGISIAN PERNYATAAN SEMUA SKPD'
                }, {
                    extend: 'pdf',
                    title: 'REKAP DATA PENGISIAN PERNYATAAN SEMUA SKPD',
                    // orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'REKAP DATA PENGISIAN PERNYATAAN SEMUA SKPD'
                }],
            }).buttons().container().appendTo('#data_wrapper .col-md-6:eq(0)');
        });

        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    </script>

</x-app-layout>
