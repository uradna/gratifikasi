<x-app-layout>
    <h3 class="ps-3">FORM BIODATA</h3>
    <div class="p-6 bg-white">
        {{-- -----------form--------------------- --}}
        <form class="row g-3 needs-validation" novalidate method="POST"
            action="{{ route('biodata.update', $user->id) }}">
            @csrf
            @method('PATCH')
            <div class="col-md-7 position-relative">
                <label for="nama" class="form-label ">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" value="{{ $user->name }}" readonly disabled>
                <div class="invalid-tooltip">
                    Nama lengkap harus diisi
                </div>
            </div>
            <div class="col-md-5 position-relative">
                <label for="nomer" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nomer" value="@if ($user->unit ==
                'PEJABAT NON-PNS') -
                @else{{ $user->nip }} @endif" readonly disabled>
                <div class="invalid-tooltip">
                    NIP harus diisi
                </div>
            </div>

            <div class="col-md-7 position-relative">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    placeholder="Alamat email" value="@if (old('email') !=null) {{ old('email') }} @else {{ $user->email }} @endif" required>
                <div class="invalid-tooltip">
                    Alamat email harus diisi dengan email yang benar. Contoh: nama@gmail.net
                </div>
                @error('email')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-5 position-relative">
                <label for="hp" class="form-label">Nomor HP / WA</label>
                <input type="number" class="form-control bg-white" id="hp" name="hp" placeholder="Nomor HP / WA"
                    required style="-moz-appearance: textfield;" value="@if (old('hp') !=null) {{ old('hp') }}@else{{ $user->hp }} @endif">
                <div class="invalid-tooltip">
                    Nomor HP harus diisi
                </div>
                @error('hp')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-7 position-relative">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control bg-white" id="jabatan" name="jabatan"
                    placeholder="Jabatan terakhir" required value="@if (old('jabatan') !=null) {{ old('jabatan') }}@else{{ $user->jabatan }} @endif">
                <div class="invalid-tooltip">
                    Jabatan harus diisi
                </div>
                @error('jabatan')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-5 position-relative">
                <label for="pangkat" class="form-label">Pangkat/golongan</label>
                <select class="form-select" id="pangkat" name="pangkat" required>

                    @if ($user->pangkat == null)
                        <option selected disabled value="">Pilih golongan terakhir</option>
                    @endif
                    @foreach ($pangkat as $p)
                        <option value="{{ $p->pangkat }}" @if ($user->pangkat == $p->pangkat) selected @endif>{{ $p->pangkat }}</option>
                    @endforeach
                </select>
                <div class="invalid-tooltip">
                    Pangkat/golongan harus diisi
                </div>
                @error('pangkat')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-7 position-relative">
                <label for="unit" class="form-label">Instansi/SKPD</label>
                <input class="form-control" list="datalistOptions" id="unit" name="unit" placeholder="Pilih instansi"
                    required value="@if (old('unit') !=null) {{ old('unit') }}@else{{ $user->unit }} @endif" autocomplete="off">
                <datalist id="datalistOptions">
                    @foreach ($unit as $u)
                        <option value="{{ $u->unit }}">
                    @endforeach
                </datalist>
                <div class="invalid-tooltip">
                    Unit kerja harus diisi sesuai dengan pilihan yang tersedia
                </div>
                @error('unit')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-5 position-relative">
                <label for="tempat" class="form-label">Unit Kerja</label>
                <input class="form-control" id="tempat" name="tempat"
                    placeholder="Masukkan penempatan, contoh: SDN Somoroto 1, contoh: Puskesmas Balong"
                    value="@if (old('tempat') !=null) {{ old('tempat') }}@else{{ $user->tempat }} @endif">
                @error('tempat')
                    <div class="validation-error">
                        {{ $message }}
                    </div>
                @enderror
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
