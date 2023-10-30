<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="https://bkpsdm.ponorogo.go.id/wp-content/uploads/2017/07/cropped-logokab-32x32.png"
        sizes="32x32" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">

    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/duotone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/regular.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/light.css') }}" rel="stylesheet">


</head>

<body class="font-sans antialiased">
    <main>
        <div>
            <div class="text-center mb-4 mt-3">
                <h4><u>SURAT PERNYATAAN GRATIFIKASI</u></h4>
            </div>
            <div id="biodata">
                Yang bertanda tangan di bawah ini:<br><br>
                <table class="table table-xxsm ms-3 table-borderless">
                    <tr>
                        <td class="col-md-2">Nama</td>
                        <td>:</td>
                        <td class="col-md-12">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>
                            @if ($user->unit == 'PEJABAT NON-PNS')
                                -
                            @else
                                {{ $user->nip }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Pangkat</td>
                        <td>:</td>
                        <td>{{ $user->pangkat }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{ $user->jabatan }}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>:</td>
                        <td>{{ $user->unit }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Email</td>
                        <td>:</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Nomor HP</td>
                        <td>:</td>
                        <td>{{ $user->hp }}</td>
                    </tr>
                </table>
            </div>
            <div id="pernyataan">
                Menyatakan bahwa pada periode 1 Januari s/d 30 Juni 2022, saya:
                <table class="table table-sm ms-3 table-borderless mt-1">
                    <tr class="">
                        <td style="width: 10px;"><b>
                                @if ($user->status_1 == 1)
                                    <i class="far fa-square"></i>
                                @endif
                                @if ($user->status_1 == 0)
                                    <i class="fas fa-check-square"></i>
                                @endif
                            </b></td>
                        <td><b>TIDAK PERNAH Menerima Gratifikasi</b></td>
                    </tr>
                    <tr>
                        <td><b>
                                @if ($user->status_2 == 0)
                                    <i class="far fa-square"></i>
                                @endif
                                @if ($user->status_2 == 1)
                                    <i class="fas fa-check-square"></i>
                                @endif
                            </b></td>
                        <td><b>MENERIMA Gratifikasi dan TELAH Melaporkannya Kepada UPG/KPK</b></td>
                    </tr>
                    <tr>
                        <td><b>
                                @if ($user->status_3 == 0)
                                    <i class="far fa-square"></i>
                                @endif
                                @if ($user->status_3 == 1)
                                    <i class="fas fa-check-square"></i>
                                @endif
                            </b></td>
                        <td><b>MENERIMA Gratifikasi Namun BELUM Melaporkannya Kepada UPG/KPK</b></td>
                    </tr>
                </table>
            </div>
            @if ($user->status_1 == 1 && $user->status_3 == 1)
                <div id="gratifikasi">
                    Rincian penerimaan gratifikasi yang belum dilaporkan ke UPG/KPK<br>
                    <table class="table table-ssm table-bordered border-dark mt-2">
                        <tr class="font-13">
                            <th class="align-top">Jenis Gratifikasi</th>
                            <th class="align-top">Bentuk Gratifikasi</th>
                            <th class="align-top">Nilai</th>
                            <th class="align-top ">
                                Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>
                            <th class="align-top">Nama Pemberi</th>
                            <th class="align-top">Alamat</th>
                            <th class="align-top">Hubungan</th>
                            <th class="align-top">Alasan Pemberian</th>
                        </tr>
                        @if ($gratifikasi->isNotEmpty())
                            @foreach ($gratifikasi as $data)
                                <tr class="font-13">
                                    <td>{{ $data->jenis }}</td>
                                    <td>{{ $data->bentuk }}</td>
                                    <td>
                                        Rp.{{ number_format($data->nilai, 0, ',', '.') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($data->waktu)->format('d-M-Y') }}
                                    </td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->hubungan }}</td>
                                    <td>{{ $data->alasan }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            @endif
            Demikian Surat Pernyataan ini saya buat dengan sebenar-benarnya, apabila dikemudian hari ada penerimaan
            gratifikasi yang sengaja tidak saya laporkan atau dilaporkan tidak benar maka saya bersedia
            mempertanggungjawabkan secara hukum sesuai dengan peraturan perundang-undangan yang berlaku.<br><br>
            <table class="table table-borderless">
                <tr>
                    <td class="w-60"></td>
                    <td class="text-center">
                        Ponorogo, {{ \Carbon\Carbon::parse($user->tanggal)->format('d') }}
                        @switch(\Carbon\Carbon::parse($user->tanggal)->format('n'))
                            @case(1)
                                Januari
                            @break
                            @case(2)
                                Februari
                            @break
                            @case(3)
                                Maret
                            @break
                            @case(4)
                                April
                            @break
                            @case(5)
                                Mei
                            @break
                            @case(6)
                                Juni
                            @break
                            @case(7)
                                Juli
                            @break
                            @case(8)
                                Agustus
                            @break
                            @case(9)
                                September
                            @break
                            @case(10)
                                Oktober
                            @break
                            @case(11)
                                November
                            @break
                            @case(12)
                                Desember
                            @break
                        @endswitch
                        {{ \Carbon\Carbon::parse($user->tanggal)->format('Y') }}<br>
                        Yang membuat Pernyataan<br><br>TTD.<br><br>
                        <u>{{ $user->name }}</u>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>
