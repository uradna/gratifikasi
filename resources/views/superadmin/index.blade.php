<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">DASBOARD SUPERADMIN</h3>
                    <h5 class="card-subtitle text-muted"> {{ strtoupper(Auth::user()->unit) }}</h5>
                </div>
                <div class="card-body pt-0">
                    <h5>Masa aplikasi dapat digunakan untuk pengisian pernyataan</h5>
                    <form class="row ps-2 needs-validation" novalidate method="POST"
                        action="{{ route('updateTanggal') }}">
                        @csrf

                        <table class="table table-bordered table-sm mb-0" style="width: 50%">
                            <thead class="table-secondary">
                                <th width="">Dibuka tanggal </th>
                                <th width="">Ditutup tanggal </th>
                                <th width="10%"></th>
                            </thead>
                            <tbody>
                                <td>
                                    <div class="position-relative">
                                        <input type="date" class="form-control bg-white" id="tgl_1" name="tgl_1"
                                            value="{{ $tanggal[0]->tgl_1 }}" min="2022-03-01" max="2022-06-30"
                                            required>
                                        @error('tgl_1')
                                            <div class="validation-error">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="position-relative">
                                        <input type="date" class="form-control bg-white" id="tgl_2" name="tgl_2"
                                            value="{{ $tanggal[0]->tgl_2 }}" min="2022-03-01" max="2022-06-30"
                                            required>
                                        @error('tgl_2')
                                            <div class="validation-error">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                                <td><button type="submit" class="btn btn-secondary">Update</button></td>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="card-body pt-0">
                    <h5 class="">Data pengisian pernyataan - Semua Instansi </h5>
                    <table id="data1" class="table table-bordered table-sm table-hover" style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="33%">Status </th>
                                <th width="33%">Jumlah </th>
                                <th width="33%">Persentase </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($count as $n => $c)
                                <tr>
                                    <td class="bg-white">
                                        @if ($c->finish == 0)
                                            Belum mengisi
                                        @endif
                                        @if ($c->finish == 1)
                                            Sudah mengisi
                                        @endif
                                    </td>
                                    <td class="bg-white">{{ $c->jml }}</td>
                                    {{-- <td style="background-color: #fff !important">{{ ($c->jml / $max) * 100 }}%</td> --}}
                                    <td style="background-color: #fff !important">
                                        {{ round(($c->jml / $max[0]->max) * 100, 1) }}%</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-body pt-0">
                    <h5 class="">Data laporan gratifikasi - Semua Instansi
                    </h5>
                    <table id="data2" class="table table-bordered table-sm " style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="33%">Pegawai yang melaporkan gratifikasi ke KPK</th>
                                <th width="33%">Pegawai yang belum melaporkan gratifikasi</th>
                                <th width="33%">Jumlah gratifikasi yang dilaporkan </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bg-white">{{ $pelaporkpk[0]->n }}</td>
                                <td class="bg-white">{{ $pelapor[0]->n }}</td>
                                <td class="bg-white">{{ $laporan[0]->n }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#data1").DataTable({
                "pageLength": 10,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "paging": false,
                "filter": false,
                "info": false,
                "order": [
                    [0, "asc"]
                ],
                "buttons": [{
                    extend: 'excel',
                    title: 'Data pengisian pernyataan - Semua Instansi'
                }, {
                    extend: 'pdf',
                    title: 'Data pengisian pernyataan - Semua Instansi',
                    // orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'Data pengisian pernyataan - Semua Instansi'
                }],
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#data1_wrapper .col-md-6:eq(0)');

            $("#data2").DataTable({
                "pageLength": 10,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "paging": false,
                "filter": false,
                "info": false,
                "order": [
                    [0, "asc"]
                ],
                "buttons": [{
                    extend: 'excel',
                    title: 'Data laporan gratifikasi - Semua Instansi'
                }, {
                    extend: 'pdf',
                    title: 'Data laporan gratifikasi - Semua Instansi',
                    orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'Data laporan gratifikasi - Semua Instansi',
                }],

                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#data2_wrapper .col-md-6:eq(0)');
        });

    </script>
    {{-- <script>
        $(function() {
            $("#data2").DataTable({
                "pageLength": 10,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "paging": false,
                "filter": false,
                "info": false,
                "order": [
                    [1, "asc"]
                ],
                "buttons": [{
                    extend: 'excel',
                    title: 'Data pengisian pernyataan - {{ ucwords(strtolower(Auth::user()->unit)) }}'
                }, {
                    extend: 'pdf',
                    title: 'Data pengisian pernyataan - {{ ucwords(strtolower(Auth::user()->unit)) }}',
                    // orientation: 'landscape'
                }, {
                    extend: 'print',
                    title: 'Data pengisian pernyataan - {{ ucwords(strtolower(Auth::user()->unit)) }}'
                }],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script> --}}

</x-app-layout>
