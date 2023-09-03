@extends('home_admin')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<style>
    .loading-cart {
	width: 100%;
	height: 100%;
	max-height: 100vh;
	background: rgba(255, 255, 255, 0.95);
	position: fixed;
	top: 0;
	left: 0;
	z-index: 100000;
	clear: both;
	text-align: center;
	overflow: hidden;
}


.loading-cart .csdot {
    width: 8px;
    height: 8px;
    border: 1px solid #288ad6;
    background: #288ad6;
    border-radius: 50%;
    float: left;
    margin: 0 2px;
    -webkit-transform: scale(0);
    transform: scale(0);
    -webkit-animation: fx 1000ms ease infinite 0ms;
    animation: fx 1000ms ease infinite 0ms;
    box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.1);
}


.loading-cart .cswrap {
    position: absolute;
    top: 40%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}


.csdot:nth-child(2) {
    -webkit-animation: fx 1000ms ease infinite 300ms;
    animation: fx 1000ms ease infinite 300ms
}

.csdot:nth-child(3) {
    -webkit-animation: fx 1000ms ease infinite 600ms;
    animation: fx 1000ms ease infinite 600ms
}
tr th {
    white-space: pre-wrap !important;
}
th{
    background-color: #59C4BC;
    color: white;
}
tr td {
    white-space: nowrap;
}
.second-column{
    position: sticky;
    left: 0px;
    width: 140px;
    white-space: nowrap;
}
.second-column.header {
    background-color: red;
}
@-webkit-keyframes fx {
    50% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1
    }
    100% {
        opacity: 0
    }
}

@keyframes fx {
    50% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1
    }
    100% {
        opacity: 0
    }
}

.glas{
    background: rgba( 255, 255, 255, 0.25 );
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 4px );
    -webkit-backdrop-filter: blur( 4px );
    border: 1px solid rgba( 255, 255, 255, 0.18 );
}
@keyframes load {
    0%{
        opacity: 0.08;
/*         font-size: 10px; */
/* 				font-weight: 400; */
				filter: blur(5px);
				letter-spacing: 3px;
        }
    100%{
/*         opacity: 1; */
/*         font-size: 12px; */
/* 				font-weight:600; */
/* 				filter: blur(0); */
        }
}

.animate {
	display:flex;
	justify-content: center;
	align-items: center;
	height:100%;
	margin: auto;
/* 	width: 350px; */
/* 	font-size:26px; */
	font-family: Helvetica, sans-serif, Arial;
	animation: load 1.2s infinite 0s ease-in-out;
	animation-direction: alternate;
	text-shadow: 0 0 1px white;
    color: #288ad6;
    font-size: 8em;
}
.stop-scrolling {
    height: 100%;
    overflow: hidden;
}
</style>
@section('content')
    <div class="loading-cart" style="display:none;opacity:02">
        <span class="cswrap">
            <span class="csdot"></span>
            <span class="csdot"></span>
            <span class="csdot"></span>
        </span>
    </div>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>SMK BAKTI ILHAM</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                        <li class="breadcrumb-item">Report Kehadiran</li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action ml-50">
                        {{-- <a href="#" id="report_data" class="btn"><img src="{{ asset('images/printer.gif') }}" alt="" title="Print" style="width: 35%; height:35%">&nbsp;</a> --}}
                        </div>
                        <div class="p-2 d-flex">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Gagal !</strong> {{ session('error') }}
        </div>
        @endif
        <div class="row clearfix row-deck">
            <div class="card">
                <div class="glas container_loader" style="width:80.5vw;height:700px;top:8%;z-index:100;position: absolute;display:none;">
                    <h2 class="animate">Loading</h2>
                </div>
                
                <div class="header">
                    <div style="margin-bottom: 1%">
                        {{-- <a class="btn btn-primary" id="exportExcel" style="margin-top: 2%" href="{{ url('export/pdf/'.$data['valBulan']) }}">Export Pdf</a>  --}}
                        <a class="btn btn-primary" id="exportExcel" style="margin-top: 2%" href="{{ url('export/excel/'.$data['valBulan']) }}">Export Excel</a> 
                    </div>
                    Bulan : 
                    <div style="width: 20%;margin-top:1%">
                        <select class="browser-default custom-select" id="optionBulan"  onchange="cekHadir()">
                            <option value="{{ $data['valBulan'] }}" id="bulanIni" selected disabled>{{ $data['bulanini'] }}</option>
                            @foreach($namaBulan as $key => $bulan)
                                @php
                                $key = array_search($bulan, $namaBulan);
                                @endphp
                                <option value="{{ $key }}" onclick="cekHadir({{ $bulan }})">{{ $bulan }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableData">
                            <thead >
                                <tr align="center" id="trHeadTable">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2" class="second-column">Nama</th>
                                    <th colspan="{{$hari}}" style="background: #495579;color:white">Tanggal</th>
                                    <th colspan="2">Jumlah Kehadiran</th>
                                </tr>
                                <tr id="thTable">
                                    @foreach ($tanggal as $tgl)
                                    @php
                                    $time = strtotime($tgl);
                                    $newformat = date('d',$time);
                                    @endphp
                                    <th><center>{{ $newformat }}</center></th>
                                    @endforeach
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                                $date = now();
                                $no=1;
                            @endphp
                            <tbody id="bodyTable">
                                @if(count($userabsen) != 0)
                                    @forEach($userabsen as $val)
                                    <tr id="trTable">
                                        @php
                                            $jumhadir=0;
                                        @endphp
                                        <td align="center">{{ $no++ }}</td>
                                        <td class="second-column" style="background-color: aliceblue;">
                                            @isset($val->nama) 
                                                {{$val->nama}} 
                                            @endisset
                                        </td>
                                        @foreach($tanggal as $tgl)
                                            <td>
                                                @php
                                                    $x= cekKehadiran($val->id_user, $tgl);
                                                    $kehadiran = json_decode($x);
                                                @endphp
                                                @if($kehadiran->teks == 'Hadir')
                                                <span class="badge badge-{{$kehadiran->badge}} m-l-10 hidden-sm-down"> {{$kehadiran->teks}} </span>
                                                @php
                                                    $jumhadir++;
                                                @endphp
                                                @else
                                                <span class="badge badge-{{$kehadiran->badge}} m-l-10 hidden-sm-down"> {{$kehadiran->teks}} </span>
                                                @endif
                                                
                                            </td>
                                        @endforeach
                                        <td>
                                            {{$jumhadir}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    @forEach($karyawan as $val)
                                    <tr id="trTable">
                                        @php
                                            $jumhadir=0;
                                        @endphp
                                        <td align="center">{{ $no++ }}</td>
                                        <td class="second-column" style="background-color: aliceblue;">
                                            @isset($val->nama) 
                                                {{$val->nama}} 
                                            @endisset
                                        </td>
                                        @foreach($tanggal as $tgl)
                                        <td></td>
                                        @endforeach
                                        <td>{{$jumhadir}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<!-- Javascript -->
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

<!-- page js file -->
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('js_iconic/pages/tables/jquery-datatable.js') }}"></script>

@endsection
<script>
    function cekHadir(){
        var xbulan = $('#optionBulan').val();
        var token = $('meta[name=csrf-token]').attr('content');
        var urlx = '{{ url("/export/excel")}}/'+xbulan;
        $('#exportExcel').attr("href",urlx);
        var html = '';
        var htmlx = '';
        var nomor = 1;
        $('.container_loader').show();
        disableScroll();
		$.ajax({
			method: 'get',
			url:"{{ url('report_kehadiran') }}/"+xbulan,
			data: {
                _bulan : xbulan,
                _token: token
			},
			success: function(result) {
                var hasil = result.userabsen;
                var hasilNull = result.karyawan;
                var hari = result.hari;
                var bulan = result.bulan;
                var tanggal = result.tanggal;
				$('#bodyTable').remove();
                $('#tableData').append("<tbody id='bodyTable'></tbody>");
                if(hasil.length != 0){
                    hasil.forEach(e => {
                        var hadir = 0;
                        var tgl = e.tanggal;
                        html += `<tr> <td align="center">`+nomor+++`</td><td>`+e.nama+`</td>`;
                            tgl.forEach(x =>{
                                if(x != null){
                                html +=`<td><span class="badge badge-info m-l-10 hidden-sm-down"> Hadir </span></td>`;
                                hadir+=1;
                                }else{
                                    html +=`<td><span class="badge badge-danger m-l-10 hidden-sm-down"> Tidak Hadir </span></td>`;
                                }
                            })             
                            html +=`<td> Hadir :`+hadir+`</td>`;
                        html +=`</tr>`;
                    });
                    $('#bodyTable').append(html);
                }else{
                    hasilNull.forEach(y =>{
                        var hadir = 0;
                        html += `<tr><td align="center">`+nomor+++`</td><td>`+y.nama+`</td>`;
                            tanggal.forEach(z =>{
                                html +=`<td></td>`;
                            })             
                            html +=`<td> Hadir :`+hadir+`</td>`;
                        html +=`</tr>`;
                    });
                    $('#bodyTable').append(html);
                }
			},
			error: function(error){
				console.log(error);
			},
            complete: function (){
                $('.container_loader').hide();
                enableScroll();
            }
		});    
    }
    function disableScroll() {
        document.body.classList.add("stop-scrolling");
    }

    function enableScroll() {
        document.body.classList.remove("stop-scrolling");
    }

</script>