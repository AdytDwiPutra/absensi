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
                            <h2>Waktu Yang Tersedia</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="post" novalidate>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">SAVE CHANGES</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
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
                        <li class="breadcrumb-item">Data Kehadiran</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="#" id="waktu_tersedia" class="btn btn-primary disabled"><i class="fa fa-calendar" aria-hidden="true" disabled='disabled'></i>&nbsp;Pilih Tanggal</a>
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
                   Tanggal : {{ $tgl }}
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 c_list">
                            <thead>
                                <tr align="center">
                                    <th >No</th>
                                    <th>Nama</th>
                                    <th>Waktu Masuk</th>
                                    {{-- <th align="center">Keluar</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $a)
                                    <tr>
                                        <td align="center">{{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td>
                                        <td>{{ $a->getNama->nama }}</td>
                                        <td align="center">{{ $a->waktu }}</td>
                                        {{-- <td align="center">{{ $a->profesi }}</td> --}}
                                        <td align="center">
                                            <a href="{{ url('pendidik/show/'.$a->id) }}" class="btn btn-info" title="Lihat"><i class="fa fa-id-badge"></i></a>
                                            <a href="#" data-type="confirm" class="btn btn-danger js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></a>
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

    $('#waktu_tesedia').click(function(){
        $('#defaultModal').modal('show');
                        console.log("masuk");

        $.ajax({
            url: "{{ route('kehadiran.waktu_tersedia') }}",
            type: "post",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                console.log(data);
            },
        });
    });
</script>
@endsection
