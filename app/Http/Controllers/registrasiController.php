<?php

namespace App\Http\Controllers;

use App\Models\teacher;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registrasiController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
        /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $email = user::where('email', $request->email)->First();
        if($request->email == $email->email){
            return alert('email sudah digunakan');
        }
        if($request['profesi'] == 0){
            $profesi = "";
        }elseif($request['profesi'] == 1){
            $profesi = "Pengajar";
        }elseif($request['profesi'] == 2){
            $profesi = "Staff Kependidikan";
        }
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'group_user' => $request['group_user'],
        ]);
        teacher::create([
            'id_user' =>$user->id,
            'nama_guru' => $user->name,
            'profesi' => $profesi,
            'nohp' => $request['nohp'],
            'alamat' => $request['alamat'],
        ]);

        return view('auth.login');
    }

}
