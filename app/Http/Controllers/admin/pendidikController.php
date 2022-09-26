<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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

class pendidikController extends Controller
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
        $data = DB::table('karyawan')
            // ->join('profesi','profesi.id','=','karyawan.id_profesi')
            // ->join('jabatan','jabatan.id','=','karyawan.id_jabatan')
            // ->select('karyawan.*','jabatan.jabatan', 'profesi.profesi')
            ->orderBy('nama', 'ASC')
            ->paginate(15);
        $profesi = profesi::select('*')->get();
        $jabatan = jabatan::select('*')->get();
        // dd($data);
        return view('admin.pendidik', compact('data','profesi','jabatan'));
    }

    public function profile($id){
        $id = $id;
        $data = teacher::where('id_user', $id)->first();
        return view('admin.setting_profile', compact('data'));
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
        // dd($request->all());

        $s = teacher::where('id_user', $request->id)->update([
            'nama' => $request->nama,
            'id_profesi' => $request->profesi,
            'id_jabatan' => $request->jabatan,
        ]);

        if($request->file('profile')){
            $fileIcon = $request->file('profile');
            if(!empty($fileIcon)){
                $ori_name=$fileIcon->getClientOriginalName();
                $ext = pathinfo($ori_name, PATHINFO_EXTENSION);
                $ori_name=explode('.',$ori_name);
                $filename = $ori_name[0] . '_' . $request->id . '.' . $ext;
                $fileIcon->move(
                    public_path('/images/profiles/'),$filename
                );

                $reqdat['id_user'] = $request->id;
                $reqdat['foto_profile'] = $filename;
                FotoProfile::updateOrCreate($reqdat);
            }
        }

        // $s = teacher::where('id_user', $request->id)->first();
        $data = DB::table('karyawan')
            ->orderBy('nama', 'ASC')
            ->paginate(15);
        $profesi = profesi::select('*')->get();
        $jabatan = jabatan::select('*')->get();
        // dd($s);
        $chartPegawai['guru'] = Teacher::where('id_profesi', 1)->count();
        $chartPegawai['staff'] = Teacher::where('id_profesi', 2)->count();

        return view('admin.dashboard', compact('chartPegawai'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = teacher::findorfail($id);
        return $data;
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
        teacher::destroy($id);
        $data = DB::table('karyawan')
            ->orderBy('nama', 'ASC')
            ->paginate(15);
        $profesi = profesi::select('*')->get();
        $jabatan = jabatan::select('*')->get();
        return view('admin.pendidik', compact('data'));
    }

    public function hadir($a){
        setlocale(LC_TIME, 'IND');
        \Carbon\Carbon::setLocale('id');

        $id = (int)$a;
        $kalender = CAL_GREGORIAN;
        $bulan = date('m');
        $tahun = date('Y');
        $hari = cal_days_in_month($kalender, $bulan, $tahun);
        $now = Carbon::now()->isoFormat('MMMM Y');
        for($i = 1;$i<=$hari;$i++){
            if($i<10){
            $tanggal[] = $tahun."-".$bulan."-0".$i;
            }else{
            $tanggal[] = $tahun."-".$bulan."-".$i;
            }
        }
        $data['data'] = teacher::where('id_user',$id)->first();
        $images = FotoProfile::where('id_user', $id)->get();

        $jum = count($images);
        if($jum > 0){
            $last = $jum -1;
            $image = $images[$last]['foto_profile'];
        }else{
            $image = null;
        }

        $data['profile'] = $image;
        $data['absenmasuk'] = Logattenmasuk::where('id_user', $id)
                            ->select('id_user','tanggal','waktu')
                            ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
                            ->get();
        $data['absenkeluar'] = Logattenkeluar::where('id_user', $id)
                            ->select('id_user','tanggal','waktu')
                            ->whereBetween('tanggal', [reset($tanggal), end($tanggal)])
                            ->get();
        $data['bulanini'] = $now;
        $data['tanggal'] = $tanggal;


        foreach($tanggal as $a){
            $waktumsk = "";
            $waktukeluar = "";

            $pertgl = strtotime($a);
            if($data['absenmasuk']){
                $jmlwaktumasuk = count($data['absenmasuk']);
                if($jmlwaktumasuk != 0){
                    foreach($data['absenmasuk'] as $b){
                    $perabsnmsk = strtotime($b->tanggal);
                        if($pertgl == $perabsnmsk){
                            $waktumsk = $b->waktu;
                        }else{
                            $waktumsk;
                        }
                    }
                }else{
                    $waktumsk;
                }
            }else{
                $waktumsk;
            }

            if($data['absenkeluar']){
                $jmlwaktukeluar = count($data['absenkeluar']);
                if($jmlwaktukeluar != 0){
                    foreach($data['absenkeluar'] as $c){
                        $perabsnklr = strtotime($c->tanggal);
                        if($pertgl == $perabsnklr){
                            $waktukeluar = $c->waktu;
                        }else{
                            $waktukeluar;
                        }
                    }
                }else{
                    $waktukeluar;
                }
            }else{
                $waktukeluar;
            }
        $tglabsen = Carbon::parse($a)->isoFormat('dddd, D MMMM Y');
        $data['result'][] = ["tanggal"=> $tglabsen, "absenmasuk" => $waktumsk, "absenkeluar" => $waktukeluar];
        }
        // dd($now);
        if(Auth::user()->group_user == 1){
            return view('admin.show_detail', $data);
        }else{
            return view('admin.informasi', $data);
        }

    }
}
