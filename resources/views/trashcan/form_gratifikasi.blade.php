<x-app-layout>
    <h3 class="ps-3">GRATIFIKASI YANG BELUM DILAPORKAN</h3>
    <div class="p-6 bg-white">
        {{-- -----------form--------------------- --}}
        <form class="row g-3 needs-validation" novalidate method="GET" action="{{ route('tabel_gratifikasi') }}">
            @csrf
            <div class="col-md-12 position-relative">
                <label for="jenis" class="form-label">Jenis Pemberian</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    <option selected disabled value="">Pilih jenis pemberian...</option>
                    <option>Uang</option>
                    <option>Barang</option>
                    <option>Rabat</option>
                    <option>Komisi</option>
                    <option>Pinjaman Tanpa Bunga</option>
                    <option>Tiket Perjalanan</option>
                    <option>Fasilitas Penginapan</option>
                    <option>Perjalanan Wisata</option>
                    <option>Pengobatan Cuma-cuma</option>
                    <option>Fasilitas</option>
                </select>
                <div class="invalid-tooltip">
                    Jenis pemberian harus dipilih
                </div>
            </div>
            <div class="col-md-12 position-relative">
                <label for="bentuk" class="form-label">Bentuk Pemberian</label>
                <input type="text" class="form-control bg-white" id="bentuk" name="bentuk"
                    placeholder="Contoh: Mobil Toyota Innova tahun 2019 hitam" required>
                <div class="invalid-tooltip">
                    Bentuk pemberian harus dipilih, sesuai dengan jenis pemberian. Contoh: Jenis > barang, bentuk>mobil
                    xxx
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="nilai" class="form-label">Perkiraan Nilai Pemberian</label>
                <input type="number" class="form-control bg-white" id="nilai" name="nilai"
                    placeholder="Perkiraan nilai dalam rupiah..." required style="-moz-appearance: textfield;">
                <div class="invalid-tooltip">
                    Nilai pemberian harus diisi, dalam bentuk angka tanpa titik atau koma
                </div>
            </div>

            <div class="col-md-6 position-relative" id="datepicker4">
                <label for="waktu" class="form-label">Waktu Pemberian</label>
                <input type="text" class="form-control bg-white" data-provide="datepicker" data-date-autoclose="true"
                    data-date-container="#datepicker4" data-date-format="d-M-yyyy" id="waktu" name="waktu">
                <div class="invalid-tooltip">
                    Waktu harus dipilih
                </div>
            </div>

            <div class="col-md-6 position-relative">
                <label for="nama" class="form-label">Nama Pemberi Gratifikasi</label>
                <input type="text" class="form-control bg-white" id="nama" name="nama"
                    placeholder="Nama pemberi gratifikasi..." required>
                <div class="invalid-tooltip">
                    Nama pemberi gratifikasi harus diisi
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="hubungan" class="form-label">Hubungan Dengan Pemberi</label>
                <input type="text" class="form-control bg-white" id="hubungan" name="hubungan"
                    placeholder="Hubungan pemberi dan penerima gratifikasi..." required>
                <div class="invalid-tooltip">
                    Hubungan dengan pemberi harus diisi
                </div>
            </div>
            <div class="col-md-12 position-relative">
                <label for="alamat" class="form-label">Alamat Pemberi Gratifikasi</label>
                <input type="text" class="form-control bg-white" id="alamat" name="alamat"
                    placeholder="Alamat pemberi gratifikasi..." required>
                <div class="invalid-tooltip">
                    Alamat pemberi harus diisi
                </div>
            </div>
            <div class="col-md-12 position-relative">
                <label for="alasan" class="form-label">Alasan Pemberian</label>
                <input type="text" class="form-control bg-white" id="alasan" name="alasan"
                    placeholder="Alasan pemberian gratifikasi..." required>
                <div class="invalid-tooltip">
                    Alasan pemberian harus diisi
                </div>
            </div>

            <div class="col-md-12 position-relative">
                <label for="ket" class="form-label">Keterangan Lainnya</label>
                <input type="text" class="form-control bg-white" id="ket" name="ket"
                    placeholder="Keterangan lainnya...">
            </div>

            <div class="col-12" style="text-align: right">
                <button class="btn btn-primary float-sm-end" type="submit">SIMPAN
                    <i class="fas fa-caret-right"></i></button>
            </div>
        </form>

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
