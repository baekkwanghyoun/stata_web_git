<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Models\StatsStep;
use App\Models\User;
use App\Models\Visit;
use App\Stats\StepStats;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Array_;
use Spatie\Activitylog\Models\Activity;
use Spatie\Stats\StatsQuery;
use Spatie\Stats\StatsWriter;
use Symfony\Component\VarDumper\VarDumper;

/*use Analytics;
use Spatie\Analytics\Period;*/

use Spatie\Stats\Traits\HasStats;

class StataController extends Controller
{



    /**
     * Regular expression for matching and validating a MAC address
     * @var string
     */
    private static $valid_mac = "([0-9A-F]{2}[:-]){5}([0-9A-F]{2})";

    /**
     * An array of valid MAC address characters
     * @var array
     */
    private static $mac_address_vals = array(
        "0", "1", "2", "3", "4", "5", "6", "7",
        "8", "9", "A", "B", "C", "D", "E", "F"
    );

    /**
     * Path where ifconfig will be searched by default
     */
    public static function getIfconfig() {
        $paths = array(
            "/bin/ifconfig",
            "/sbin/ifconfig",
            "/usr/bin/ifconfig",
            "/usr/sbin/ifconfig"
        );
        foreach ($paths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }
        return "ifconfig";
    }

    /**
     * Change the MAC address of the network interface specified
     * @param string $interface Name of the interface e.g. eth0
     * @param string $mac The new MAC address to be set to the interface
     * @return bool Returns true on success else returns false
     */
    public static function setFakeMacAddress($interface, $mac = null, $ifconfig = null)
    {

        // if a valid mac address was not passed then generate one
        if (!self::validateMacAddress($mac)) {
            $mac = self::generateMacAddress();
        }

        // if ifconfig is not defined, the default value is used.
        if (is_null($ifconfig)) {
            $ifconfig = self::getIfconfig();
        }

        // bring the interface down, set the new mac, bring it back up
        self::runCommand($ifconfig. " {$interface} down");
        self::runCommand($ifconfig. " {$interface} hw ether {$mac}");
        self::runCommand($ifconfig. " {$interface} up");

        // TODO: figure out if there is a better method of doing this
        // run DHCP client to grab a new IP address
        self::runCommand("dhclient {$interface}");

        // run a test to see if the operation was a success
        if (self::getCurrentMacAddress($interface) == $mac) {
            return true;
        }

        // by default just return false
        return false;
    }

    /**
     * @return string generated MAC address
     */
    public static function generateMacAddress()
    {
        $vals = self::$mac_address_vals;
        if (count($vals) >= 1) {
            $mac = array("00"); // set first two digits manually
            while (count($mac) < 6) {
                shuffle($vals);
                $mac[] = $vals[0] . $vals[1];
            }
            $mac = implode(":", $mac);
        }
        return $mac;
    }

    /**
     * Make sure the provided MAC address is in the correct format
     * @param string $mac
     * @return bool true if valid; otherwise false
     */
    public static function validateMacAddress($mac)
    {
        return (bool) preg_match("/^" . self::$valid_mac . "$/i", $mac);
    }

    /**
     * Run the specified command and return it's output
     * @param string $command
     * @return string Output from command that was ran
     */
    protected static function runCommand($command)
    {
        return shell_exec($command);
    }

    /**
     * Get the system's current MAC address
     * @param string $interface The name of the interface e.g. eth0
     * @return string|bool Systems current MAC address; otherwise false on error
     */
    public static function getCurrentMacAddress($interface, $ifconfig = null)
    {
        // if ifconfig is not defined, the default value is used.
        if (is_null($ifconfig)) {
            $ifconfig = self::getIfconfig();
        }
        dump($ifconfig);

        $ifconfig = self::runCommand($ifconfig . " {$interface}");
        dump($ifconfig);
        preg_match("/" . self::$valid_mac . "/i", $ifconfig, $ifconfig);
        if (isset($ifconfig[0])) {
            return trim(strtoupper($ifconfig[0]));
        }
        return false;
    }

    public function gatest()
    {
        $activity = Activity::all()->last();
        dump($activity->description); //returns 'created'
        dump($activity->subject); //returns the instance of NewsItem that was created
        dump($activity->changes); //returns ['attributes' => ['name' => 'original name', 'text' => 'Lorum']];

        /*
        //fetch the most visited pages for today and the past week
        $a = Analytics::fetchMostVisitedPages(Period::days(7));
        dump($a);

        echo "Most visited pages";
        $b = Analytics::fetchMostVisitedPages(Period::months(6));
        dump($b);

        echo "Top referrer";
        dump(Analytics::fetchTopReferrers(Period::months(6)));

        echo "User Types";
        dump(Analytics::fetchUserTypes(Period::months(6)));

        echo "Top browsers";
        dump(Analytics::fetchTopBrowsers(Period::months(6)));

        //fetch visitors and page views for the past week
        //Analytics::fetchVisitorsAndPageViews(Period::days(7));
        */
    }

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


        visitor()->visit();

        StatsWriter::for(StatsStep::class, ['name'=>'123'])->increase(1);
        //StatsWriter::for(StatsStep::class, ['name'=>'123'])->increase();


        //StepStats::increase();


/*        $stats = StepStats::query()
            ->start(now()->subMonths(2))
            ->end(now()->subSecond())
            ->groupByDay()
            ->get()->toArray();*/

        /*
         * StatsQuery.php
         * */
        /*
        $stats = StatsQuery::for(StatsStep::class, ['name'=>'12'])
            ->start(now()->subMonths(2))
            ->end(now()->subSecond())
            ->groupByDay()
            ->get()->toArray();

        dump($stats);*/


//        visits('App\Models\Stat')->increment();


        //visits(Stat::class)->forceIncrement();
/*
        dump(visits(Stat::class, 'tag1')->period('day')->count());
        dump(visits(Stat::class, 'tag1')->languages());*/

        /*dump(visits('App\Models\Stat')->period('week')->count());*/

        //visits()->visit();
        $isSuccess = false;
        $acceptDomain = ['http://52.79.82.226','http://stataweb.test:9011/','http://jat.co.kr/', 'https://www.kli.re.kr/', 'http://designblue.ca/','http://designblue.test:9090/', 'https://www.kli.re.kr/klips/SmartKlipsTestPage.html'];

        $referer = request()->headers->get('referer');

/*        if($referer==null) {
            return redirect('https://www.kli.re.kr/klips/selectBbsNttList.do?bbsNo=98&key=526');
        }*/

        //$this->remotelog($referer);

        //dump($referer);

        $result = in_array($referer, $acceptDomain);

        if($result || request()->getHttpHost()=='stataweb.test:9011' ||'http://52.79.82.226') {
            return view('quasar');
        }
        else if(Str::contains($referer, 'jat.co.kr')) {
            return view('quasar');
        }
        else if(Str::contains($referer, 'www.kli.re.kr')) {
            return view('quasar');
        }
        else {
            return redirect('https://www.kli.re.kr/klips/selectBbsNttList.do?bbsNo=98&key=526');
        }
    }

    public function remotelog($v)
    {
        return;
        if($v==null || $v=='') {
            $v = "null";
        }
        $url = 'http://designblue.ca/api/log';
        $data = array('log' => $v);

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
    }

    public function index()
    {        $isSuccess = false;
        return view('stata.index', compact('isSuccess'));
    }

    public function index2()
    {
        $isSuccess = false;
     //   return view('stata.index2', compact('isSuccess'));
    }

    public function create()
    {

    }


    /* 실 api 호출 */
    public function storeKlips(Request $request)
    {

        visitor()->visit();

        // 추후 validation 후로 위치 변경해야함
        $ac = new AnalysisController();
        $ac->store();

        $tab = request('tab');

        if($tab=='create') {
            $request->validate([
                'kt_select2_5' => 'required',
                'kt_select2_3' => 'bail:required_without:kt_select2_4',
                'kt_select2_4' => 'required_without:kt_select2_3',
                'filename' => 'required',
                'filesave' => 'required',
            ],[
                'kt_select2_5.required' => '- 차수를 선택해야 합니다. ',
                'kt_select2_3.required_without' => '- 가구 레벨 변수 또는 가구원 레벨 변수를 선택해야 합니다',
                'kt_select2_4.required_without' => '- 가구 레벨 변수 또는 가구원 레벨 변수를 선택해야 합니다',
                'kt_select2_3.required' => '- 가구 레벨 변수를 선택해야 합니다',
                'kt_select2_4.required' => '- 가구원 레벨 변수를 선택해야 합니다',
                'filename.required' => '- 저장할 파일명을 입력해야합니다',
                'filesave.required' => '- 저장할 파일타입을 선택해야합니다 ',
            ]);
        }
        else if($tab=='search') {
            $request->validate([
                'kt_select2_5' => 'required',
                'word' => 'required',
            ],[
                'kt_select2_5.required' => '- 차수를 선택해야 합니다.',
                'required' => '- 검색할 단어를 입력해야 합니다.',
            ]);
        }


        //$text = "log using \"dd.txt\", text \n";
//        try {
        if (env('APP_ENV') == 'local') {
            $text = "cd E:\project\stata_web\public\stata\klips\n";
            //$text = "cd C:\project\stata_web\public\stata\klips\n";
        } else {
            $text = "cd C:\www\klips3\storage\app\public\\round\n";
            //$text = "cd C:\www\klips3\public\stata\klips\n";
        }



        $isSuccess = false;
        $nowDate = Carbon::now()->format('Ymd');
        $foldername = Str::random(16);

        //$filename = 'klips_final_' .$foldername;
        $filename_req = request('filename','download_klips' );

        // kt_select2_3, kt_select2_4, add_h, add_p
        $households = implode(" ", is_array(request('kt_select2_3')) ? request('kt_select2_3') : array(request('kt_select2_3')));
        $persons = implode(" ", is_array(request('kt_select2_4')) ? request('kt_select2_4') : array(request('kt_select2_4')));
        $waves = implode(" ", is_array(request('kt_select2_5')) ? request('kt_select2_5') : array(request('kt_select2_5')));
        //$text .= "smart_klips ${households} {$persons} , wave( {$waves}) wd( ) website( ) save( )";
        $hp = request('hp');
        $word = request('word');

        $len_kt_select2_3 = count(request('kt_select2_3')??[]);
        $len_kt_select2_4 = count(request('kt_select2_4')??[]);
        $len_add_h = request('add_h')?count(explode(' ', request('add_h'))):0;
        $len_add_p = request('add_p')?count(explode(' ', request('add_p'))):0;
        $totLen = $len_kt_select2_3 + $len_kt_select2_4 + $len_add_h + $len_add_p;
        if($totLen > 200) {
            $msg  = '가구용 가공변수 + 개인용 가공변수 + 원자료변수(가구용 + 개인용)를  200개이상 선택하실수 없습니다.';
            return response()->json(['errors'=>[$msg], 'message'=>$msg], 422);
        }

        /*체크박스일경우*/
        $arFile = request('filesave')??[];
        $arFile = Arr::where($arFile, function ($val, $key) {
           return $val != 'Stata';
        });

        /**/
        $filesave = implode(" ", $arFile);

//        $filesave = request('filesave')??'';

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

        $a_wave = request('a_wave');
        $add_a = request('add_a');

        //smart_klips_v3 h_resid_type p_age , wave(01 03 04 06) add_h(h0141) add_p(p0111) add_a1(a0101) add_a2(a1101) add_a3(a1725) a1_wave(03) a2_wave(04) a3_wave(06)
        $addTxt='';
        if(isset($a_wave[0]) && isset($add_a[0])) {
            $addTxt = ' a1_wave('.$a_wave[0]['value'].') add_a1('.$add_a[0].')';
        }
        if(isset($a_wave[1]) && isset($add_a[1])) {
            $addTxt .= ' a2_wave('.$a_wave[1]['value'].') add_a2('.$add_a[1].')';
        }
        if(isset($a_wave[2]) && isset($add_a[2])) {
            $addTxt .= ' a3_wave('.$a_wave[2]['value'].') add_a3('.$add_a[2].')';
        }

        $tyCd = request('tyCd', '');

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
            $ado_name = '';
/*            if(request('add_h')==null && request('add_p')==null && $addTxt == '') {
                $ado_name = 'smart_klips_v4';
            }
            else {
                $ado_name = 'smart_klips_v3';
            }*/
            $ado_name = 'smart_klips_v3';
            $text .= $ado_name." ${households} {$persons} , wave( {$waves}) save({$filename_req})  {$filesaveVal} {$add_h} {$add_p} {$addTxt}"; //{$tyCd}

        }
        else if($tab==='search') {
            $text .= "smart_klips_search_v3, wave( {$waves}) wd() hp(${hp}) word({$word}) ";
        }

        Storage::disk('public')->makeDirectory('stata/do/'.$nowDate) ;
        $fo = fopen('../storage/app/public/stata/do/'.$nowDate.'/' . $filename_req . ".do", "w+");
        //$fo = fopen('stata/do/'.$nowDate.'/' . $filename_req . ".do", "w+");
        fwrite($fo, $text);
        fclose($fo);

        // 안될때 php.ini의 shell_exec ;
        // output은 원래 없음
        if (env('APP_ENV') == 'local') {
            //d에 stata프로그램은 있고 . do파일은 프로젝트 안에 있음
            // local에서는 sail때문에 테스트 안됨. 일반 윈도우로 땡겨서 테스트 해야함. 착오방지를 위해 주석..
            //$output = shell_exec("D:/stata/Stata/Stata.exe /q /e do E:/project/stata_web/public/stata/do/${nowDate}/${filename_req}.do");
        } else {
            $output = shell_exec("C:/stata/isstata/Stata.exe /q /e do C:/www/klips3/storage/app/public/stata/do/${nowDate}/${filename_req}.do");
            //$output = shell_exec("C:/stata/isstata/Stata.exe /q /e do C:/www/klips3/public/stata/do/${nowDate}/${filename_req}.do");
        }

        //  여기에서 ./storage는 root에서 윈도우 심볼릭 링크가 걸린 C:\www\klips3\public\storage를 말함
        Storage::move($filename_req.'.log', './storage/stata/log/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.log');




        $filenameAddDate = Str::substr($nowDate, 2, 6);
        Log::info(Carbon::now());
        Log::info($filenameAddDate);
        //$filenameAddDate = '221108';
        if(Storage::disk('public')->exists('round/'.$filename_req.'_'.$filenameAddDate.'.zip')) {
        //if(file_exists('stata/klips/'.$filename_req.'.zip') ) {
            $isSuccess = true;
            try {
                Storage::disk('public')->move('round/'.$filename_req.'_'.$filenameAddDate.'.zip',
                    'stata/result/'.$nowDate.'/'.$foldername.'/'.$filename_req.'_'.$filenameAddDate.'.zip');
            } catch (\Exception $ex) {
                $error = $ex->getMessage();
            }
        }




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

        if($tab==='create') {
            if($isSuccess) { // 검색결과가 존재하지 않아서  파일이 생성되지 않으면 .. (step3에서 둘다 동시에 h010221 넣었었을경우에 발생)
                //return response()->json(['name' => '/'.Storage::url("stata/result/${nowDate}/${foldername}/${filename_req}_${filenameAddDate}"), 'status' => 'success','ado_name' => $ado_name,]);
                return response()->json(['name' => URL::to('/').Storage::url("stata/result/${nowDate}/${foldername}/${filename_req}_${filenameAddDate}"),
                    'status' => 'success','ado_name' => $ado_name,]);
            }
            else {
                $content = fopen(Storage::path("/storage/stata/log/${nowDate}/${foldername}/${filename_req}.log"),'r');
                //$content = fopen(Storage::path("/storage/stata/log/fd123.log"),'r');

                $idxLine = 0;
                $errlog = "";
                while(!feof($content)){
                    $idxLine++;
                    $line = fgets($content);
                    if($idxLine == 7) {
                        //$line = fgets($content);
                        $errlog .= $line;
                    }
                }
                //$errlog = '';
                return response()->json(['errors'=>[$errlog], 'message'=>$errlog,'ado_name' => $ado_name, 'err'=>$errlog], 422);
                //return response()->json(['errors'=>['- data가 조회되지 않았습니다.'], 'message'=>'- data가 조회되지 않았습니다.','ado_name' => $ado_name, 'err'=>$errlog], 422);
            }
        }
        else if($tab==='search') {
            //$fileread = Storage::get('stata/log/'.$nowDate.'/'.$foldername.'/'.$filename_req.'.log');
            //$fileread = fopen(Storage::path("/storage/stata/log/${nowDate}/${foldername}/${filename_req}.log"),'r');

            $fileread = fopen(Storage::path("/storage/stata/log/${nowDate}/${foldername}/download_klips.log"),'r');
            $idxLine = 0;
            $searchlog = "";
            while(!feof($fileread)){
                $idxLine++;
                $line = fgets($fileread);
                if($idxLine > 8) {
                    //$line = fgets($content);
                    $searchlog .= $line;
                }
            }
            $errlog = '';
           return response()->json($searchlog);
        }



        //dump($fileread);
        //VarDumper::dump($fileread);

        //$output = shell_exec(\Storage::disk('public')->get("stata/exe.bat"));
        //Stata.exe /q /e do stata/b.do
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
        //$ar_add_h = explode(' ', $add_h);
        $ar_add_h = [];
        if($add_h != '') {
            $ar_add_h = explode(' ', $add_h);
        }

        $add_h = '';
        foreach ($ar_add_h as $item) {
            ///////////////////////////////////////////////////
            // h010150 : 7자리수에 2,3번째 글자가 숫자일경우 체크 !!
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

        //$ar_add_p = explode(' ', $add_p);
        $ar_add_p = [];
        if($add_p != '') {
            $ar_add_p = explode(' ', $add_p);
        }

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

}
