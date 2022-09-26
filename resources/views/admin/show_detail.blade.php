@extends('home_admin')
@section('content')

<div id="wrapper" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ asset('images/smk.png') }}" width="48" height="48" alt="Iconic"></div>
            <p>Please wait...</p>
        </div>
    </div>



    <!-- mani page content body part -->
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>User Profile</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                            <li class="breadcrumb-item">{{ $data->nama }}</li>
                            @if (isset($profesi->profesi))
                                <li class="breadcrumb-item active">{{ $profesi->profesi }}</li>
                            @else
                                <li class="breadcrumb-item active"></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                                {{-- <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download report</button>
                                <button type="button" class="btn btn-secondary"><i class="fa fa-send"></i> Send report</button> --}}
                            </div>
                            <div class="p-2 d-flex">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Profile">Informasi</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            <div class="tab-pane active" id="Profile">

                                <div class="body">
                                    <h6>Profile Photo</h6>
                                    <div class="media">
                                        <div class="media-left m-r-15">
                                            @if(isset($profile))
                                                <img class="img-responsive" src="{{ asset('images/profiles/'.$profile) }}" style="width: 15%; height:15%">
                                            @else
                                                <img class="img-responsive" src="{{ asset('images/enjoy1.png') }}">
                                            @endif
                                        </div>
                                        {{-- <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <div class="media-body">
                                                <p>Upload your photo.
                                                    <br> <em>Image should be at least 140px x 140px</em></p>
                                                <button type="button" class="btn btn-default" id="btn-upload-photo">Upload Photo</button>
                                                <input type="file" id="filePhoto" class="sr-only">
                                            </div>
                                        </form> --}}
                                    </div>
                                </div>

                                <div class="body">
                                    @php
                                        $bulan = explode(" ",$bulanini);
                                    @endphp
\                                    <h6>Informasi Absen Bulan : {{ $bulan[0] }}</h6>
                                    <div class="row clearfix">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option value="">-- Pilih Bulan --</option>
                                                    <option value="jan">Januari</option>
                                                    <option value="feb">Februari</option>
                                                    <option value="mar">Maret</option>
                                                    <option value="apr">April</option>
                                                    <option value="mei">Mei</option>
                                                    <option value="jun">Juni</option>
                                                    <option value="jul">Juli</option>
                                                    <option value="agu">Agustus</option>
                                                    <option value="sep">September</option>
                                                    <option value="okt">Oktober</option>
                                                    <option value="nov">November</option>
                                                    <option value="des">Desember</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0 c_list">
                                                        <thead>
                                                            <tr align="center">
                                                                <th width="2%">No</th>
                                                                <th width="4%">Tanggal</th>
                                                                <th width="10%">Waktu Masuk</th>
                                                                <th width="10%">Waktu Keluar</th>
                                                            </tr>
                                                        </thead>
                                                        @php
                                                            $no =1;
                                                            // $array_search = array_search($absenmasuk[1],$tanggal,true);
                                                        @endphp
                                                        <tbody>
                                                            @foreach ($result as $a)
                                                                <tr align="center">
                                                                    <td align="center">{{ $no++ }}</td>
                                                                    <td>{{ $a['tanggal'] }}</td>
                                                                    <td>
                                                                        @if($a['absenmasuk'] != null)
                                                                            <img src="{{ asset('images/user.gif') }}" title="Hadir" style="width: 14%; height: 14%;">
                                                                        @endif
                                                                        {{ $a['absenmasuk'] }}
                                                                    </td>
                                                                    <td>
                                                                        {{-- @if($a['absenmasuk'] != null)
                                                                            <img src="{{ asset('images/out.png') }}" title="Keluar" style="width: 6%; height: 6%;">
                                                                        @endif                         --}}
                                                                        {{ $a['absenkeluar'] }}
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
            </div>
        </div>

</div>

@endsection
