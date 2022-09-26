<?php

namespace App\Http\Controllers;

use App\Models\Profesi;
use App\Models\Teacher;
use Illuminate\Http\Request;

class profesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = profesi::select('*')->paginate(10);
        // dd($data);
        return view('admin.profesi', compact('data'));
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
        profesi::create([
            'profesi' => $request['nama']
        ]);
        $data = profesi::select('*')->paginate(10);
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
        dd("masuk");
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
        profesi::destroy($id);
        $data = profesi::select('*')->paginate(10);
        return view('admin.profesi', compact('data'));
    }
}
