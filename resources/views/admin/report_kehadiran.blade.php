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
                    Bulan : {{ $data['bulanini'] }}
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr align="center">
                                    <th >No</th>
                                    <th>Nama</th>
                                    @foreach ($tanggal as $a)
                                    @php
                                    $time = strtotime($a);
                                    $newformat = date('d',$time);
                                    @endphp
                                    <th>{{ $newformat }}</th>
                                    @endforeach
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            @php
                                $date = now();
                                $no=1;
                            @endphp
                            <tbody>
                                @foreach ($result as $a)
                                    <tr>
                                        <td align="center">{{ $no++ }}</td>
                                        <td>{{ $a['nama'] }}</td>
                                        @if ($a['absenmasuk'] != null)
                                            @foreach ($a['absenmasuk'] as $b)
                                                <td><span class="badge badge-info m-l-10 hidden-sm-down">{{ $b['absenmasuk'] }}</span></td>
                                            @endforeach
                                            <td> Hadir :
                                                {{ $a['count'] }}
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
