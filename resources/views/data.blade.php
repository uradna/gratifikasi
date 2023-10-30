<x-app-layout>
    <h3 class="ps-3">KONFIRMASI DATA</h3>
    <div class="p-6 bg-white">

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
                            <td>Sugeng Hendra Atmojoyoyoyo</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>197212122002102006</td>
                        </tr>
                        <tr>
                            <td>Pangkat</td>
                            <td>:</td>
                            <td>VI/a </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>Kepala Bidang Pengembangan SDM </td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td>Dinas Pengendalian Pendudukan dan Keluarga Berencana </td>
                        </tr>
                        <tr>
                            <td>Alamat Email</td>
                            <td>:</td>
                            <td>soegeng@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td>:</td>
                            <td>081552336554</td>
                        </tr>
                    </table>
                    <a href="#" class="btn btn-warning mt-1">
                        Edit <i class="fas fa-pen font-13 ms-1"></i>
                    </a>
                </div>
                <div class="tab-pane" id="pernyataan">
                    <table class="table table-hover table-sm mb-0">
                        <tr class="">
                            <td style="width: 10px;"><b><i class="far fa-square"></i></b></td>
                            <td><b>TIDAK Menerima Gratifikasi</b></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-check-square"></i></b></td>
                            <td><b>MENERIMA Gratifikasi dan TELAH Melaporkannya Kepada UPG/KPK</b></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-check-square"></i></b></td>
                            <td><b>MENERIMA Namun BELUM Melaporkannya Kepada UPG/KPK</b></td>
                        </tr>
                    </table>
                    <a href="#" class="btn btn-warning mt-1">
                        Edit <i class="fas fa-pen font-13 ms-1"></i>
                    </a>
                </div>
                <div class="tab-pane" id="gratifikasi">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-centered table-bordered mb-0">
                            <thead class="table-secondary ">
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
                                </tr>
                                <tr class="text-center fs-6">
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="#" class="btn btn-warning mt-1">
                        Edit <i class="fas fa-pen font-13 ms-1"></i>
                    </a>
                </div>
            </div>
            {{-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX --}}

            <hr>
            <form class="row needs-validation mb-2 mt-1" novalidate>
                @csrf
                <div class="col-md-12 position-relative">
                    <input type="checkbox" class="form-check-input" id="customCheck11" required>
                    <div class="invalid-tooltip">
                        Harus menyetujui sebelum menyimpan dan mengahiri pengisian
                    </div>
                    <label for="bentuk" class="form-label">Dengan mencentang kotak disamping, saya menyatakan bahwa data
                        yang saya masukkan adalah data yang benar.</label>

                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">SIMPAN dan AKHIRI
                </div>
            </form>



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
</x-app-layout>
