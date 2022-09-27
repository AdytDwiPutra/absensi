<?php

namespace App\Http\Controllers;

use App\Models\Absenmasuk;
use App\Models\Absenkeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class IclockController extends Controller
{
        public function getrequest(Request $request)
    {
      // return ('hellow word');
      // "FWVersion=%s\nUserCount=%s\nFPCount=%s\nTransactionCount=%s\nIPAddress=%s\nFPVersion=%s\n" % tuple(info[:6])
      // "INFO=%s\nUserCount=%s\nFPCount=%s\nTransactionCount=%s\nIPAddress=%s\nFPVersion=%s\n" % tuple(info[:6])
      // /iclock/getrequest?SN=BWXP193961327&INFO=Ver%208.0.4.4-20190617,2,2,18,192.168.1.201,10,-1,0,0,101
      // dd($_SERVER['REMOTE_ADDR']);
      if ($request->INFO != null) {
        // code...
        $data = explode(",", $request->INFO);
        // dd($data);
        $version = $data[0];
        $usercount = $data[1];
        $fpcount = $data[2];
        $transactioncount = $data[3];
      }

      // $ipaddress = $data[4];
      $ipaddress = $_SERVER['REMOTE_ADDR'];

      $sn   = $request->SN;
      $lang   = $request->language;
      $pushver   = $request->pushver;
      $opt  = $request->options;
      // $tbl  = $request->table;
      $stmp = $request->Stamp;
      $tmzon = "+7";

      header("Content-Type:text/plain");
      echo "GET OPTION FROM:" . $sn;
      echo "\n";
      echo "TimeZone=" . $tmzon;
      echo "\n";
      echo "Realtime=1";
      echo "OK:1";
      // return response('OK:1', 200)
      //             ->header('Content-Type', 'text/plain');

    }
    public function cdataget(Request $request)
    {
        $path = $request->url();
        // dd($request);
        // dd($path);
        $sn   = $request->SN;
        $lang   = $request->language;
        $pushver   = $request->pushver;
    		$opt  = $request->options;
    		$tbl  = $request->table;
    		$stmp = $request->Stamp;
        $tmzon = "+7";
    		$attlog = rand(1000, 9999);
    		$operlog = rand(1000, 9999);
        $dt   = date('Y-m-d');
    		$dateNow   = date('Y-m-d');

        header("Content-Type:text/plain");
        echo "GET OPTION FROM:" . $sn;
    		echo "\n";
    		echo "ATTLOGStamp=" . $attlog;
    		echo "\n";
    		echo "OPERLOGStamp=" . $operlog;
    		echo "\n";
    		echo "ErrorDelay=60";
    		echo "\n";
    		echo "Delay=30";
    		echo "\n";
    		echo "TransTimes=07:00,08:00";
    		echo "\n:";
    		echo "TransInterval=1";
    		echo "\n";
    		echo "TransFlag=1111000000";
    		echo "\n";
    		echo "TimeZone=" . $tmzon;
    		echo "\n";
    		echo "Realtime=1";
    		echo "\n";
    		echo "Encrypt=0";
        // File::put('image/'.$sn . '.txt','Get2');
    }
    public function cdatapost(Request $request)
    {

        $sn   = $request->SN;
    	  $tbl  = $request->table;
        $xt    = round(microtime(true));
        $content = $request->getContent();
        $array = explode("\n", $content);
        // $newfilename = $sn . "-" . $xt . ".txt";
        // File::put('images/' . $newfilename, $content);

        if ($tbl == 'ATTLOG') {

                      $jml_array = count($array);
                      if($jml_array > 1 )
                      {
                      	foreach($array as $a => $val)
                        {
                          	$arr = preg_split('/\s+/', $val);
                            unset($logatten);
                            $logatten = [
                                'sn' => $sn,
                                'id_user' => $arr[0],
                                'tanggal' => $arr[1],
                                'waktu' => $arr[2],
                                'tipe' => $arr[3],
                                '4' => $arr[4],
                                '5' => $arr[5],
                                '6' => $arr[6],
                                'created_at' => now(),
                            ];
                            unset($logic1);
                            $logic1=Absenmasuk::where('id_user',$arr[0])
                                          ->where('tanggal',$arr[1])
                                          ->where('tipe',(int)$arr[3])
                                          ->count();

                            if (($arr[3] == 0) && ($logic1 == 0) ) {
                              Absenmasuk::insert($logatten);
                              return response('OK', 200)
                                          ->header('Content-Type', 'text/plain');
                            }
                            else {
                              // $save = Logatten::insert($logatten);
                              return response('OK', 200)
                                          ->header('Content-Type', 'text/plain');
                            }


                          }
                        }

                      else{
                      	$arr = preg_split('/\s+/', $content);
                        $logatten = [
                            'sn' => $sn,
                            'id_user' => $arr[0],
                            'tanggal' => $arr[1],
                            'waktu' => $arr[2],
                            'tipe' => $arr[3],
                            '4' => $arr[4],
                            '5' => $arr[5],
                            '6' => $arr[6],
                            'created_at' => now(),
                        ];
                        $logic1=Absenmasuk::where('id_user',$arr[0])
                                      ->where('tanggal',$arr[1])
                                      ->where('tipe',(int)$arr[3])
                                      ->count();
                        unset($logic2);
                        $logic2=Absenkeluar::where('id_user',$arr[0])
                                      ->where('tanggal',$arr[1])
                                      ->where('tipe',(int)$arr[3])
                                      ->count();
                        if (($arr[3] == 0) && ($logic1 == 0) ) {
                          Absenmasuk::insert($logatten);
                          return response('OK', 200)
                                      ->header('Content-Type', 'text/plain');
                                    }
                          else {
                            // $save = Logatten::insert($logatten);
                            return response('OK', 200)
                                        ->header('Content-Type', 'text/plain');
                          }


                          }
          }

          if ($tbl == 'OPERLOG') {
            $content = $request->getContent();
            $xt    = round(microtime(true));
            $newfilename = $tbl . "-" . $sn . "-" . $xt . ".txt";
            File::put('images/' . $newfilename, $content);
            echo "OK:1";
      			echo "\n";
      			echo "POST from: " . $sn;
          }




      }
}
