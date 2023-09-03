<?php

use App\Models\Logattenmasuk;

    header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'cek':
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
                $data = Logattenmasuk::select('*')
                ->where('id_user', $_POST['arguments'][0])
                ->where('tanggal', $_POST['arguments'][1])
                ->get();
                if(count($data) != 0){
                    $x['teks'] = 'Hadir';
                    $x['badge'] = 'info';
                }else{
                    $x['teks'] = 'Tidak Hadir';
                    $x['badge'] = 'danger';
                }
                   $aResult['result'] = $x;
               }
               break;

            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);

?>