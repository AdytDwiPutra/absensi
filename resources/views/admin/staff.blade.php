@extends('home_admin')
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>SMK BAKTI ILHAM</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                            <li class="breadcrumb-item">Data Tenaga Pendidik</li>
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
                <div class="card">
                    <div class="header">
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Profesi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $a)
                                        <tr>
                                            <td>{{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td>
                                            <td>{{ $a->nama }}</td>
                                            <td>{{ $a->jabatan }}</td>
                                            <td>{{ $a->profesi }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button type="button" data-type="confirm" class="btn btn-danger js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {!! $data->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
@endsection
