<x-app-layout>
    <h3 class="ps-3">FORM BIODATA</h3>
    <div class="p-6 bg-white">
        {{-- -----------form--------------------- --}}
        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('pernyataan1') }}">
            @csrf
            <div class="col-md-7 position-relative">
                <label for="name" class="form-label ">Nama Lengkap</label>
                <input type="text" class="form-control bg-white" id="name" value="Andaru Krido Utomo" required readonly>
                <div class="invalid-tooltip">
                    Nama lengkap harus diisi
                </div>
            </div>
            <div class="col-md-5 position-relative">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control bg-white" id="nip" value="198725122012122005" required readonly>
                <div class="invalid-tooltip">
                    NIP harus diisi
                </div>
            </div>

            <div class="col-md-7 position-relative">
                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Alamat email" required>
                <div class="invalid-tooltip">
                    Harus diisi dengan alamat email yang benar. Contoh: nama@website.com
                </div>
            </div>
            <div class="col-md-5 position-relative">
                <label for="nip" class="form-label">Nomor HP / Telpon</label>
                <input type="number" class="form-control bg-white" id="nip" placeholder="Nomor HP / Telpon" required
                    style="-moz-appearance: textfield;">
                <div class="invalid-tooltip">
                    Harus diisi dengan nomor HP yang benar
                </div>
            </div>

            <div class="col-md-7 position-relative">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control bg-white" id="jabatan" placeholder="Jabatan terakhir" required>
                <div class="invalid-tooltip">
                    Harus diisi dengan jabatan yang benar
                </div>
            </div>
            <div class="col-md-5 position-relative">
                <label for="pangkat" class="form-label">Pangkat/golongan</label>
                <select class="form-select" id="pangkat" required>
                    <option selected disabled value="">Pilih golongan...</option>
                    <option>I/a</option>
                    <option>I/b</option>
                    <option>I/c</option>
                    <option>I/d</option>
                    <option>II/a</option>
                    <option>II/b</option>
                    <option>II/c</option>
                    <option>II/d</option>
                    <option>III/a</option>
                    <option>III/b</option>
                    <option>III/c</option>
                    <option>III/d</option>
                    <option>IV/a</option>
                    <option>IV/b</option>
                    <option>IV/c</option>
                    <option>IV/d</option>
                    <option>IV/e</option>
                </select>
                <div class="invalid-tooltip">
                    Pangkat/golongan harus diisi
                </div>
            </div>

            <div class="col-md-12 position-relative">
                <label for="unit" class="form-label">Unit Kerja</label>
                <input class="form-control" list="datalistOptions" id="unit" placeholder="Pilih unit kerja..." required>
                <datalist id="datalistOptions">
                    <option value="Bagian Tata Pemerintahan dan Kerjasama">
                    <option value="Bagian Kesejahteraan Rakyat">
                    <option value="Bagian Hukum">
                    <option value="Bagian Administrasi Perekonomian dan Sumber Daya Alam">
                    <option value="Bagian Administrasi Pembangunan">
                    <option value="Bagian Pengadaan Barang dan Jasa">
                    <option value="Bagian Umum">
                    <option value="Bagian Organisasi">
                    <option value="Bagian Protokol dan Komunikasi Pimpinan">
                    <option value="Bagian Perencanaan dan Keuangan">
                    <option value="Sekretariat Dewan Perwakilan Rakyat Daerah">
                    <option value="Satuan Polisi Pamong Praja">
                    <option value="Inspektorat">
                    <option value="Dinas Pendidikan">
                    <option value="Dinas Kebudayaan, Pariwisata, Pemuda dan Olahraga">
                    <option value="Dinas Kesehatan">
                    <option value="Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak">
                    <option value="Dinas Pengendalian Pendudukan dan Keluarga Berencana">
                    <option value="Dinas Kependudukan dan Pencatatan Sipil">
                </datalist>
                <div class="invalid-tooltip">
                    Unit kerja harus diisi sesuai dengan pilihan yang tersedia
                </div>
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
