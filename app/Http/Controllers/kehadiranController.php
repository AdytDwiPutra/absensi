<?php

namespace App\Http\Controllers;

use App\Models\FotoProfile;
use App\Models\Jabatan;
use App\Models\Logattenkeluar;
use App\Models\Logattenmasuk;
use App\Models\Profesi;
use App\Models\Teacher;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;
use Maatwebsite\Excel\Facades\Excel;

class kehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        //
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        $now = Carbon::now();
        $date = $now->toDateString();
        $tgl = Carbon::now()->isoFormat('D MMMM Y');

        $data = DB::table('absenmasuk')->join('users','users.id','=','absenmasuk.id_user')
                ->select('absenmasuk.*','users.name')
                ->where('tanggal', $date)->paginate(10);


        // dd($date);
        return view('admin.kehadiran', compact('data','tgl'));
    }

    public function report_kehadiran($no){
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        $kalender = CAL_GREGORIAN;
        $bulan = date('m');
        $tahun = date('Y');
        if($no != "99"){
            $hari = cal_days_in_month($kalender, $no, $tahun);
            $datefrom = '2022-'.$no.'-01';
            $dateto = '2022-'.$no.'-'.$hari;
            for($i = 1;$i<=$hari;$i++){
                if($i<10){
                $tanggal[] = $tahun."-".$no."-0".$i;
    
                }else{
                $tanggal[] = $tahun."-".$no."-".$i;
                }
            }
        }else{

            $hari = cal_days_in_month($kalender, $bulan, $tahun);
            $datefrom = '2022-'.$bulan.'-01';
            $dateto = '2022-'.$bulan.'-'.$hari;
            for($i = 1;$i<=$hari;$i++){
                if($i<10){
                $tanggal[] = $tahun."-".$bulan."-0".$i;
    
                }else{
                $tanggal[] = $tahun."-".$bulan."-".$i;
                }
            }
        }
        // dd($datefrom);
        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/holidays.json"),true);
        $index_array = array_keys($array);
        foreach($index_array as $key){
            $datetime = DateTime::createFromFormat('Ymd', $key);
            // $date2 = new DateTime($datetime);
            for($i = 0;$i<count($tanggal);$i++){
                // dd($datetime['date']);
                // dd(strtotime($tanggal[$i]));

            $tgl = (int)str_replace('-','',$tanggal[$i]);
                if($key == $tgl){
                        $tgl_libur[] = ["tanggal"=>$tanggal[$i] ,"deskripsi"=>$array[$key]["deskripsi"]];
                    }else{
                        $tgl_libur[] = null;
                }
            }
        }
        $cekKehadiran = Logattenmasuk::distinct('id_user')
                            ->select('id_user')
                            ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
                            ->count();
        $userabsen = DB::table('absenmasuk')
                            ->join('karyawan','karyawan.id_user','absenmasuk.id_user')
                            ->distinct('absenmasuk.id_user')
                            ->select('absenmasuk.id_user','karyawan.nama')
                            ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
                            ->orderBy('karyawan.nama', 'asc')
                            ->get();
        $userHadir2 = [];
        foreach ($userabsen as $user){
            $tuwagapat = [];
            $userHadir1 = [];
            foreach($tanggal as $f){
                $tw = Logattenmasuk::select('*')
                ->where('id_user', $user->id_user)
                ->where('tanggal', $f)
                ->first();
                array_push($tuwagapat, $tw);
            }
            $userHadir1['id']= $user->id_user;
            $userHadir1['nama']= $user->nama;
            $userHadir1['tanggal']= $tuwagapat;
            array_push($userHadir2, $userHadir1);
        }
        
        $karyawan = Teacher::select('*')->orderBy('nama', 'asc')->get();
        $now = Carbon::now()->format('F');
        // dd($data['absenmasuk']);
        $data['bulanini'] = $now;
        $data['valBulan'] =  $now = Carbon::now()->format('m');
        $data['tanggal'] = $tanggal;
        $users = DB::table('karyawan')->orderBy('nama', 'asc')->get();
        // if($cekKehadiran == 0){
        //     $result = null;
        // }else{
        //     foreach($data['absenmasuk'] as $a){
        //         $absenmasuk = DB::table('absenmasuk')->join('karyawan','karyawan.id_user','=','absenmasuk.id_user')
        //             ->select('absenmasuk.id_user','karyawan.nama','absenmasuk.tanggal','absenmasuk.waktu')
        //             ->where('absenmasuk.id_user', $a->id_user)
        //             ->whereBetween('absenmasuk.tanggal', [$datefrom, $dateto])
        //             ->get();
        //         $name = DB::table('absenmasuk')->join('karyawan','karyawan.id_user','=','absenmasuk.id_user')
        //             ->select('absenmasuk.id_user','karyawan.nama','absenmasuk.tanggal','absenmasuk.waktu')
        //             ->where('absenmasuk.id_user', $a->id_user)
        //             ->first();
        //         $countHadir = DB::table('absenmasuk')->join('karyawan','karyawan.id_user','=','absenmasuk.id_user')
        //             ->select('absenmasuk.id_user','karyawan.nama','absenmasuk.tanggal','absenmasuk.waktu')
        //             ->where('absenmasuk.id_user', $a->id_user)
        //             ->whereBetween('absenmasuk.tanggal', [$datefrom, $dateto])
        //             ->count();

        //         foreach($tanggal as $b){
        //             $waktumsk = "";
        //             $pertgl = strtotime($b);
        //             if($absenmasuk){
        //                 $jmlwaktumasuk = count($absenmasuk);
        //                 if($jmlwaktumasuk != 0){
        //                     foreach($absenmasuk as $c){
        //                     $perabsnmsk = strtotime($c->tanggal);
        //                         if($pertgl == $perabsnmsk){
        //                             $waktumsk = "Hadir";
        //                         }else{
        //                             $waktumsk;
        //                         }
        //                     }
        //                 }else{
        //                     $waktumsk = null;
        //                 }
        //             }else{
        //                 $waktumsk = null;
        //             }
        //             $absen[] = ["tgl"=> $b ,"absenmasuk" => $waktumsk];
        //         }
        //         if(isset($name->nama)){
        //             $nama = $name->nama;
        //         }else{
        //             $nama = '';
        //         }
        //         $result[] = ["id_user"=>$a->id_user,"nama"=>$nama, "absenmasuk" => $absen,"count"=>$countHadir];
        //         // $result[] = ["id_user"=>$a->id_user, "absenmasuk" => $absen,"count"=>$countHadir];               
        //     }
            

        // }
        // dd($userabsen);
        $namaBulan = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember" 
        );
        // dd($no);
        // for($i=0;$i<count($result);$i){
        //     for($x=0;$x<$hari;$x++){
        //         dd($result[$i]['absenmasuk'][$x]);
        //     }
        // }
        // dd($karyawan);
        if($no == '99'){
            return view('admin.report_kehadiran', compact('karyawan','tanggal','tgl_libur','data','hari','namaBulan','userabsen','bulan'));
            // return view('report.pdf', compact('tanggal','tgl_libur','result','data','hari','namaBulan'));
        }else{
            return response()->json(array(
                'userabsen' => $userHadir2,
                'karyawan' => $karyawan,
                'tanggal' => $tanggal,
                'namaBulan' => $namaBulan,
                'bulan' => $bulan,
                'hari' => $hari
            ));
        }
    }


    public function waktu_tersedia(Request $request){
        $data = DB::table('absenmasuk')->select('tanggal')->get();
        return $data;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function  ()
    // {
    //     $hari_ini = date("Ymd");

    //     echo"<b>Check untuk hari ini (".date("d-m-Y",strtotime($hari_ini)).")</b><br>";
    //     $this->tanggalMerah($hari_ini);
    // }

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
    public function show(Request $request)
    {
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
}
