<x-app-layout>
    <h3 class="ps-3">TABEL GRATIFIKASI YANG BELUM DILAPORKAN</h3>
    <div class="p-2 pt-0 bg-white">
        {{-- -----------form--------------------- --}}
        <div class="row">
            <div class="col-md-12 mt-2">
                <form action="{{ route('selesai') }}" method="POST">
                    @csrf
                    <a href="{{ route('gratifikasi.create') }}"
                        class="btn btn-warning text-left mb-1 float-end">TAMBAH
                        <i class="fas fa-plus"></i></a>
                    @if (!$gratifikasi->isEmpty())
                        <button type="submit" class="btn btn-info mb-1 float-start">SELESAI <i
                                class="fas fa-check"></i></button>
                    @endif
                    @if ($gratifikasi->isEmpty())
                        <a href="{{ route('satu') }}" class="btn btn-secondary text-left mb-1 float-start">
                            <i class="fas fa-step-backward"></i> KEMBALI</a>
                    @endif
                </form>
            </div>

        </div>


        <div class="table-responsive-sm">

            <table class="table table-centered table-xsm  mb-0 table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Jenis Gratifikasi</th>
                        <th>Bentuk Gratifikasi</th>
                        <th>Nilai</th>
                        <th>Waktu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Nama Pemberi</th>
                        <th>Alamat</th>
                        <th>Hubungan</th>
                        <th>Alasan Pemberian</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($gratifikasi->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center"><span class="text-danger"><b>Data kosong</b></span>
                                Klik tombol "Tambah +" di kiri atas untuk menambah data.

                            </td>

                        </tr>
                    @endif
                    @if ($gratifikasi->isNotEmpty())
                        @foreach ($gratifikasi as $data)
                            <tr>

                                <td style="font-size: 12px;">{{ $data->jenis }}</td>
                                <td style="font-size: 12px;">{{ $data->bentuk }}</td>
                                <td style="font-size: 12px;">Rp.{{ number_format($data->nilai, 0, ',', '.') }}</td>
                                <td style="font-size: 12px;">
                                    {{ \Carbon\Carbon::parse($data->waktu)->format('d-M-Y') }}</td>

                                <td style="font-size: 12px;">{{ $data->nama }}</td>
                                <td style="font-size: 12px;">{{ $data->alamat }}</td>
                                <td style="font-size: 12px;">{{ $data->hubungan }}</td>
                                <td style="font-size: 12px;">{{ $data->alasan }}</td>
                                <td>
                                    <a href="{{ route('gratifikasi.edit', $data->id) }}"><i
                                            class="far fa-edit"></i></a>
                                    {{-- <a href="#" class="link-info"><i class="far fa-edit"></i></a> --}}
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#" class="link-danger" data-bs-toggle="modal"
                                        data-bs-target="#danger{{ $data->id }}">
                                        <i class="far fa-trash-alt"></i></a>

                                    <div id="danger{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content modal-filled bg-danger">
                                                <div class="modal-body p-2">
                                                    <div class="text-center">
                                                        <i class="fa-solid fa-trash-can h1"></i>
                                                        <h4 class="mt-1">Hapus data gratifikasi?</h4>


                                                        <form method="POST"
                                                            action="{{ route('gratifikasi.destroy', $data->id) }}"
                                                            class="">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-light my-2 me-2"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button class="btn btn-light my-2 ms-2"
                                                                type="submit">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


        </div>
        <div class="row mt-2 mx-1">
            <div class="col-lg-4"></div>
            <div class="alert alert-warning mb-3 text-danger col-lg-4 text-center"> <i
                    class="fas fa-exclamation-triangle f-18"></i><br>
                Karena anda "PERNAH menerima gratifikasi" dan "BELUM PERNAH melaporkannya pada
                UPG/KPK", anda
                harus mengisi daftar gratifikasi yang pernah anda terima. <br>
                <b>Anda dapat melaporkan gratifikasi langsung kepada KPK di
                    <a target="_blank" href="http://gol.kpk.go.id">
                        Aplikasi SIG KPK <sup><i class="far fa-external-link font-10"></i></sup></a></b>
            </div>
        </div>
    </div>

    {{-- alert success create --}}
    @if (Session::has('message'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#success-alert-modal').modal('show');
            });

        </script>
    @endif
    {{-- alert success create --}}
    <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body p-1">
                    <div class="text-center">
                        <i class="fa-solid fa-badge-check h2 text-success"></i>
                        <h4 class="mt-2">Berhasil!</h4>
                        <p class="mt-3 mb-2">{!! session('message') !!}</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</x-app-layout>
