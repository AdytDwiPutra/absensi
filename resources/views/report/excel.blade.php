<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        td {
            padding: 3px;
            font-size: 8pt;
        }
        tr {
            height: -30px;
        }
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
    </style>
</head>

<body style="margin: -20px; max-height: 100%;">
    <table style="font-weight: bold;margin-left:5%">
        <tr style="text-align: center;">
            <td colspan="{{$hari + 3}}" align="center">SMK BAKTI ILHAM</td>
        </tr>
        {{-- <tr style="text-align: center;">
            <td style="border-bottom: 1px solid black;">SEKOLAH STAF DAN KOMANDO</td>
        </tr> --}}
    </table>
    <table style="width: 100%; margin-top: -25px; font-weight: bold;font-size: 1em;">
        <tr style="text-align: center;">
            <td colspan="{{$hari + 3}}" align="center">REPORT KEHADIRAN {{strtoupper($namaBulan)}}</td>
        </tr>
        <tr style="text-align: center;">
            <td></td>
        </tr>
    </table>
    <table style="width: 90%; border-collapse: collapse;font-size: 0.5em; margin-left:5%;" border="1" cellspacing="0">
      <thead>
        <tr style="text-align: center;">
            <th rowspan="2" style="background: #495579;color:white">No</th>
            <th rowspan="2" width="300%" class="second-column" style="background: #495579;color:white">Nama</th>
            <th colspan="{{$hari}}" style="background: #495579;color:white" align="center">Tanggal</th>
            <th rowspan="2" width="200%" style="background: #495579;color:white" align="center">Jumlah Kehadiran</th>
        </tr>
        <tr id="thTable">
            @foreach ($tanggal as $tgl)
            @php
            $time = strtotime($tgl);
            $newformat = date('d',$time);
            @endphp
            <th width="50%" style="background: #495579;color:white"><center>{{ $newformat }}</center></th>
            @endforeach
        </tr>
      </thead>
        @php
            $date = now();
            $no=1;
        @endphp
      <tbody id="tbody_hdr">
        @forEach($data as $val)
        <tr>
            @php
                $jumhadir=0;
            @endphp
            <td align="center">{{ $no++ }}</td>
            <td class="second-column">
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
                    1
                    @php
                        $jumhadir++;
                    @endphp
                    @else
                    
                    @endif
                    
                </td>
            @endforeach
            <td align="center">
                {{$jumhadir}}
            </td>
        </tr>
        @endforeach

      </tbody>
    </table>
    <br><br>

    <div class="row">
      <div style="float: left;width: 30%;margin-left:60%">
        <table style="text-align: center; float: right;">
            <tr>
                @for($i=0;$i<($hari);$i++)
                <td></td>
                @endfor
                <td>Rancaekek,   {{getTanggalIndo(date('Y-m-d'))}}</td>
            </tr>
            <tr>
                @for($i=0;$i<($hari);$i++)
                <td></td>
                @endfor
                <td>Kepala Sekolah,</td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                @for($i=0;$i<($hari);$i++)
                <td></td>
                @endfor
                <td><u>Muhammad Fahmy Hadziqy, S.T., Gr.</u></td>
            </tr>
            <tr>
                @for($i=0;$i<($hari);$i++)
                <td></td>
                @endfor
                <td>NUPTK: 1534765666110072</td>
            </tr>
        </table>
      </div>
    </div>
</body>

</html>