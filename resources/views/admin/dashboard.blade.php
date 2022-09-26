@extends('home_admin')
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>SMK BAKTI ILHAM</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                            <li class="breadcrumb-item">Dashboard</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            {{-- <div class="page_action">
                                <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download report</button>
                                <button type="button" class="btn btn-secondary"><i class="fa fa-send"></i> Send report</button>
                            </div> --}}
                            <div class="p-2 d-flex">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix row-deck">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pegawai SMK Bakti Ilham</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="Use-by-Pegawai" style="height: 16rem"></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Use by Browser</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                      <th>Browser</th>
                                      <th>Sessions</th>
                                      <th>Bounce rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chrome</td>
                                        <td>23,233 <i class="fa fa-level-up"></i></td>
                                        <td>47.12%</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox</td>
                                        <td>13,901 <i class="fa fa-level-up"></i></td>
                                        <td>33.02%</td>
                                    </tr>
                                    <tr>
                                        <td>Safari</td>
                                        <td>3,015 <i class="fa fa-level-up"></i></td>
                                        <td>24.12%</td>
                                    </tr>
                                    <tr>
                                        <td>Edge</td>
                                        <td>233 <i class="fa fa-level-down"></i></td>
                                        <td>17.33%</td>
                                    </tr>
                                    <tr>
                                        <td>Opera</td>
                                        <td>821 <i class="fa fa-level-down"></i></td>
                                        <td>7.12%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
        $(document).ready(function(){
        var chart = c3.generate({
            bindto: '#Use-by-Pegawai', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', 10],
                    ['data2', 4],
                ],
                type: 'donut', // default type of chart
                colors: {
                    'data1': Iconic.colors["theme-cyan1"],
                    'data2': Iconic.colors["theme-cyan2"],
                },
                names: {
                    // name of each serie
                    'data1': 'Guru',
                    'data2': 'Staff Tata Usaha',
                }
            },
            axis: {
            },
            legend: {
                show: true, //hide legend
            },
            padding: {
                bottom: 0,
                top: 0
            },
        });
    });

</script>