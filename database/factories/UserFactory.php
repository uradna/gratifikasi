<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unit = ['Sekretariat Daerah','Sekretariat Dewan Perwakilan Rakyat Daerah','Satuan Polisi Pamong Praja','Inspektorat','Dinas Pendidikan','Dinas Kebudayaan, Pariwisata, Pemuda dan Olahraga','Dinas Kesehatan','Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak','Dinas Pengendalian Pendudukan dan Keluarga Berencana','Dinas Kependudukan dan Pencatatan Sipil','Dinas Pemberdayaan Masyarakat dan Desa','Dinas Penanaman  Modal dan Pelayanan Terpadu Satu Pintu','Dinas Perdagangan, Koperasi dan Usaha Mikro','Dinas Tenaga Kerja','Dinas Komunikasi, Informatika dan Statistik','Dinas Pekerjaan Umum, Perumahan dan Kawasan Permukiman','Dinas Perhubungan','Dinas Pertanian, Ketahanan Pangan dan Perikanan','Dinas Lingkungan Hidup ','Dinas Perpustakaan Dan Kearsipan','Dinas Pendapatan dan Pengelolaan Keuangan dan Asset Daerah','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia','Badan Kesatuan Bangsa dan Politik','Badan Penanggulangan Bencana Daerah','Badan Perencaan Daerah, Penelitian dan Pengembangan','RSUD DR. Harjono, S','Kecamatan Ponorogo','Kecamatan Babadan','Kecamatan Kauman','Kecamatan Sampung','Kecamatan Sukorejo','Kecamatan Badegan','Kecamatan Siman','Kecamatan Jenangan','Kecamatan Ngebel','Kecamatan Sooko','Kecamatan Pudak','Kecamatan Sawoo','Kecamatan Jetis','Kecamatan Balong','Kecamatan Pulung','Kecamatan Sambit','Kecamatan Mlarak','Kecamatan Ngrayun','Kecamatan Slahung','Kecamatan Bungkal','Kecamatan Jambon'];
        $jabatan = ['Pranata Hubungan Masyarakat','Pranata Informasi Diplomatik','Pranata Keuangan APBN','Pranata Komputer','Pranata Laboratorium Kemetrologian','Pranata Laboratorium Kesehatan','Pranata Laboratorium Pendidikan','Pranata Nuklir','Pranata Peradilan','Pranata Siaran','Pranata Sumber Daya Manusia Aparatur','Penyuluh Lingkungan Hidup','Penyuluh Narkoba','Penyuluh Pajak','Penyuluh Perikanan','Penyuluh Perindustrian dan Perdagangan','Penyuluh Pertanian','Penyuluh Sosial','Perancang Peraturan Perundang-undangan','Perawat','Perawat Gigi','Perekam Medis','Perekayasa','Perencana','Perisalah Legislatif','Polisi Kehutanan','Polisi Pamong Praja'];
        $dt = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = '-1 months');
        $date = $dt->format("Y-m-d");
        return [
            'name' => $this->faker->name(),
            'nip' => $this->faker->year().$this->faker->month().$this->faker->dayOfMonth().$this->faker->year().$this->faker->month().$this->faker->numberBetween($min = 1, $max = 2).'00'.$this->faker->numberBetween($min = 1, $max = 9),
            'email' => $this->faker->unique()->safeEmail(),
            'hp' => $this->faker->numerify('08##########'),
            'password' => 'ed42c6cc7ba2b69f3e18d5581eaa5ecf', // password
            'pangkat' => $this->faker->randomElement(['I/A','I/B','I/C','I/D','II/A','II/B','II/C','II/D','III/A','III/B','III/C','III/D','IV/A','IV/B','IV/C','IV/D','IV/E']),
            'jabatan' => $this->faker->randomElement($jabatan),
            'unit' => $this->faker->randomElement($unit),
            'tempat' => null,
            'status_1' => '0',
            'status_2' => '0',
            'status_3' => '0',
            'status_laporan' => '0',
            'finish' => '0',
            'tanggal' => $date,
            'admin' => '0',
            'remember_token' => Str::random(15),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
