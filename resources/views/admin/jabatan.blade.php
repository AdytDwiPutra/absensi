@extends('home_admin')
@section('content')
<!-- Modal Dialogs ========= -->
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Tambah Jabatan</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" class="form-submit" method="POST" action="{{ route('jabatan.tambah') }}" novalidate>
                                @csrf
                                <div class="form-group">
                                    {{-- <label>Nama Profesi</label> --}}
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="bumit" class="btn btn-primary">SAVE CHANGES</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>SMK BAKTI ILHAM</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                        <li class="breadcrumb-item">Jabatan yang tersedia</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="#defaultModal" class="btn btn-primary" data-toggle="modal" data-target="#defaultModal"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Tambah</a>
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
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 c_list">
                            <thead>
                                <tr align="center">
                                    <th >No</th>
                                    <th align="center">Jabatan</th>
                                    <th align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $a)
                                    <tr>
                                        <td align="center">{{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td>
                                        <td>{{ $a->jabatan }}</td>
                                        <td align="center">
                                            <a href="{{ url('jabatan/delete/'.$a->id) }}" data-type="confirm" class="btn btn-danger js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></a>
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
@section('script')
<!-- Javascript -->
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>


<script>
    $(function() {
        // validation needs name of the element
        $('#profesi').multiselect();
        $('#jabatan').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
    });
</script>
@endsection
