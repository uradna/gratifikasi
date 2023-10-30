<x-app-layout>
    <h3 class="ps-3">EDIT DATA GRATIFIKASI YANG BELUM DILAPORKAN</h3>
    <div class="p-6 bg-white">
        {{-- -----------form--------------------- --}}
        <form class="row g-3 needs-validation" novalidate method="POST"
            action="{{ route('gratifikasi.update', $gratifikasi->id) }}">
            @csrf
            @method('PATCH')

            <div class="col-md-6 position-relative">
                <label for="jenis" class="form-label">Jenis Gratifikasi</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    @if (old('jenis') == null)
                        <option selected disabled value="">Pilih jenis pemberian</option>
                    @endif

                    @foreach ($jenis as $j)
                        <option @if ($gratifikasi->jenis == $j->jenis) selected @endif value="{{ $j->jenis }}">{{ $j->jenis }}</option>
                    @endforeach
                </select>
                <div class="invalid-tooltip">
                    Jenis gratifikasi harus dipilih sesuai dengan pilihan yang tersedia
                </div>
                @error('jenis')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 position-relative">
                <label for="bentuk" class="form-label">Bentuk Gratifikasi</label>
                <input type="text" class="form-control bg-white" id="bentuk" name="bentuk"
                    value="{{ $gratifikasi->bentuk }}"
                    placeholder="Contoh: Mobil Toyota Innova tahun 2019 hitam. Contoh: Uang Tunai" required>
                <div class="invalid-tooltip">
                    Bentuk gratifikasi harus dipilih, sesuai dengan jenis. Contoh: Jenis > barang,
                    bentuk>mobil. Contoh: Jenis > Uang, bentuk > uang tunai.
                </div>
                @error('bentuk')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-md-6 position-relative">
                <label for="nilai" class="form-label">Perkiraan Nilai Gratifikasi</label>
                <input type="number" class="form-control bg-white" id="nilai" name="nilai"
                    value="{{ $gratifikasi->nilai }}"
                    placeholder="Perkiraan nilai dalam rupiah. Angka tanpa titik/koma" required
                    style="-moz-appearance: textfield;" min="0">
                <div class="invalid-tooltip">
                    Nilai gratifikasi harus diisi, dalam bentuk angka tanpa titik atau koma, contoh: 500000
                </div>
                @error('nilai')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 position-relative" id="datepicker4">
                <label for="waktu" class="form-label">Waktu Gratifikasi</label>
                <input type="date" class="form-control bg-white" id="waktu" name="waktu"
                    value="{{ $gratifikasi->waktu }}" min="2021-07-01" max="2021-12-31" required>
                <div class="invalid-tooltip">
                    Waktu harus diisi
                </div>
                @error('waktu')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 position-relative">
                <label for="unit" class="form-label">Instansi Penerima</label>
                <input class="form-control" list="datalistOptions" id="unit" name="unit"
                    placeholder="Pilih instansi penerima ketika menerima gratifikasi" required
                    value="{{ $gratifikasi->unit }}" autocomplete="off">
                <datalist id="datalistOptions">
                    @foreach ($unit as $u)
                        <option value="{{ $u->unit }}">
                    @endforeach
                </datalist>
                <div class="invalid-tooltip">
                    Instansi harus diisi sesuai dengan pilihan yang tersedia
                </div>
                @error('unit')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 position-relative">
                <label for="jabatan" class="form-label">Jabatan Penerima</label>
                <input class="form-control" id="jabatan" name="jabatan"
                    placeholder="Jabatan penerima ketika menerima gratifikasi" required
                    value="{{ $gratifikasi->jabatan }}">

                <div class="invalid-tooltip">
                    Jabatan harus diisi
                </div>
                @error('jabatan')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 position-relative">
                <label for="nama" class="form-label">Nama Pemberi</label>
                <input type="text" class="form-control bg-white" id="nama" name="nama"
                    placeholder="Nama pemberi gratifikasi" required value="{{ $gratifikasi->nama }}">
                <div class="invalid-tooltip">
                    Nama pemberi gratifikasi harus diisi
                </div>
                @error('nama')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 position-relative">
                <label for="hubungan" class="form-label">Hubungan Dengan Pemberi</label>
                <input type="text" class="form-control bg-white" id="hubungan" name="hubungan"
                    placeholder="Hubungan pemberi dan penerima gratifikasi" required
                    value="{{ $gratifikasi->hubungan }}">
                <div class="invalid-tooltip">
                    Hubungan dengan pemberi gratifikasi harus diisi
                </div>
                @error('hubungan')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 position-relative">
                <label for="alamat" class="form-label">Alamat Pemberi</label>
                <input type="text" class="form-control bg-white" id="alamat" name="alamat"
                    placeholder="Alamat pemberi gratifikasi" required value="{{ $gratifikasi->alamat }}">
                <div class="invalid-tooltip">
                    Alamat pemberi gratifikasi harus diisi
                </div>
                @error('alamat')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 position-relative">
                <label for="alasan" class="form-label">Alasan Pemberian</label>
                <input type="text" class="form-control bg-white" id="alasan" name="alasan"
                    placeholder="Alasan pemberian gratifikasi" required value="{{ $gratifikasi->alasan }}">
                <div class="invalid-tooltip">
                    Alasan pemberian gratifikasi harus diisi
                </div>
                @error('alasan')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-12 position-relative">
                <label for="keterangan" class="form-label">Keterangan Lainnya</label>
                <input type="text" class="form-control bg-white" id="keterangan" name="keterangan"
                    placeholder="Keterangan lainnya" value="{{ $gratifikasi->keterangan }}">
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
