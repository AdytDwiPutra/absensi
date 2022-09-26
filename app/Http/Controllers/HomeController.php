<?php

namespace App\Http\Controllers;

use App\Models\FotoProfile;
use App\Models\Jabatan;
use App\Models\Profesi;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *s
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group_user = Auth::user()->group_user;
        $id_user = Auth::user()->id;
        $data = teacher::where('id_user', $id_user)->first();
        if($group_user == 1){
            $chartPegawai['guru'] = teacher::where('id_profesi', 1)->count();
            $chartPegawai['staff'] = teacher::where('id_profesi', 2)->count();
            return view('admin.dashboard', $chartPegawai);
        }else{

            if($data != null){
                $profesi = profesi::where('id', $data->id_profesi)->first();
                $jabatan = jabatan::where('id', $data->id_jabatan)->first();
                $images = FotoProfile::where('id_user', $id_user)->get();
                $jum = count($images);
                $last = $jum -1;
                $image = $images[$last]['foto_profile'];

            }else{
                $profesi = null;
                $jabatan = null;
                $image = null;
            }
            return view('home_client',compact('data','image','profesi','jabatan'));
        }
    }
}
