<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <h3 class="card-title">DASBOARD ADMIN SKPD</h3>
                    <h5 class="card-subtitle text-muted mb-3"> {{ strtoupper(Auth::user()->unit) }}</h5>
                    <h5>Masa aplikasi dapat digunakan untuk pengisian pernyataan</h5>

                    <table class="table table-bordered table-sm mb-0" style="width: 50%">
                        <thead class="table-secondary">
                            <th width="">Dibuka tanggal </th>
                            <th width="">Ditutup tanggal </th>
                        </thead>
                        <tbody>
                            <td>
                                {{ \Carbon\Carbon::parse($tanggal->tgl_1)->format('d') }}
                                @switch(\Carbon\Carbon::parse($tanggal->tgl_1)->format('n'))
                                    @case(1)
                                        Januari
                                    @break
                                    @case(2)
                                        Februari
                                    @break
                                    @case(3)
                                        Maret
                                    @break
                                    @case(4)
                                        April
                                    @break
                                    @case(5)
                                        Mei
                                    @break
                                    @case(6)
                                        Juni
                                    @break
                                    @case(7)
                                        Juli
                                    @break
                                    @case(8)
                                        Agustus
                                    @break
                                    @case(9)
                                        September
                                    @break
                                    @case(10)
                                        Oktober
                                    @break
                                    @case(11)
                                        November
                                    @break
                                    @case(12)
                                        Desember
                                    @break
                                @endswitch
                                {{ \Carbon\Carbon::parse($tanggal->tgl_1)->format('Y') }}
                            </td>
                            <td>
                                <div class="position-relative">

                                    {{ \Carbon\Carbon::parse($tanggal->tgl_2)->format('d') }}
                                    @switch(\Carbon\Carbon::parse($tanggal->tgl_2)->format('n'))
                                        @case(1)
                                            Januari
                                        @break
                                        @case(2)
                                            Februari
                                        @break
                                        @case(3)
                                            Maret
                                        @break
                                        @case(4)
                                            April
                                        @break
                                        @case(5)
                                            Mei
                                        @break
                                        @case(6)
                                            Juni
                                        @break
                                        @case(7)
                                            Juli
                                        @break
                                        @case(8)
                                            Agustus
                                        @break
                                        @case(9)
                                            September
                                        @break
                                        @case(10)
                                            Oktober
                                        @break
                                        @case(11)
                                            November
                                        @break
                                        @case(12)
                                            Desember
                                        @break
                                    @endswitch
                                    {{ \Carbon\Carbon::parse($tanggal->tgl_2)->format('Y') }}

                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">

                    <h5 class=" mb-2 mt-1">Data jumlah pegawai yang belum dan sudah melakukan
                        pengisian.
                    </h5>
                    <table id="example1" class="table table-bordered table-sm " style="width: 100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="50%">Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit as $n => $u)
                                <tr style="background-color: #fff !important">
                                    <td style="background-color: #fff !important">
                                        @if ($u->finish == 0)
                                            <a class="dropdown-item" href="{{ route('data_pegawai', 'belum') }}"><i
                                                    class="fa-solid fa-square-xmark text-danger"></i> Belum mengisi</a>
                                        @endif
                                        @if ($u->finish == 1)
                                            <a class="dropdown-item" href="{{ route('data_pegawai', 'sudah') }}"><i
                                                    class="fa-solid fa-square-check text-success"></i> Sudah mengisi</a>
                                        @endif
                                    </td>
                                    <td style="background-color: #fff !important">{{ $u->jml }} </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#example1").DataTable({
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
                "buttons": ["excel", "pdf", "print"],
                "buttons": [{
                    extend: 'excel',
                    title: 'Data pengisian pernyataan - {{ ucwords(strtolower(Auth::user()->unit)) }}'
                }, {
                    extend: 'pdf',
                    title: 'Data pengisian pernyataan - {{ ucwords(strtolower(Auth::user()->unit)) }}'
                }, {
                    extend: 'print',
                    title: 'Data pengisian pernyataan - {{ ucwords(strtolower(Auth::user()->unit)) }}'
                }],
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>

</x-app-layout>
