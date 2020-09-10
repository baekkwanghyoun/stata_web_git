<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper;

class StataController extends Controller
{
    public function index()
    {
        return view('stata.index');
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
        if (!empty($_POST['filename'])) {

            $text = $_POST["textdata"];
            $filename = $_POST['filename'];
            $fo = fopen('stata16/'.$filename. ".do","w+");
            fwrite($fo,$text);
            fclose($fo);

            $output = shell_exec("Stata.exe /q /e do stata16/${filename}.do");

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
            return view('stata.index', compact('fileread'));
            //return back()->withInput();


            //dump($fileread);
            //VarDumper::dump($fileread);

            //$output = shell_exec(\Storage::disk('public')->get("stata/exe.bat"));
            //Stata.exe /q /e do stata16/b.do

/*            while(!feof($file)){
                $old = $old . fgets($file). "<br />";
            }*/

//            file_put_contents($_POST['filename'] . ".txt", $old . $text);
//            //file_put_contents($_POST['filename'] . ".txt", $old . $text);
//
        }

/*        if ($_POST['submitopen'] == "Submit File Request") {
            if(!file_exists($_POST['filename'] . ".txt")){
                exit("Error: File does not exist.");
            }
            $file = fopen($_POST['filename'] . ".txt", "r");
            while(!feof($file)){
                echo fgets($file). "<br />";
            }
            fclose($file);
        }*/
    }
}
