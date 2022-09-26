<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absenmasuk;
use App\Models\Jenjang;
use App\Models\Jurusan;
use App\Models\Teacher;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('mapel')
                    ->join('jenjang','jenjang.id','=','mapel.id_jenjang')
                    ->join('jurusan','jurusan.id','=','mapel.id_jurusan')
                    ->select('mapel.id','mapel.nama_mapel','mapel.id_jurusan','mapel.id_jenjang','jenjang.jenjang','jurusan.nama_jurusan')
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->paginate(15);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();
        // dd($data);
        return view('admin.mapel',compact('data','jenjang','jurusan'));
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
        $jurusan = implode(",", $request['jurusan']);
        Mapel::create([
            'nama_mapel' => $request['nama'],
            'id_jenjang' => $request['jenjang'],
            'id_jurusan' => $jurusan,
        ]);
            Absenmasuk::create([
              'sn' => $request['nama'],
            //   'id_user' => (int)$arr[0],
            //   'tanggal' => $date,
            //   'waktu' => $time,
            //   'tipe' => (int)$arr[3],
            //   '4' => (int)$arr[4],
            //   '5' => (int)$arr[5],
            //   '6' => (int)$arr[6],
            ]);

        $data = DB::table('mapel')
                    ->join('jenjang','jenjang.id','=','mapel.id_jenjang')
                    ->join('jurusan','jurusan.id','=','mapel.id_jurusan')
                    ->select('mapel.id','mapel.nama_mapel','mapel.id_jurusan','mapel.id_jenjang','jenjang.jenjang','jurusan.nama_jurusan')
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->paginate(15);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();
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
        Mapel::destroy($id);
        $data = DB::table('mapel')
                    ->join('jenjang','jenjang.id','=','mapel.id_jenjang')
                    ->join('jurusan','jurusan.id','=','mapel.id_jurusan')
                    ->select('mapel.id','mapel.nama_mapel','mapel.id_jurusan','mapel.id_jenjang','jenjang.jenjang','jurusan.nama_jurusan')
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->paginate(15);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();
        return view('admin.mapel', compact('data','jenjang','jurusan'));
    }

    public function test(){
        return view('modal');
    }
}
