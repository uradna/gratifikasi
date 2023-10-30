<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GratifikasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis = ['Uang','Barang','Rabat','Komisi','Pinjaman Tanpa Bunga','Tiket Perjalanan','Fasilitas Penginapan','Perjalanan Wisata','Pengobatan Cuma-cuma','Fasilitas','Lain-lain'];
        $bentuk = ['Uang tunai','Sepeda gunung','Mobil','Alat elektronik','Tiket pesawat','Menginap di Bali','Saham','Perhiasan emas'];
        $alasan = ['Mengabsenkan','Membantu mengurus surat','Menang tender','Hadiah pernikahan','Parsel Hari Raya'];
        $hubungan = ['Teman','Rekan kerja','Orang lain','Rekanan kerja','Kenalan'];
        $unit = ['Sekretariat Daerah','Sekretariat Dewan Perwakilan Rakyat Daerah','Satuan Polisi Pamong Praja','Inspektorat','Dinas Pendidikan','Dinas Kebudayaan, Pariwisata, Pemuda dan Olahraga','Dinas Kesehatan','Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak','Dinas Pengendalian Pendudukan dan Keluarga Berencana','Dinas Kependudukan dan Pencatatan Sipil','Dinas Pemberdayaan Masyarakat dan Desa','Dinas Penanaman  Modal dan Pelayanan Terpadu Satu Pintu','Dinas Perdagangan, Koperasi dan Usaha Mikro','Dinas Tenaga Kerja','Dinas Komunikasi, Informatika dan Statistik','Dinas Pekerjaan Umum, Perumahan dan Kawasan Permukiman','Dinas Perhubungan','Dinas Pertanian, Ketahanan Pangan dan Perikanan','Dinas Lingkungan Hidup ','Dinas Perpustakaan Dan Kearsipan','Dinas Pendapatan dan Pengelolaan Keuangan dan Asset Daerah','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia','Badan Kesatuan Bangsa dan Politik','Badan Penanggulangan Bencana Daerah','Badan Perencaan Daerah, Penelitian dan Pengembangan','RSUD DR. Harjono, S','Kecamatan Ponorogo','Kecamatan Babadan','Kecamatan Kauman','Kecamatan Sampung','Kecamatan Sukorejo','Kecamatan Badegan','Kecamatan Siman','Kecamatan Jenangan','Kecamatan Ngebel','Kecamatan Sooko','Kecamatan Pudak','Kecamatan Sawoo','Kecamatan Jetis','Kecamatan Balong','Kecamatan Pulung','Kecamatan Sambit','Kecamatan Mlarak','Kecamatan Ngrayun','Kecamatan Slahung','Kecamatan Bungkal','Kecamatan Jambon'];
        $jabatan = ['Pranata Hubungan Masyarakat','Pranata Informasi Diplomatik','Pranata Keuangan APBN','Pranata Komputer','Pranata Laboratorium Kemetrologian','Pranata Laboratorium Kesehatan','Pranata Laboratorium Pendidikan','Pranata Nuklir','Pranata Peradilan','Pranata Siaran','Pranata Sumber Daya Manusia Aparatur','Penyuluh Lingkungan Hidup','Penyuluh Narkoba','Penyuluh Pajak','Penyuluh Perikanan','Penyuluh Perindustrian dan Perdagangan','Penyuluh Pertanian','Penyuluh Sosial','Perancang Peraturan Perundang-undangan','Perawat','Perawat Gigi','Perekam Medis','Perekayasa','Perencana','Perisalah Legislatif','Polisi Kehutanan','Polisi Pamong Praja'];
        $dt = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = '-1 months');
        $nilai = $this->faker->numberBetween($min = 5, $max = 150) * 10000;
        $date = $dt->format("Y-m-d");
        //----------------------------------------------------------
        return [
            'user_id' => '0',
            'jenis' => $this->faker->randomElement($jenis),
            'bentuk' => $this->faker->randomElement($bentuk),
            'nilai' => $nilai,
            'waktu' => $date,
            'nama' => $this->faker->name(),
            'hubungan' => $this->faker->randomElement($hubungan),
            'alamat' => $this->faker->address,
            'alasan' => $this->faker->randomElement($alasan),
            'unit' => $this->faker->randomElement($unit),
            'jabatan' => $this->faker->randomElement($jabatan),
            'keterangan' => $this->faker->text($maxNbChars = 200)
        ];
    }
}
