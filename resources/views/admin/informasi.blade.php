@extends('admin.client_show')
@section('content')
<div class="modal fade mt-10" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header mb-2 mt-2">
                            @php
                                $bulan = explode(" ",$bulanini);
                            @endphp
                            <h2>Kehadiran Bulan : {{ $bulan[0] }}</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="table-responsive" style="height: 350px;overflow: auto;display: inline-block;width: 100%;">
                                    <table class="table table-hover mb-0 c_list">
                                        <thead>
                                            <tr align="center">
                                                <th width="2%">No</th>
                                                <th width="10%">Tanggal</th>
                                                <th width="4%">Waktu Masuk</th>
                                                <th width="4%">Waktu Keluar</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no =1;
                                        @endphp
                                        <tbody>
                                            @foreach ($result as $a)
                                                <tr align="center">
                                                    <td align="center">{{ $no++ }}</td>
                                                    <td>{{ $a['tanggal'] }}</td>
                                                    <td>
                                                        @if($a['absenmasuk'] != null)
                                                            <img src="{{ asset('images/user.gif') }}" title="Hadir" style="width: 30%; height: 40%;">
                                                        @endif
                                                        <span style="color:aqua">{{ $a['absenmasuk'] }}</span>
                                                    </td>
                                                    <td>
                                                        @if($a['absenkeluar'] != null)
                                                            <img src="{{ asset('images/arrows.gif') }}" title="Keluar" style="width: 30%; height: 40%;">
                                                        @endif
                                                        <span style="color:red">{{ $a['absenkeluar'] }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
  <div class="six columns">
    <div class="ios7-icon">
      <ul class="hashtag">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
      <ul class="others">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
      <ul class="circles">
        <li></li>
        <li><img src="{{ asset('images/smk.png') }}" alt="" class="mt-3 opacity-50"></li>
        <li></li>
      </ul>
    </div>

    <div class="profile-text">
      {{-- <span>Informasi Kehadiran</span>
      <br> --}}
    <button onclick="openModal()" class="outline outline-2  outline-offset-2 bg-cyan-600 mb-3 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded" style="font-size: 1rem">
        Informasi Kehadiran
    </button>
    <br>
    <button onclick="window.history.go(-1); return false;" class="outline outline-2  outline-offset-2 bg-red-500 mb-1 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" style="font-size: 1rem">
        Kembali
    </button>
    </div>

  </div>
</div>

@endsection
