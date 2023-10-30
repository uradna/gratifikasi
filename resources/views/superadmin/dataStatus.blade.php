<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">REKAP DATA PENGISIAN PERNYATAAN SEMUA SKPD</h3>
                    <h5 class="card-subtitle text-muted mb-3">
                        Klik pada nama SKPD untuk melihat detail data pengisian pernyataan.
                    </h5>
                    <table id="data" class="table table-bordered table-sm" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="50%">SKPD </th>
                                <th width="">Jumlah Pegawai </th>
                                <th width="">Sudah </th>
                                <th width="">Belum </th>
                                <th width="">Sudah (%) </th>
                                <th width="">Belum (%) </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    <td class="text-center">{{ $n + 1 }}</td>
                                    <td>
                                        @if ($d->unit == null)
                                            <b><a href="{{ route('datanull') }}">PEGAWAI TANPA DATA SKPD</a></b>
                                        @else<a href="{{ route('statusskpd', $d->unit) }}"
                                                class="text-secondary">{{ $d->unit }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $d->total }}</td>
                                    <td>{{ $d->sudah }}</td>
                                    <td>{{ $d->belum }}</td>
                                    <td>{{ round(($d->sudah / ($d->sudah + $d->belum)) * 100, 1) }} %</td>
                                    <td>{{ round(($d->belum / ($d->sudah + $d->belum)) * 100, 1) }} %</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
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
                "scrollY": 390,
                "columnDefs": [{
                    "targets": [0],
                    "visible": true,
                    "searchable": false
                }],
                "buttons": [{
                    extend: 'excel',
                    title: 'DATA PENGISIAN PERNYATAAN SEMUA SKPD'
                }, {
                    extend: 'pdf',
                    title: 'DATA PENGISIAN PERNYATAAN SEMUA SKPD',
                    // orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'DATA PENGISIAN PERNYATAAN SEMUA SKPD'
                }],
            }).buttons().container().appendTo('#data_wrapper .col-md-6:eq(0)');
        });

        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    </script>

</x-app-layout>
