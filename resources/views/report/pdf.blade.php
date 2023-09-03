<html>
    <head>
    </head>
<style>
.tbl td {
    border: 1px solid silver;
}
.tbl img {
display:inline-block;
text-align: center;
max-width: 50%;
height: auto;
}
.tbl tr{
font-size:6vm;
color: #06283D;
padding:10px;
background:white;
font-weight:normal;
border: 1px solid silver; 
height: 20px;
}
 
.tbl th {
font-size:6vm;
color:white;
padding:3px;
background:#30AADD;
font-weight:normal;
border: 1px solid silver; 
border-bottom: 3px solid silver;
height: 50px;
}
.scrollit {
    overflow:scroll;
    height:100px;
}
</style>
<body>
<table style="margin-left:6%;">
    <thead>
        <tr>
            <th style="width: 5%;"><img src="{{asset('assets/images/logosmk.png')}}" alt="" style="width: 250%"></th>
            <th style="width: 80%;"><img src="{{asset('assets/images/alamat.png')}}" alt="" style="width: 70%"></th>
            <th></td>
        </tr>
    </thead>
</table>
<div style="margin-top: -3%">
<table style="margin-left:39%;">
    @php
        $pisahBulan = explode(" ",$tgl);
    @endphp
    <thead>
        <tr>
            <td style="width: 5%;"></td>
            <td style="width: 80%;"><h6 style="text-align: center;"><center>REPORT KEHADIRAN
                BULAN {{strtoupper($pisahBulan[1])}} </center></h6>
            </td>
            <th></td>
        </tr>
    </thead>
</table> 
</div>
<table class="table table-bordered table-striped table-hover js-exportable tbl" id="tableData" style="border-collapse: collapse;padding:3%;margin-top: -3%">
    <thead id="thTable">
        <tr align="center" style="align-items: center">
            <th width=4% rowspan="2"><h5>No</h5></th>
            <th width=50% rowspan="2"><h5>Nama</h5></th>
            <th colspan="{{$hari}}">Tanggal</th>
            <th rowspan="2"><h6>Jumlah Kehadiran</h6></th>
        </tr>
        <tr>
            @for ($i=0;$i<count($tanggal);$i++)
            @php
            $time = strtotime($tanggal[$i]);
            $newformat = date('d',$time);
            @endphp
            <th><h6><centeR>{{ $newformat }}</center></h6></th>
            @endfor
        </tr>
    </thead>
    @php
        $date = now();
        $no=1;
    @endphp
    <tbody class="scrollit" id="bodyTable">
        @foreach ($result as $a)
        @php
             $hadir = 0;
        @endphp
            <tr style="font-size: 15px;">
                <td align="center">{{ $no++ }}</td>
                <td>{{ $a['nama'] }}</td>
                @if($a['absenmasuk'] != null)
                    @for($i=0;$i<count($a['absenmasuk']);$i++)
                        @if($i > ($hari -1))
                            @php
                                break;
                            @endphp
                        @else
                        <td style="padding-top: 1%;"><center>
                            @if($a['absenmasuk'][$i]['absenmasuk'] != "")
                            <span class="badge badge-info m-l-10 hidden-sm-down"><img src="{{asset('assets/images/check-mark.png')}}" alt="" style="width: 80%"></span>
                            @php
                                $hadir += 1;
                            @endphp
                            @else
                            {{-- <span class="badge badge-info m-l-10 hidden-sm-down"><img src="{{asset('assets/images/delete.png')}}" alt="" style="width: 30%"></span> --}}
                            {{-- <span class="badge badge-info m-l-10 hidden-sm-down" style="color:red">-</span> --}}
                            @endif
                            </center>
                        </td>
                        @endif
                    @endfor
                    <td><center>           
                        {{ $hadir }}
                        </center>
                    </td>
                @else
                <td></td>
                <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<div style="position:absolute;right:7%">
    <span>Rancaekek, {{$tgl}}.</span><br><br><br><br><br>
    <span><u>Muhammad Fahmy Hadziqy, S.T, Gr.</u></span>
</div>
</body>
</html>