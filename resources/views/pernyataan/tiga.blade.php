<x-app-layout>
    <h3 class="ps-3 text-center">PERNYATAAN III</h3>
    <div class="p-6 bg-white">
        <div class="row g-3">
            <div class="col-lg-3"> </div> <!-- end col-->
            <div class="col-lg-6">
                <div class="card bg-light overflow-hidden border border-5">
                    <div class="card-body">
                        <div class="toll-free-box text-center ">
                            <h4 class="lh-lg"> <i class="mdi mdi-headset"></i><span class="text-danger">PERNAHKAH</span>
                                anda menerima
                                gratifikasi dan
                                <span class="text-danger">BELUM</span> melaporkannya kepada UPG/KPK?
                            </h4><br>Periode 1 Januari s/d 30 Juni 2022
                        </div>
                    </div> <!-- end card-body-->
                </div>
            </div> <!-- end col-->
            <div class="col-lg-3"> </div>
            {{--  --}}
            <div class="col-lg-3"> </div>
            <div class="col-lg-6" style="text-align: right">
                @if (!(Auth::user()->status_1 == 1 && Auth::user()->status_2 == 0))
                    <form action="{{ route('tiga_tidak') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger float-sm-start" type="submit" style="float: left;"> TIDAK
                            <i class="fas fa-times"></i></button>
                    </form>
                @endif

                <form action="{{ route('tiga_ya') }}" method="POST">
                    @csrf
                    <button class="btn btn-success float-sm-end" type="submit">IYA
                        <i class="fas fa-check"></i></button>
                </form>

            </div>
            <div class="col-lg-3"></div>

            <div class="col-lg-3"> </div>
            <div class="col-lg-6" style="text-align: right">
                <a href="{{ route('dua') }}" class="btn-sm btn-secondary text-left mb-1 float-start font-12">
                    <i class="fas fa-step-backward"></i> KEMBALI</a>

            </div>
            <div class="col-lg-3"> </div>
            @if (Auth::user()->status_1 == 1 && Auth::user()->status_2 == 0)
                <div class="col-lg-3"></div>
                <div class="alert alert-warning mb-3 text-danger col-lg-6 text-center"> <i
                        class="fas fa-exclamation-triangle f-18"></i><br>
                    Karena anda memilih "PERNAH menerima gratifikasi" dan "BELUM PERNAH melaporkan kepada UPG/KPK",
                    anda
                    harus memilih "YA" pada pernyataan ketiga dan
                    harus mengisi daftar gratifikasi yang diterima.<br>

                </div>
                <div class="col-lg-3"></div>
            @endif
        </div>
    </div>
</x-app-layout>
