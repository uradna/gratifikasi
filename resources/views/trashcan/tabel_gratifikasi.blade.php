<x-app-layout>
    <h3 class="ps-3">TABEL GRATIFIKASI YANG BELUM DILAPORKAN</h3>
    <div class="p-2 pt-0 bg-white">
        {{-- -----------form--------------------- --}}
        <div class="row">
            <div class="col-md-12 mt-2">
                <a href="{{ route('form_gratifikasi') }}" class="btn btn-warning text-left mb-1 float-start">TAMBAH <i
                        class="fas fa-plus"></i></a>
                <a href="{{ route('finalize') }}" class="btn btn-success text-right mb-1 float-end">SELESAI <i
                        class="fas fa-check"></i></a>
            </div>
        </div>
        <div class="table-responsive-sm">

            <table class="table table-sm table-centered mb-0 table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Jenis Pemberian</th>
                        <th>Bentuk Pemberian</th>
                        <th>Waktu Pemberian</th>
                        <th>Nilai Pemberian</th>
                        <th>Nama/alamat Pemberi</th>
                        <th>Hubungan Dengan Pemberi</th>
                        <th>Alasan Pemberian</th>
                        <th>Ket.</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Gratifikasi</td>
                        <td>Uang</td>
                        <td>12 Maret 2020</td>
                        <td>Rp.500.000,00</td>
                        <td>Saimin, Jl. Ukel Ponorogo</td>
                        <td>Rekan Kerja</td>
                        <td>Pengurusan Berkas Kedinasan</td>
                        <td>-</td>
                        <td>
                            <a href="#"><i class="far fa-pen me-2"></i></a>
                            <a href="#" class="link-danger"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Gratifikasi</td>
                        <td>Uang</td>
                        <td>12 Maret 2020</td>
                        <td>Rp.500.000,00</td>
                        <td>Saimin, Jl. Ukel Ponorogo</td>
                        <td>Rekan Kerja</td>
                        <td>Pengurusan Berkas Kedinasan</td>
                        <td>-</td>
                        <td>
                            <a href="#"><i class="far fa-pen me-2"></i></a>
                            <a href="#" class="link-danger"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Gratifikasi</td>
                        <td>Uang</td>
                        <td>12 Maret 2020</td>
                        <td>Rp.500.000,00</td>
                        <td>Saimin, Jl. Ukel Ponorogo</td>
                        <td>Rekan Kerja</td>
                        <td>Pengurusan Berkas Kedinasan</td>
                        <td>-</td>
                        <td>
                            <a href="#"><i class="far fa-pen me-2"></i></a>
                            <a href="#" class="link-danger"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
