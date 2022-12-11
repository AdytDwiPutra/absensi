@extends('home_admin')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

@section('content')
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

        <div class="row clearfix row-deck">
            <div class="card">
                <div class="header">
                    Bulan : 
                    <div style="width: 20%;margin-top:1%">
                        <select class="browser-default custom-select" id="optionBulan"  onchange="cekHadir()">
                            <option selected disabled>{{ $data['bulanini'] }}</option>
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
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tableData">
                            <thead id="thTable">
                                <tr align="center" id="trHeadTable">
                                    <th >No</th>
                                    <th>Nama</th>
                                    @for ($i=0;$i<count($tanggal);$i++)
                                    @php
                                    $time = strtotime($tanggal[$i]);
                                    $newformat = date('d',$time);
                                    @endphp
                                    <th>{{ $newformat }}</th>
                                    @endfor
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            @php
                                $date = now();
                                $no=1;
                            @endphp
                            <tbody id="bodyTable">
                                @foreach ($result as $a)
                                @php
                                     $hadir = 0;
                                @endphp
                                    <tr>
                                        <td align="center">{{ $no++ }}</td>
                                        <td>{{ $a['nama'] }}</td>
                                        @if($a['absenmasuk'] != null)
                                            @for($i=0;$i<count($a['absenmasuk']);$i++)
                                                @if($i > ($hari -1))
                                                    @php
                                                        break;
                                                    @endphp
                                                @else
                                                <td>
                                                    @if($a['absenmasuk'][$i]['absenmasuk'] != "")
                                                    <span class="badge badge-info m-l-10 hidden-sm-down"> Hadir </span>
                                                    @php
                                                        $hadir += 1;
                                                    @endphp
                                                    @endif
                                                </td>
                                                @endif
                                            @endfor
                                            <td> Hadir :
                                                {{ $hadir }}
                                            </td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                    </tr>
                                @endforeach
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
    $(document).ready(function(){
        var url = '{{ url("kehadiran/export_kehadiran") }}'
        $('.buttons-csv').attr("href", url);
    })
    function cekHadir(){
        var xbulan = $('#optionBulan').val();
        var token = $('meta[name=csrf-token]').attr('content');
        var html = '';
        var htmlx = '';
        var nomor = 1;
		$.ajax({
			method: 'get',
			url:"{{ url('report_kehadiran') }}/"+xbulan,
			data: {
                _bulan : xbulan,
                _token: token
			},
			success: function(result) {
                var hasil = result.result;
                var hari = result.hari;
                console.log(hari);
                var namaBulan = result.namaBulan;
				$('#bodyTable').remove();
                $('#tableData').append("<tbody id='bodyTable'></tbody>");
                hasil.forEach(element => {
                    var absenmasuk = element['absenmasuk'];
                    var hadir = 0;
                    html += `<tr><td align="center">`+nomor+++`</td><td>`+element['nama']+`</td>`;               
                    if(element['absenmasuk'] != null){
                        for(var i=0;i<absenmasuk.length;i++){
                            console.log("masuk");
                            if(i > (hari - 1)){
                                break;
                            }else{
                                if(absenmasuk[i]['absenmasuk'] != ""){
                                    html +=`<td><span class="badge badge-info m-l-10 hidden-sm-down"> Hadir </span></td>`;
                                    hadir+=1;
                                }else{
                                    html +=`<td><span class="badge badge-info m-l-10 hidden-sm-down"></span></td>`;
                                }
                            }
                        }
                        html +=`<td> Hadir :`+hadir+`</td>`;
                    }else{
                        html +=` <td></td>
                        <td></td>`;
                    }

                    html +=`</tr>`;
                });
                $('#trHeadTable').remove();
                htmlx += `<tr align="center" id="trHeadTable"><th >No</th><th>Nama</th>`;
                for(var i=1;i<=hari;i++){
                    htmlx +=`<th>`+i+`</th>`;
                }
                htmlx +=`<th>Keterangan</th></tr>`;
                $('#thTable').append(htmlx);
                $('#bodyTable').append(html);
			},
			error: function(error){
				console.log(error);
			}
		});    
    }
</script>