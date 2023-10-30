<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">DATA PEGAWAI {{ strtoupper(Auth::user()->unit) }}</h3>
                    <h5 class="card-subtitle text-muted mb-3">
                        @if ($data == 'semua')
                            Data semua pegawai {{ ucwords(strtolower(Auth::user()->unit)) }}
                        @else
                            Data pegawai yang <u>{{ $data }}</u> mengisi pernyataan gratifikasi
                        @endif

                    </h5>

                    <table id="example1" class="table table-bordered table-hover table-sm " style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No.</th> --}}
                                <th>Nama</th>
                                <th width="15%">Nip</th>
                                <th>No HP</th>
                                {{-- <th>Unit Kerja</th> --}}
                                <th>Penempatan</th>
                                <th width="6%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $n => $u)
                                <tr>
                                    {{-- <td style="text-align: center">{{ $n + 1 }} </td> --}}
                                    <td>{{ $u->name }} </td>
                                    <td>
                                        @if ($u->unit == 'PEJABAT NON-PNS')
                                            -
                                        @else
                                            {{ substr($u->nip, 0, 8) . ' ' }}{{ substr($u->nip, 8, 6) . ' ' }}{{ substr($u->nip, 14, 1) . ' ' }}{{ substr($u->nip, 15) }}
                                        @endif
                                        {{-- {{ substr($u->nip, 0, 8) }} {{ substr($u->nip, 8, 6) }}
                                        {{ substr($u->nip, 14, 1) }} {{ substr($u->nip, 15) }} --}}
                                    </td>
                                    <td><a target="blank" class="text-secondary"
                                            href="https://wa.me/{{ '62' . substr($u->hp, 1) }}?text=Halo Bapak/Ibu {{ $u->name }}...">
                                            {{ $u->hp }}
                                        </a></td>

                                    {{-- <td>{{ $u->unit }}</td> --}}
                                    <td>{{ $u->tempat }}</td>
                                    <td style="text-align: center">
                                        @if ($u->finish == 0)
                                            belum <i class="fa-solid fa-square-xmark text-danger"></i>
                                        @endif
                                        @if ($u->finish == 1)
                                            sudah <i class="fa-solid fa-square-check text-success"></i>
                                        @endif
                                    </td>
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
            $("#example1").DataTable({
                "pageLength": 10,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "order": [
                    [2, "asc"]
                ],
                "buttons": ["excel", "pdf", "print"],
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>

</x-app-layout>
