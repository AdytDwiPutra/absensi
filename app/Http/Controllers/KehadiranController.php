<?php

namespace App\Http\Controllers;

use App\Models\FotoProfile;
use App\Models\Jabatan;
use App\Models\Logattenkeluar;
use App\Models\Logattenmasuk;
use App\Models\Profesi;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

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

        // $data = DB::table('absenmasuk')->join('users','users.id','=','absenmasuk.id_user')
        //         ->select('absenmasuk.*','users.name')
        //         ->where('tanggal', $date)->paginate(10);
        $data = Logattenmasuk::where('tanggal', $date)->paginate(40);
        // $data2 = $data->getNama();
        // dd($data);


        // dd($date);
        return view('admin.kehadiran', compact('data','tgl'));
    }

    public function report_kehadiran(){
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');

        $kalender = CAL_GREGORIAN;
        $bulan = date('m');
        $tahun = date('Y');

        $hari = cal_days_in_month($kalender, $bulan, $tahun);
        for($i = 1;$i<=$hari;$i++){
            if($i<10){
            $tanggal[] = $tahun."-".$bulan."-0".$i;
            }else{
            $tanggal[] = $tahun."-".$bulan."-".$i;
            }
        }
        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"),true);
        $index_array = array_keys($array);
        foreach($index_array as $key){
            for($i = 0;$i<count($tanggal);$i++){
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
        $karyawan = Teacher::all();

        $data['absenmasuk'] = Logattenmasuk::distinct('id_user')
                            ->select('id_user')
                            ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
                            // ->paginate(10);
                            ->get();
        $now = Carbon::now()->format('F');

        $data['bulanini'] = $now;
        $data['tanggal'] = $tanggal;
        $users = DB::table('karyawan')->get();
        // dd($data);
        // $nama = Teacher::Where('id_user', 1)->first();;
        // dd($nama);

        if($cekKehadiran == 0){
            $result = null;
        }else{

            foreach($data['absenmasuk'] as $a){
                $absenmasuk = Logattenmasuk::Where('id_user', $a->id_user)->whereBetween('tanggal', [reset($tanggal), end($tanggal)])->get();
                $name = Teacher::Where('id_user', $a->id_user)->first();
                $countHadir = Logattenmasuk::Where('id_user', $a->id_user)->whereBetween('tanggal', [reset($tanggal), end($tanggal)])->count();
                unset($absen);
                foreach($tanggal as $b){
                    $waktumsk = "";
                    $pertgl = strtotime($b);
                    if($absenmasuk){
                        $jmlwaktumasuk = count($absenmasuk);
                        if($jmlwaktumasuk != 0){
                            foreach($absenmasuk as $c){
                            $perabsnmsk = strtotime($c->tanggal);
                                if($pertgl == $perabsnmsk){
                                    $waktumsk = "Hadir";
                                }else{
                                    $waktumsk;
                                }
                            }
                        }else{
                            $waktumsk = null;
                        }
                    }else{
                        $waktumsk = null;
                    }
                    $absen[] = ["tgl"=> $b ,"absenmasuk" => $waktumsk];
                }

                $result[] = ["id_user"=>$a->id_user,"nama"=>$name->nama, "absenmasuk" => $absen,"count"=>$countHadir];
                // $result[] = ["id_user"=>$a->id_user, "absenmasuk" => $absen,"count"=>$countHadir];
            }

        }
        foreach($users as $a){
            foreach($result as $b){
                if($a->id_user == $b['id_user']){
                    $hasilfix[] = ['nama' => $a->nama, 'kehadiran'=>$b['absenmasuk'], 'count' => $b['count']];
                }else{
                    $hasilfix[] = ['nama' => $a->nama, 'kehadiran'=>null, 'count' => null];
                }
            }
        }
        // $data2= json_encode($result);
        // dd($result);

        return view('admin.report_kehadiran', compact('tanggal','tgl_libur','result','data','hasilfix'));
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
}
