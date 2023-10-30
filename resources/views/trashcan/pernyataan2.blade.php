<x-app-layout>
    <h3 class="ps-3 text-center">PERNYATAAN II</h3>

    <div class="p-6 bg-white">

        {{-- -----------form--------------------- --}}
        <div class="row g-3">

            <div class="col-lg-3"> </div> <!-- end col-->
            <div class="col-lg-6">
                <div class="card bg-light overflow-hidden border border-5">
                    <div class="card-body">
                        <div class="toll-free-box text-center">
                            <h4 class="lh-lg"> <i class="mdi mdi-headset"></i><span class="text-danger">PERNAHKAH</span>
                                anda menerima
                                gratifikasi dan
                                <span class="text-danger">SUDAH</span> melaporkannya kepada UPG/KPK?
                            </h4>
                        </div>
                    </div> <!-- end card-body-->
                </div>
            </div> <!-- end col-->
            <div class="col-lg-3"> </div> <!-- end col-->

            <div class="col-12" style="text-align: right">
                <form @desktop style="padding-left:250px;" @enddesktop action="{{ route('pernyataan3') }}"
                    method="GET">
                    @csrf
                    <button class="btn btn-danger float-sm-start" type="submit" style="float: left;"> TIDAK
                        <i class="fas fa-times"></i></button>
                </form>

                <form @desktop style="padding-right:250px;" @enddesktop action="{{ route('pernyataan3') }}"
                    method="GET">
                    @csrf
                    <button class="btn btn-success float-sm-end" type="submit">IYA
                        <i class="fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
