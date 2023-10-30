<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">REKAP DATA LAPORAN GRATIFIKASI SEMUA SKPD</h3>
                    <h5 class="card-subtitle text-muted mb-3">
                        Klik pada nama SKPD untuk melihat detail data laporan gratifikasi.
                    </h5>
                    <table id="data" class="table table-bordered table-sm" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="5%">No.</th>
                                <th>SKPD </th>
                                <th width="">Jumlah laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $n => $d)
                                <tr>
                                    <td class="text-center">{{ $n + 1 }}</td>
                                    <td>
                                        @if ($d->unit == '')
                                            <b> PEGAWAI TANPA DATA SKPD</b>
                                        @else<a href="{{ route('gratifikasiskpd', $d->unit) }}"
                                                class="text-secondary">{{ $d->unit }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $d->p1 }}</td>
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
                "scrollY": 340,
                "columnDefs": [{
                    "targets": [0],
                    "visible": true,
                    "searchable": false
                }],
                "buttons": [{
                    extend: 'excel',
                    title: 'REKAP DATA LAPORAN GRATIFIKASI SEMUA SKPD'
                }, {
                    extend: 'pdf',
                    title: 'REKAP DATA LAPORAN GRATIFIKASI SEMUA SKPD'
                    // orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'REKAP DATA LAPORAN GRATIFIKASI SEMUA SKPD'
                }],
            }).buttons().container().appendTo('#data_wrapper .col-md-6:eq(0)');
        });

        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    </script>

</x-app-layout>
