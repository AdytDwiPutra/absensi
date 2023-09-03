<?php

namespace App\Http\Controllers;

use App\Models\Logattenmasuk;
use App\Models\MttRegistrationsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;


class exportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bulan)
    {
        dd($bulan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export($type,$bulan){

        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');

        $kalender = CAL_GREGORIAN;
        $bulanx = $this->getBulan((int)$bulan);
        $tahun = date('Y');
        $date = date('d');
        $tanggalx = $date.' '.$bulanx.' '.$tahun;
        $hari = cal_days_in_month($kalender, (int)$bulan, $tahun);
        for($i = 1;$i<=$hari;$i++){
            if($i<10){
            $tanggal[] = $tahun."-".$bulan."-0".$i;

            }else{
            $tanggal[] = $tahun."-".$bulan."-".$i;
            }
        }

        $datefrom = '2022-'.$bulan.'-01';
        $dateto = '2022-'.$bulan.'-'.$hari;

        $data = DB::table('absenmasuk')
        ->join('karyawan','karyawan.id_user','absenmasuk.id_user')
        ->distinct('absenmasuk.id_user')
        ->select('absenmasuk.id_user','karyawan.nama')
        ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
        ->orderBy('karyawan.nama', 'asc')
        ->get();
        // dd($data);
        if(count($data) == 0){
            return redirect()->back() ->with('error', '-Data untuk Kehadiran Bulan '.$bulanx.' Kosong-');
        }else{
            if($type == "pdf"){
                foreach($data as $a){
                    $absenmasuk = DB::table('absenmasuk')->join('karyawan','karyawan.id_user','=','absenmasuk.id_user')
                    ->select('absenmasuk.id_user','karyawan.nama','absenmasuk.tanggal','absenmasuk.waktu')
                    ->where('absenmasuk.id_user', $a->id_user)
                    ->whereBetween('absenmasuk.tanggal', [$datefrom, $dateto])
                    ->get();
        
                    $countHadir = count($absenmasuk);
                    $name = DB::table('karyawan')->select('karyawan.nama')->where('karyawan.id_user', $a->id_user)->first();
                    $hasil[]=['id'=>$a->id_user,'absen'=>$absenmasuk,'count'=>$countHadir,'nama'=>$name->nama];
                        for($i=0;$i<count($tanggal);$i++){
                            $waktumsk = "";
                            $pertgl = strtotime($tanggal[$i]);
                            if($data){
                                $jmlwaktumasuk = count($hasil);
                                if($jmlwaktumasuk != 0){
                                    foreach($hasil as $c){
                                        foreach($c['absen'] as $d){
                                            $perabsnmsk = strtotime($d->tanggal);
                                            if($pertgl == $perabsnmsk){
                                                $waktumsk = "Hadir";
                                            }else{
                                                $waktumsk;
                                            }
                                        }
                                    }
                                }else{
                                    $waktumsk = null;
                                }
                            }else{
                                $waktumsk = null;
                            }
                            if($i < $hari){
                                $absen[] = ["tgl"=> $tanggal[$i] ,"absenmasuk" => $waktumsk];
                            }
                        }
                    $result[] = ["id"=>$a->id_user,"nama"=>$name->nama, "absenmasuk" => $absen,"count"=>$countHadir];
                }
        
        
                $pdf = Pdf::loadView('report.pdf', ['result' => $result,'tanggal'=>$tanggal,'hari'=>$hari,'tgl'=>$tanggalx])->setPaper('f4', 'landscape');
                return $pdf->download('Kehadiran_Bulan_'.$bulanx.'_'.date('d').'-'.date('m').'-'.date('Y').'.pdf');

            }else if($type == "excel"){
                return Excel::download(new reportExcelExport($bulan), 'Report_Monitoring.xlsx');
                // Excel::create('Kehadiran-'.$bulanx.'', function($excel) {
                //     $excel->sheet('Satuan', function($sheet) {
                //         setlocale(LC_TIME, 'id_ID');
                //         \Carbon\Carbon::setLocale('id');
                        
                //         $kalender = CAL_GREGORIAN;
                
                //         // $bulanx = $this->getBulan((int)$bln);
                //         $tahun = date('Y');
                //         $bulan = date('m');
                //         $date = date('d');
                //         $tanggalx = $date.' '.$bulan.' '.$tahun;
                //         $hari = cal_days_in_month($kalender, (int)$bulan, $tahun);
                //         for($i = 1;$i<=$hari;$i++){
                //             if($i<10){
                //             $tanggal[] = $tahun."-".$bulan."-0".$i;
                
                //             }else{
                //             $tanggal[] = $tahun."-".$bulan."-".$i;
                //             }
                //         }
                //         $data = DB::table('absenmasuk')
                //         ->join('karyawan','karyawan.id_user','absenmasuk.id_user')
                //         ->distinct('absenmasuk.id_user')
                //         ->select('absenmasuk.id_user','karyawan.nama')
                //         ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
                //         ->orderBy('karyawan.nama', 'asc')
                //         ->get();
                //         $userHadir2 = [];
                //         foreach ($data as $user){
                //             $tuwagapat = [];
                //             $userHadir1 = [];
                //             foreach($tanggal as $f){
                //                 $tw = Logattenmasuk::select('*')
                //                 ->where('id_user', $user->id_user)
                //                 ->where('tanggal', $f)
                //                 ->first();
                //                 array_push($tuwagapat, $tw);
                //             }
                //             $userHadir1['id']= $user->id_user;
                //             $userHadir1['nama']= $user->nama;
                //             $userHadir1['tanggal']= $tuwagapat;
                //             array_push($userHadir2, $userHadir1);
                //         }
                
                
                                
                //             $dataExcel['id']= $userHadir2[0]['id'];
                //             $dataExcel['nama']= $userHadir2[0]['nama'];

                //             $sheet->loadView('report.excel', $dataExcel);
                //             });
                // })->export('xls');
                // return back();
            }
        }
    }

    function getBulan($bulan){
        date_default_timezone_set("Asia/Bangkok");
        $month = array (
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

        return $month[$bulan];
    }

    
}

class reportExcelExport implements FromView, WithColumnFormatting
{
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

  public function view(): View
  {
    //get all date in one year
    setlocale(LC_TIME, 'id_ID');
    \Carbon\Carbon::setLocale('id');
    
    $kalender = CAL_GREGORIAN;

    $bulan = $this->id;
    $namaBulan = $this->getBulan((int)$this->id);
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
    return view('report.excel', [
    "data" => $data,
    "hari" => $hari,
    "tanggal" => $tanggal,
    "namaBulan" => $namaBulan,
    ]);
  }

  function getBulan($bulan){
    date_default_timezone_set("Asia/Bangkok");
    $month = array (
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

    return $month[$bulan];
}
  
}
