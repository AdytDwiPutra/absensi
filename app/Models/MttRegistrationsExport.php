<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MttRegistrationsExport extends Model
{
    use HasFactory;
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

/**
* @return \Illuminate\Support\Collection
*/
    public function columnFormats(): array
    {
        return [
        //   'D' => NumberFormat::FORMAT_DATE_TIME2,
        ];
    }
    public function headings():array{
        return[
            'Id',
            'Name'
        ];
    } 
        public function collection()
    {
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        
        $kalender = CAL_GREGORIAN;

        $bulan = $this->getBulan((int)$this->id);
        $tahun = date('Y');
        $hari = cal_days_in_month($kalender, (int)$bulan, $tahun);
        for($i = 1;$i<=$hari;$i++){
            if($i<10){
            $tanggal[] = $tahun."-".$bulan."-0".$i;

            }else{
            $tanggal[] = $tahun."-".$bulan."-".$i;
            }
        }

        $data = DB::table('absenmasuk')
        ->join('karyawan','karyawan.id_user','absenmasuk.id_user')
        ->distinct('absenmasuk.id_user')
        ->select('absenmasuk.id_user','karyawan.nama')
        ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
        ->orderBy('karyawan.nama', 'asc')
        ->get();

        return $data([
            'absenmasuk.id_user',
            'karyawan.nama',
         ]);
    }
}
