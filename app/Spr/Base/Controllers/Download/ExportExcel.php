<?php
namespace Spr\Base\Controllers\Download;

use App\Http\Models\User;
use App\Http\Controllers\Controller;
use Shaphira\Base\Response\Response;
use Illuminate\Support\Facades\Input;
use Shaphira\Base\Controllers\Http\Request;
use Shaphira\Base\Controllers\ExchangeRates\Bitcoin\Blockchain;
use Shaphira\Base\Controllers\ExchangeRates\Currency\VietCombank;
use Config;
use Auth;
use Cache;
use Session;
use Mail;
use Hash;
use Lang;
use Excel;

class ExportExcel extends Controller{

    public function __construct () {

    }

    /*
    |--------------------------------------------------------------------------
    | sendEmail
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    public static function ExportToExcelAndDownload ($data, $fileName, $companyName, $title, $arrayTitle) {

        $localTime = 7 * 60 * 60;
        $col       = ['A','B','C','D',"E","F",'G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        ob_end_clean();
        ob_start();
    	Excel::create($fileName, function ($excel) use($data, $companyName, $title, $arrayTitle, $localTime, $col) {

            $excel->sheet('Sheet1', function ($sheet) use ($data, $companyName, $title, $arrayTitle, $localTime, $col){
                $colExcel = $col[COUNT($arrayTitle) - 1];

                // first row styling and writing content
                $sheet->mergeCells('A1:'.$colExcel.'1');
                $sheet->row(1, function ($row) {

                    $row->setFontFamily('arial');
                    $row->setFontSize(15);
                    $row->setFontWeight('bold');
                });

                $sheet->row(1, array($companyName));
                $sheet->cell('A1',function($cell){

                    $cell->setAlignment('center');

                });

                // second row styling and writing content
                $sheet->row(2, function ($row) {

                    // call cell manipulation methods
                    $row->setFontFamily('arial');
                    $row->setFontSize(13);
                    $row->setFontWeight('bold');

                });


                $sheet->row(2, array($title));
                $sheet->mergeCells('A2:'.$colExcel.'2');
                $sheet->cell('A2',function($cell){

                    $cell->setAlignment('center');

                });

                $listTitle = array();
                foreach ($arrayTitle as $key => $value) {
                    $listTitle[$key] = $value['label'];
                }
                $sheet->row(3,$listTitle);
                $sheet->row(3, function($row){
                    $row->setFontFamily('arial');
                    $row->setFontSize(12);
                    $row->setFontWeight('bold');
                    $row->setBackground('#ffff00');
                });
                $sheet->cell('A3',function($cell){

                    $cell->setAlignment('center');

                });
                // getting last row number (the one we already filled and setting it to bold
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                // putting users data as next rows
                $stt = 1;
                foreach ($data['response'] as $item => $value) {

                    $new_array = array();
                    foreach ($arrayTitle as $key => $_value) {
                        if($key != 'stt' && $key != "STT"){
                            if($_value['type'] == "time" && $value->$key != ''){
                                $new_array[$key] = date("H:i:s d-m-Y ", $value->$key + $localTime);
                            }elseif($_value['type'] == 'status'){

                                if($_value['config'] != '') {

                                    $new_array[$key] = Config::get($_value['config'])[$value->$key]['message'];
                                }else {
                                    $new_array[$key] = Cache::get($_value['cache'])[$value->$key];
                                }
                            }else {
                                $new_array[$key] = $value->$key;
                            }
                        }else{
                            $new_array[$key] = $stt;
                        }
                    }

                    $sheet->row($stt + 3,$new_array);

                    $stt++;
                }

                $to = $stt + 2;
                $sheet->setFreeze('A4');
                $sheet->setBorder('A3:'.$colExcel.''.$to.'', 'thin');
                $sheet->setAutoSize(true);
            });

        })->download('xls');
    }
}
?>