<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\VarDumper\VarDumper;

class StataController extends Controller
{
    public function index()
    {
        $isSuccess = false;
        return view('stata.index', compact('isSuccess'));
    }

    public function create()
    {

        // /b 옵션으로 완료 여부를 알수 있네.
        //$output = shell_exec(\Storage::disk('public')->get("stata/exe.bat"));
        //dump($output);
//
//        $data = shell_exec("dir");
//        $data = mb_convert_encoding($data, "UTF-8", "euc-kr");
//        dump($data);
    }

    public function store(Request $request)
    {
//        try {
            if (!empty($_POST['filename'])) {

            $text = $_POST["textdata"];
            $filename = $_POST['filename'];
            $fo = fopen('stata16/'.$filename. ".do","w+");
            fwrite($fo,$text);
            fclose($fo);

            if(env('APP_ENV')=='local')
            {
                $output = shell_exec("Stata.exe /q /e do C:/project/stata_web/public/stata16/${filename}.do");
            }
            else {
                $output = shell_exec("C:/stata/isstata/Stata.exe /q /e do C:/www/stata_web_git/public/stata16/${filename}.do");
            }




            $fileread = file_get_contents(public_path()."\\"."${filename}.log", true);
//            $fileread = htmlentities($fileread);
            $fileread = preg_replace("/(\r\n\r\n)/i","<br />\n", $fileread);
            $fileread = preg_replace("/  /i","&nbsp;&nbsp;", $fileread);
            $fileread = preg_replace("/(<br\s*\/>)+/", "", $fileread);
            //$fileread = preg_replace('/[\n\r]+/', '', $fileread);

            //$fileread = Str::replaceFirst('&rt;br',"", $fileread);
            //echo($fileread);
            //session()->flashInput([$fileread]);
            session()->flashInput($request->input());
            $isSuccess = false;
            return view('stata.index', compact('fileread', 'isSuccess'));
            //return back()->withInput();


            //dump($fileread);
            //VarDumper::dump($fileread);

            //$output = shell_exec(\Storage::disk('public')->get("stata/exe.bat"));
            //Stata.exe /q /e do stata16/b.do

            }
       /* }catch(\Throwable $e){
            Log::debug($e);
        }*/



    }


    public function storeKlips(Request $request)
    {
//        try {
        $_POST['filename'] = 'testSession';
        if (!empty($_POST['filename'])) {
            if(env('APP_ENV')=='local') {
                $text = "cd C:\project\stata_web\public\klips\n";
            }
            else {
                $text = "cd C:\www\stata_web_git\public\klips\n";
            }


            $households = implode(" ", is_array(request('kt_select2_3'))?request('kt_select2_3'):array(request('kt_select2_3') ));
            $persons = implode(" ", is_array(request('kt_select2_4'))?request('kt_select2_4'):array(request('kt_select2_4') ));
            $waves = implode(" ", is_array(request('kt_select2_5'))?request('kt_select2_5'):array(request('kt_select2_5') ));
            $text .= "smart_klips ${households} {$persons} , wave( {$waves}) wd( ) website( ) save( )";
//            $text .= $households;
//            $text .= $persons;
//            $text .= $waves;

            $filename = $_POST['filename'];



            $fo = fopen('stata16/'.$filename. ".do","w+");
            fwrite($fo,$text);
            fclose($fo);

            if(env('APP_ENV')=='local')
            {
                $output = shell_exec("Stata.exe /q /e do C:/project/stata_web/public/stata16/${filename}.do");
            }
            else {
                $output = shell_exec("C:/stata/isstata/Stata.exe /q /e do C:/www/stata_web_git/public/stata16/${filename}.do");
            }

            $fileread = file_get_contents(public_path()."\\"."${filename}.log", true);
//            $fileread = htmlentities($fileread);
            $fileread = preg_replace("/(\r\n\r\n)/i","<br />\n", $fileread);
            $fileread = preg_replace("/  /i","&nbsp;&nbsp;", $fileread);
            $fileread = preg_replace("/(<br\s*\/>)+/", "", $fileread);

            $isSuccess = false;
            if(Str::contains($fileread, 'saved')) {
                $isSuccess = true;
            }

            //$fileread = preg_replace('/[\n\r]+/', '', $fileread);

            //$fileread = Str::replaceFirst('&rt;br',"", $fileread);
            //echo($fileread);
            //session()->flashInput([$fileread]);
            session()->flashInput($request->input());
            return view('stata.index', compact('fileread', 'isSuccess'));
            //return back()->withInput();


            //dump($fileread);
            //VarDumper::dump($fileread);

            //$output = shell_exec(\Storage::disk('public')->get("stata/exe.bat"));
            //Stata.exe /q /e do stata16/b.do

        }
        /* }catch(\Throwable $e){
             Log::debug($e);
         }*/



    }
}
