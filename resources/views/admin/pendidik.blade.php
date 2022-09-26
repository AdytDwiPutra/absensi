@extends('home_admin')
<link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
@section('content')
<!-- Modal Dialogs ========= -->
<!-- Default Size -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Pegawai</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="POST" action="{{ route('pendidik.tambah') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="number" name="id" id="modal-id" hidden>
                                <div class="form-group">
                                    <label><b>Nama</b></label>
                                    <input type="text" name="nama" class="form-control" id="modal-nama" required>
                                </div>
                                <div class="form-group">
                                    <label><b>Gambar Profile</b></label><br>
                                    <input type="file" name="profile" id="file">
                                </div>
                                <div class="form-group" id="div-profesi">
                                    <label for="profesi"><b>Profesi</b></label>
                                    <br/>
                                    <section class="container">
                                    <div class="dropdownwew absolute left-10">
                                        <select name="profesi" class="dropdownwew-select">
                                        <option value="">Select…</option>
                                        @foreach ($profesi as $b)
                                            <option value="{{ $b->id }}">{{ $b->profesi }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    </section>
                                </div>
                                <div class="form-group" id="div-jabatan">
                                    <label for="jabatan"><b>Jabatan</b></label>
                                    <br/>
                                    <section class="container">
                                    <div class="dropdownwew absolute left-10">
                                        <select name="jabatan" class="dropdownwew-select">
                                        <option value="">Select…</option>
                                        @foreach ($jabatan as $b)
                                            <option value="{{ $b->id }}">{{ $b->jabatan }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    </section>
                                </div>
                                <br>
                                <div class="modal-footer text-left">
                                    <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
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
                        <li class="breadcrumb-item">Data Tenaga Pendidik</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
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
                                    <th align="center">No</th>
                                    <th>Nama</th>
                                    <th >Profesi</th>
                                    <th align="center">Jabatan</th>
                                    <th align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $a)
                                    <tr>
                                        <td align="center">{{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td>
                                        <td>{{ $a->nama }}</td>
                                        @if ($a->id_profesi)
                                            @foreach ($profesi as $b)
                                                @if ($a->id_profesi == $b->id)
                                                    <td align="center">{{ $b->profesi }}</td>
                                                @endif
                                            @endforeach
                                        @else
                                        <td align="center">-Belum ada-</td>
                                        @endif
                                        @if ($a->id_jabatan)
                                            @foreach ($jabatan as $b)
                                                @if ($a->id_jabatan == $b->id)
                                                    <td align="center">{{ $b->jabatan }}</td>
                                                @endif
                                            @endforeach
                                        @else
                                        <td align="center">-Belum ada-</td>
                                        @endif
                                        <td align="center">
                                            <button type="button" onclick="modalEdit({{ $a->id }})" class="btn btn-primary" title="Edit"><i class="fa fa-pencil-square-o"></i></button>
                                            <a href="{{ url('pendidik/absen/'.$a->id_user) }}" class="btn btn-info" title="Lihat Absensi"><i class="fa fa-address-book"></i></a>
                                            {{-- <a  href="#defaultModal" class="btn btn-primary" data-toggle="modal" data-target="#defaultModal" title="Tambah Profesi/Jabatan"><i class="fa fa-user-plus"></i></a> --}}
                                            <a href="{{ url('pendidik/delete/'.$a->id) }}" data-type="confirm" class="btn btn-danger js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/dropdown.js') }}"></script>
<script>
    function modalEdit(id){
            $.ajax({
                url: "{{ url('pendidik/show') }}/"+id,
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    $('select[name="profesi"]').val(data.id_profesi);
                    $('select[name="jabatan"]').val(data.id_jabatan);
                    $('#modal-id').val(data.id_user);
                    $('#modal-nama').val(data.nama);
                    $('modal-nama').attr('readonly', true);
                }
            });
        $('#modal-form').modal('show');
    }
</script>
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

