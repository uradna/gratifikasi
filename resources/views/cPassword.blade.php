<x-app-layout>
    <div class="">
        <div class="modal-dialog modal-dialog-centered shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ms-3">UBAH PASSWORD</h4>
                </div>
                <div class="modal-body ">
                    <form method="POST" action="{{ route('changecred') }}" class="ps-3 pe-3">
                        @csrf
                        <div class="mb-2 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" required="" id="password"
                                placeholder="Masukkan password" name="password">
                            @error('password')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-2 position-relative">
                            <label for="password1" class="form-label">Password baru</label>
                            <input class="form-control" type="password" required="" id="password1"
                                placeholder="Masukkan password baru" name="password1">
                            @error('password1')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password2" class="form-label">Ulangi password baru</label>
                            <input class="form-control" type="password" required="" id="password2"
                                placeholder="Ulangi password baru" name="password2">
                            @error('password2')
                                <div class="validation-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-2 mt-2 text-end">
                            <button class="btn rounded btn-secondary" type="submit">Simpan <i
                                    class="fas fa-caret-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
