<?php

use App\Models\dinasluar;
use App\Models\Logattenmasuk;
use App\Models\teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

if (! function_exists('getTanggalIndo')) {
    function getTanggalIndo($tgl){
        date_default_timezone_set("Asia/Jakarta");
        $bulan = array (
           1 => 'Januari',
           2 => 'Februari',
           3 => 'Maret',
           4 => 'April',
           5 => 'Mei',
           6 => 'Juni',
           7 => 'Juli',
           8 =>'Agustus',
           9 =>'September',
           10 =>'Oktober',
           11 =>'November',
           12 =>'Desember'
        );
        $tanggal =  explode(' ', $tgl)[0];
        if($tanggal){
          $pecahkan = explode('-', $tanggal);
        }else{
          $pecahkan = explode('-', $tgl);
        }

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}

if (! function_exists('cekKehadiran')) {
    function cekKehadiran($id , $tgl){
        $data = Logattenmasuk::select('*')
        ->where('id_user', $id)
        ->where('tanggal', $tgl)
        ->get();
        if(count($data) != 0){
            $x['teks'] = 'Hadir';
            $x['badge'] = 'info';
        }else{
            $x['teks'] = 'Tidak Hadir';
            $x['badge'] = 'danger';
        }
        return json_encode($x);
    }
}

if (! function_exists('cekKaryawan')) {
    function cekKaryawan($id){
        $data = teacher::find($id);

        return $data;
    }
}

if (! function_exists('cekHariLibur')) {
    function cekHariLibur($tgl){
        $cekHariLibur = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/holidays.json"),true);
        $libur = $cekHariLibur[$tgl];
        return $libur;
    }
}