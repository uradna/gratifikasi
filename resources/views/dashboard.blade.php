<x-app-layout>
    @if ($user->finish == 0)
        <h3 class="ps-3">KONFIRMASI DATA</h3>
    @else
        <h3 class="ps-3">DATA PERNYATAAN GRATIFIKASI - SELESAI</h3>
    @endif

    <div class="p-6 bg-white pt-0 ">
        @if ($user->finish == 1)
            <div class="text-end">


                <a class="btn btn-primary" onclick="window.frames['pact'].print();"><i class="far fa-print"></i>
                    Print</a>
                <iframe name="pact" src="{{ route('print') }}" width="0" height="0" frameborder="0"></iframe>




            </div>
        @endif
        {{-- -----------form--------------------- --}}
        <div class="row g-3">
            {{-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX --}}

            <ul class="nav nav-tabs nav-justified nav-bordered mb-1">
                <li class="nav-item">
                    <a href="#biodata" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        @mobile Biodata @endmobile
                        @desktop <span class="d-none d-md-block font-18">Biodata</span>
                        @enddesktop
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#pernyataan" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                        @mobile Pernyataan @endmobile
                        @desktop <span class="d-none d-md-block font-18">Pernyataan</span>
                        @enddesktop
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#gratifikasi" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        @mobile Gratifikasi @endmobile
                        @desktop <span class="d-none d-md-block font-18">Data Gratifikasi</span>
                        @enddesktop
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show active" id="biodata">
                    <table class="table table-sm table-hover  mb-0 mt-0">
                        <tr>
                            <td class="col-md-2">Nama</td>
                            <td>:</td>
                            <td class="col-md-12">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>
                                @if ($user->unit == 'PEJABAT NON-PNS')
                                    -
                                @else
                                    {{ $user->nip }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Pangkat</td>
                            <td>:</td>
                            <td>{{ $user->pangkat }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $user->jabatan }}</td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td>{{ $user->unit }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Email</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td>:</td>
                            <td>{{ $user->hp }}</td>
                        </tr>
                    </table>
                    @if ($user->finish == 0)
                        <a href="{{ route('biodata.show', $user->id) }}" class="btn btn-warning mt-1">
                            Edit <i class="fas fa-pen font-13 ms-1"></i>
                        </a>
                    @endif
                </div>
                <div class="tab-pane" id="pernyataan">
                    <table class="table table-hover table-sm mb-0">
                        <tr class="">
                            <td style="width: 10px;"><b>
                                    @if ($user->status_1 == 1)
                                        <i class="far fa-square"></i>
                                    @endif
                                    @if ($user->status_1 == 0)
                                        <i class="fas fa-check-square"></i>
                                    @endif
                                </b></td>
                            <td><b>TIDAK PERNAH Menerima Gratifikasi</b></td>
                        </tr>
                        <tr>
                            <td><b>
                                    @if ($user->status_2 == 0)
                                        <i class="far fa-square"></i>
                                    @endif
                                    @if ($user->status_2 == 1)
                                        <i class="fas fa-check-square"></i>
                                    @endif
                                </b></td>
                            <td><b>MENERIMA Gratifikasi dan TELAH Melaporkannya Kepada UPG/KPK</b></td>
                        </tr>
                        <tr>
                            <td><b>
                                    @if ($user->status_3 == 0)
                                        <i class="far fa-square"></i>
                                    @endif
                                    @if ($user->status_3 == 1)
                                        <i class="fas fa-check-square"></i>
                                    @endif
                                </b></td>
                            <td><b>MENERIMA Gratifikasi Namun BELUM Melaporkannya Kepada UPG/KPK</b></td>
                        </tr>
                    </table>
                    @if ($user->finish == 0)
                        <a href="{{ route('satu') }}" class="btn btn-warning mt-1">
                            Edit <i class="fas fa-pen font-13 ms-1"></i>
                        </a>
                    @endif
                </div>
                <div class="tab-pane" id="gratifikasi" style="margin-left:-12px;margin-right:-12px;">

                    <div class="table-responsive-sm mx-0">

                        <table class="table table-centered table-xsm  mb-0 table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Jenis Gratifikasi</th>
                                    <th>Bentuk Gratifikasi</th>
                                    <th>Nilai</th>
                                    <th>Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    <th>Nama Pemberi</th>
                                    <th>Alamat</th>
                                    <th>Hubungan</th>
                                    <th>Alasan Pemberian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($gratifikasi->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center"><span class="text-danger"><b>Data
                                                    kosong</b></span>

                                        </td>

                                    </tr>
                                @endif
                                @if ($gratifikasi->isNotEmpty())
                                    @foreach ($gratifikasi as $data)
                                        <tr class="font-13">

                                            <td>{{ $data->jenis }}</td>
                                            <td>{{ $data->bentuk }}</td>
                                            <td>
                                                Rp.{{ number_format($data->nilai, 0, ',', '.') }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($data->waktu)->format('d-M-Y') }}</td>

                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->hubungan }}</td>
                                            <td>{{ $data->alasan }}</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($user->finish == 0)
                        @if ($user->status_3 == 1)
                            <a href="{{ route('gratifikasi.index') }}" class="btn btn-warning mt-1">
                                Edit <i class="fas fa-pen font-13 ms-1"></i>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            {{-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX --}}


            @if ($user->finish == 0)
                <hr class="m-1" style="color:#ced4da">

                <div class="col-md-12 position-relative">

                    <div class="col-md-12 mb-1">


                        Demikian Pernyataan ini saya buat dengan sebenar-benarnya, apabila
                        dikemudian
                        hari ada penerimaan
                        gratifikasi yang sengaja tidak saya laporkan atau dilaporkan tidak benar maka saya
                        bersedia
                        mempertanggungjawabkan secara hukum sesuai dengan peraturan perundang-undangan yang
                        berlaku.


                    </div>
                    {{-- <div class="invalid-tooltip">
                            Harus menyetujui sebelum menyimpan dan mengakhiri pengisian
                        </div>
                        <label for="bentuk" class="form-label">Dengan mencentang kotak disamping, saya menyatakan
                            bahwa
                            data
                            yang saya masukkan adalah data yang benar.</label> --}}

                </div>

                <div class="col-12 mt-2" data-bs-toggle="modal" data-bs-target="#info-alert-modal">
                    <button class="btn btn-primary" type="submit">SIMPAN dan AKHIRI
                </div>

            @endif
            @if ($user->finish == 1)
                <div class="position-relative px-1">
                    <div class="col-md-12">Demikian Pernyataan ini saya buat dengan sebenar-benarnya, apabila
                        dikemudian
                        hari ada penerimaan
                        gratifikasi yang sengaja tidak saya laporkan atau dilaporkan tidak benar maka saya bersedia
                        mempertanggungjawabkan secara hukum sesuai dengan peraturan perundang-undangan yang berlaku.
                    </div>


                </div>
            @endif
        </div>

        {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
        {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}


        {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
        {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

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

    </div>

    <div id="dangerx" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-warning">
                    <h4 class="modal-title" id="warning-header-modalLabel">Perhatian</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <b>Ada gratifikasi yang dilaporkan.<br><br>
                        Anda dapat melaporkan gratifikasi secara langsung kepada KPK di
                        <a target="_blank" href="http://gol.kpk.go.id">
                            Aplikasi SIG KPK <sup><i class="far fa-external-link font-10"></i></sup></a></b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @if ($user->status_3 == 1 && $user->finish == 0)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#dangerx').modal('show');
            });

        </script>
    @endif

    {{-- MODAL SIMPAN --}}
    <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="warning-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-warning">
                    <h4 class="modal-title" id="warning-header-modalLabel">Perhatian</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Anda akan menyimpan dan mengakhiri pernyataan gratifikasi.<br>
                        Setelah diakhiri, data tidak dapat diubah. Pastikan data yang anda masukkan sudah benar.<br><br>
                        Apakah anda yakin?</p>
                    <form novalidate method="POST" action="{{ route('done') }}">
                        @csrf
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">TIDAK <i
                                class="fas fa-times"></i></button>
                        <button type="submit" class="btn btn-success float-end" data-bs-dismiss="modal">YA <i
                                class="fas fa-check"></i></button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-2">
                    <div class="text-center">
                        <i class="fa-solid fa-triangle-exclamation h1 text-warning"></i>
                        <h4 class="mt-2">Perhatian!</h4>
                        <p class="mt-3">
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</x-app-layout>
