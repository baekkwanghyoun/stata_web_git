<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\VarDumper\VarDumper;

class StataController extends Controller
{
    public function chart()
    {
        // ExampleController.php

        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([
                [
                    "label" => "My First dataset",
/*                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",*/
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                ],
                [
                    "label" => "My Second dataset",
/*                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",*/
                    'data' => [12, 33, 44, 44, 55, 23, 40],
                ]
            ])
            ->options([]);

        $chartjs2 = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Label x', 'Label y'])
            ->datasets([
                [
                    "label" => "My First dataset",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    'data' => [69, 59]
                ],
                [
                    "label" => "My First dataset",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
                    'data' => [65, 12]
                ]
            ])
            ->options([]);

        return view('chart', compact('chartjs', 'chartjs2'));
    }

    public function quasar()
    {
        $isSuccess = false;
        $acceptDomain = ['http://stataweb.test:9011/','http://jat.co.kr/', 'https://www.kli.re.kr/', 'http://designblue.NONO/','http://designblue.test:9090/', 'https://www.kli.re.kr/klips/SmartKlipsTestPage.html'];

        $referer = request()->headers->get('referer');
        //dd($referer);
        $result = in_array($referer, $acceptDomain);

        if($result || request()->getHttpHost()=='stataweb.test:9011') {
            return view('quasar');
        }
        else if(Str::contains($referer, 'kli.re.kr')) {
            return view('quasar');
        }
        else {
            return redirect('https://www.kli.re.kr/klips/selectBbsNttList.do?bbsNo=98&key=526');
        }
    }

    public function index()
    {        $isSuccess = false;
        return view('stata.index', compact('isSuccess'));
    }

    public function index2()
    {
        $isSuccess = false;
        return view('stata.index2', compact('isSuccess'));
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
/*
    public function store(Request $request)
    {
        $sid = session()->getId();
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
        }



    }*/


    /* 실 api 호출 */
    public function storeKlips(Request $request)
    {

        $tab = request('tab');

        if($tab=='create') {
            $request->validate([
                'kt_select2_5' => 'required',
                'kt_select2_3' => 'bail:required_without:kt_select2_4',
                'kt_select2_4' => 'required_without:kt_select2_3',
                'filename' => 'required',
            ],[
                'kt_select2_5.required' => '- 차수를 선택하셔야 합니다.',
                'kt_select2_3.required_without' => '- 가구 레벨 변수 또는 가구원 레벨 변수를 선택하셔야 합니다',
                'kt_select2_4.required_without' => '- 가구 레벨 변수 또는 가구원 레벨 변수를 선택하셔야 합니다',
                'kt_select2_3.required' => '- 가구 레벨 변수를 선택하셔야 합니다',
                'kt_select2_4.required' => '- 가구원 레벨 변수를 선택하셔야 합니다',
                'filename.required' => '- 저장할 파일명을 입력하셔야합니다',
            ]);
        }
        else if($tab=='search') {
            $request->validate([
                'kt_select2_5' => 'required',
                'word' => 'required',
            ],[
                'kt_select2_5.required' => '- 차수를 선택하셔야 합니다.',
                'required' => '- 검색할 단어를 입력하셔야 합니다.',
            ]);
        }


        //$text = "log using \"dd.txt\", text \n";
//        try {
        if (env('APP_ENV') == 'local') {
            $text = "cd C:\project\stata_web\public\stata16\klips\n";
        } else {
            $text = "cd C:\www\stata_web_git\public\stata16\klips\n";
        }



        $isSuccess = false;
        $nowDate = Carbon::now()->format('Ymd');
        $foldername = Str::random(16);

        //$filename = 'klips_final_' .$foldername;
        $filename_req = request('filename','klips_final' );

        $households = implode(" ", is_array(request('kt_select2_3')) ? request('kt_select2_3') : array(request('kt_select2_3')));
        $persons = implode(" ", is_array(request('kt_select2_4')) ? request('kt_select2_4') : array(request('kt_select2_4')));
        $waves = implode(" ", is_array(request('kt_select2_5')) ? request('kt_select2_5') : array(request('kt_select2_5')));
        //$text .= "smart_klips ${households} {$persons} , wave( {$waves}) wd( ) website( ) save( )";
        $hp = request('hp');
        $word = request('word');

        $arFile = request('filesave')??[];
        $arFile = Arr::where($arFile, function ($val, $key) {
           return $key != 'Stata';
        });
        $filesave = implode(" ", $arFile);

        $filesaveVal = strtolower($filesave);
        /*if($filesave=='Excel') {
            $filesaveVal = ' excel';
        } else if($filesave=='Csv') {
            $filesaveVal = ' csv';
        }*/
        // 임시로 전부 저장
        //$filesaveVal = ' excel  csv';
        $add_h = request('add_h', '');
        $add_p = request('add_p', '');
        $this->parsingVariable($add_h, $add_p);
        /*///////////////////////////////////////////////////
        // h010150 : 7자리수에 2,3번째 글자가 숫자일경우 체크
        if (strlen($add_h) == 7 && is_numeric(substr($add_h, 1,2)) ) {
            $add_h = substr($add_h, 0,1).substr($add_h, 3,strlen($add_h));
        }
        if (strlen($add_p) == 7 && is_numeric(substr($add_p, 1,2))  ) {
            $add_p = substr($add_p, 0,2).substr($add_p, 3,strlen($add_p));
        }

        ///////////////////////////////////////////////////
        // pa215101 : 8자리수에 둘째글자 까지가 pa로 시작하면서 3,4번째 글자가 숫자일경우 체크
        if (substr($add_h, 0, 2) === 'pa' && strlen($add_h) == 8 && is_numeric(substr($add_h, 2,2)) ) {
            $add_h = 'pa'.substr($add_h, 4,strlen($add_h));
        }
        if (substr($add_p, 0, 2) === 'pa' && strlen($add_p) == 8 && is_numeric(substr($add_p, 2,2)) ) {
            $add_p = 'pa'.substr($add_p, 4,strlen($add_p));
        }

        ///////////////////////////////////////////////////
        // 원변수가 p21orig98 : 9자리수고 첫째글자 p로 시작하면서 2,3번째 글자가 숫자일경우 체크
        if (substr($add_p, 0, 1) === 'p' && strlen($add_p) == 9 && is_numeric(substr($add_p, 1,2)) ) {
            $add_p = 'p'.substr($add_p, 3,strlen($add_p));
        }


        $add_h = $add_h!=''?" add_h({$add_h})":'';
        $add_p = $add_p!=''?" add_p({$add_p})":'';*/

        if($tab==='create') {//C:\\ado\\plus\\s
            $text .= "smart_klips_v3 ${households} {$persons} , wave( {$waves}) wd( )  website( ) save({$filename_req})  {$filesaveVal} {$add_h} {$add_p}"; //D:\\0.silver

        }
        else if($tab==='search') {
            $text .= "smart_klips_search_v3 , wave( {$waves}) wd() hp(${hp}) word({$word}) ";
        }

        Storage::makeDirectory('stata16/do/'.$nowDate);
        $fo = fopen('stata16/do/'.$nowDate.'/' . $filename_req . ".do", "w+");
        fwrite($fo, $text);
        fclose($fo);

        if (env('APP_ENV') == 'local') {
            $output = shell_exec("Stata.exe /q /e do C:/project/stata_web/public/stata16/do/${nowDate}/${filename_req}.do");
        } else {
            $output = shell_exec("C:/stata/isstata/Stata.exe /q /e do C:/www/stata_web_git/public/stata16/do/${nowDate}/${filename_req}.do");
        }
        /*C:/stata/isstata/Stata.exe /e  do "C:\www\stata_web_git\public\stata16\do\20210419\test222.do"*/
        Storage::move($filename_req.'.log', 'stata16/log/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.log');



        if(file_exists('stata16/klips/'.$filename_req.'.zip') ) {
            $isSuccess = true;
            Storage::move('stata16/klips/'.$filename_req.'.zip', 'stata16/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.zip');
        }
        /*
        if(file_exists('stata16/klips/'.$filename.'.dta') ) {
            $isSuccess = true;
            Storage::move('stata16/klips/'.$filename.'.dta', 'stata16/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.dta');
        }
        if(file_exists('stata16/klips/'.$filename.'.csv') ) {
            Storage::move('stata16/klips/'.$filename.'.csv', 'stata16/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.csv');
        }
        if(file_exists('stata16/klips/'.$filename.'.xlsx') ) {
            Storage::move('stata16/klips/'.$filename.'.xlsx', 'stata16/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.xlsx');
        }
        if(file_exists('stata16/klips/'.$filename.'.xlsx') ) {
            Storage::move('stata16/klips/'.$filename.'.xlsx', 'stata16/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.xlsx');
        }
        if(file_exists('stata16/klips/'.$filename.'.xlsx') ) {
            Storage::move('stata16/klips/'.$filename.'.xlsx', 'stata16/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.xlsx');
        }
        */
        //Storage::move('stata16/klips/'.$filename.'.data', 'stata16/result/'.$filename.'.dta');
        //Storage::move('stata16/klips/'.$filename.'.xlsx', 'stata16/result/'.$filename.'.xlsx');


         $fileread = Storage::get('stata16/log/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.log');
//      $fileread = file_get_contents(public_path() . "\\" . "${filename}.log", true);// $fileread = htmlentities($fileread);
//      $fileread = preg_replace("/(\r\n\r\n)/i", "<br />\n", $fileread);
//      $fileread = preg_replace("/  /i", "&nbsp;&nbsp;", $fileread);
//      $fileread = preg_replace("/(<br\s*\/>)+/", "", $fileread);

//        $isSuccess = false;
//        if (Str::contains($fileread, 'saved')) {
//            $isSuccess = true;
//        }

        //$fileread = preg_replace('/[\n\r]+/', '', $fileread);
        //$fileread = Str::replaceFirst('&rt;br',"", $fileread);

        //echo($fileread);
        //session()->flashInput([$fileread]);
        session()->flashInput($request->input());
        //return view('stata.index', compact('fileread', 'isSuccess'));

        if($request->wantsJson()) {
            if($tab==='create') {
                if($isSuccess) { // 검색결과가 존재하지 않아서  파일이 생성되지 않으면 .. (step3에서 둘다 동시에 h010221 넣었었을경우에 발생)
                    return response()->json(['name' => "/stata16/result/${nowDate}/${foldername}/${filename_req}", 'status' => 'success',]);
                }
                else {
                    return response()->json(['errors'=>['data가 조회되지 않았습니다.'], 'message'=>'data가 조회되지 않았습니다.'], 422);
                }
            }
            else if($tab==='search') {
                return response()->json($fileread);
            }
            //return response()->json(['name' => "/klips/klips_final.dta", 'status' => 'success',]);
        }
        else {
            Session::flash('isSuccess', true);
            return back()->withInput();
        }


        //dump($fileread);
        //VarDumper::dump($fileread);

        //$output = shell_exec(\Storage::disk('public')->get("stata/exe.bat"));
        //Stata.exe /q /e do stata16/b.do
        /* }catch(\Throwable $e){
             Log::debug($e);
         }*/
    }

    /*
     * h011513 h011619
        pa215101 p21orig98
        pa5101 porig98
     * */
    public function parsingVariable(&$add_h, &$add_p)
    {
        ////////////////////////////////
        // 가구 "H" 변수 파싱
        $ar_add_h = explode(' ', $add_h);
        $add_h = '';
        foreach ($ar_add_h as $item) {
            ///////////////////////////////////////////////////
            // h010150 : 7자리수에 2,3번째 글자가 숫자일경우 체크
            if (strlen($item) == 7 && is_numeric(substr($item, 1,2)) ) {
                $add_h = $add_h.' '.substr($item, 0,1).substr($item, 3,strlen($item)).' ';
            }
            ///////////////////////////////////////////////////
            // pa215101 : 8자리수에 둘째글자 까지가 pa로 시작하면서 3,4번째 글자가 숫자일경우 체크
            else if (substr($item, 0, 2) === 'pa' && strlen($item) == 8 && is_numeric(substr($item, 2,2)) ) {
                $add_h = $add_h.' '.'pa'.substr($item, 4,strlen($item)).' ';
            }
            else {
                $add_h = $add_h.' '.$item.' ';
            }
        }
        $add_h = $add_h!=''?" add_h({$add_h})":'';

        ////////////////////////////////
        // 가구원 "P" 변수 파싱
        $ar_add_p = explode(' ', $add_p);
        $add_p = '';
        foreach ($ar_add_p as $item_p) {
            if (strlen($item_p) == 7 && is_numeric(substr($item_p, 1,2))  ) {
                $add_p = $add_p.' '.substr($item_p, 0,1).substr($item_p, 3,strlen($item_p));
                //$add_p = $add_p.' '.substr($item_p, 0,2).substr($item_p, 3,strlen($item_p));
            }
            ///////////////////////////////////////////////////////////////////////////////////////////
            // pa215101 : 8자리수에 둘째글자 까지가 pa로 시작하면서 3,4번째 글자가 숫자일경우 체크
            else if (substr($item_p, 0, 2) === 'pa' && strlen($item_p) == 8 && is_numeric(substr($item_p, 2,2)) ) {
                $add_p = $add_p.' '.'pa'.substr($item_p, 4,strlen($item_p));
            }

            ///////////////////////////////////////////////////////////////////////////////////////////
            // 원변수가 p21orig98 : 9자리수고 첫째글자 p로 시작하면서 2,3번째 글자가 숫자일경우 체크
            else if (substr($item_p, 0, 1) === 'p' && strlen($item_p) == 9 && is_numeric(substr($item_p, 1,2)) ) {
                $add_p = $add_p.' '.'p'.substr($item_p, 3,strlen($item_p));
            }
            else {
                $add_p = $add_p.' '.$item_p.' ';
            }
        }
        $add_p = $add_p!=''?" add_p({$add_p})":'';

    }

    /* 사용 안함 : storeKlips로 합침  */
    public function storeKlipsApi(Request $request)
    {
        $request->validate([
            'kt_select2_3' => 'required',
            'kt_select2_4' => 'required',
            'kt_select2_5' => 'required',
        ],[
            'kt_select2_5.required' => '- 차수를 선택하셔야 합니다.',
            'kt_select2_3.required' => '- 가구 레벨 변수를 선택하셔야 합니다',
            'kt_select2_4.required' => '- 가구원 레벨 변수를 선택하셔야 합니다',

        ]);


//        try {
        $_POST['filename'] = 'testSession';
        if (!empty($_POST['filename'])) {
            if(env('APP_ENV')=='local') {
                $text = "cd C:\project\stata_web\public\stata16\klips \n";
                //$text = "cd C:\project\stata_web\public\klips\n";
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
                //D:\Program Files\Stata16
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
            //session()->flashInput($request->input());
            //return view('stata.index', compact('fileread', 'isSuccess'));
            //Session::flash('isSuccess', true);
            return response()->json(['name' => "/klips/klips_final.dta", 'status' => 'success',]);


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
