@php
 $kt_select2_3 = [
        ["h_resid_type", '주택점유형태 (1=자가, 2=전세, 3=월세, 4=기타)'],["h_hprice", '소유주택시가 (단위: 만원)'],
        ["h_region", "거주지역(16개시도, 19=세종시) KLIPS 코드북참고"],["h_hsex", "가구주 성별 (1=남자, 2=여자)"],["h_hage", "가구주 나이"],["h_kidage06", "0세~6세자녀 수"],
        ["h_kidage712", "7세~12세자녀 수"],["h_kidage1315", "13세~15세자녀 수"],["h_kid", "0세 ~ 고등학교 자녀 수 "],["h_num", "가구원 수"],
        ["h_hmarital", "가구주 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],["h_hedu", "가구주 교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"],["h_inc_1", "이전소득(단위: 만원)"],
        ["h_inc_2", "사회보험소득(단위: 만원)"],["h_inc_3", "기타소득(단위: 만원)"],["h_inc_4", "근로소득(단위: 만원)"],["h_inc_5", "금융소득(단위: 만원)"],["h_inc_6", "부동산소득(단위: 만원)"],
        ["h_inc_total", "총소득(단위: 만원)"],["h_incomeq", "소득10분위 (1=최하위 10%, 2=최하위 10%~20%...10=최상위 10%)"],["h_asset_1", "금융자산(단위: 만원)"],
        ["h_asset_2_1", "부동산자산(거주주택 제외):연속형 (단위 : 만원)"],
        ["h_asset_2_2", "부동산자산(거주주택제외):범주형 (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],
        ["h_asset_3_1", "임차보증금(연속형) (단위: 만원)"],
        ["h_asset_3_2", "임차보증금(범주형) (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],
        ["h_debt_total", "부채총액(임대보증금 포함) (단위: 만원)"],["h_debt_pay", "부채상환액 (단위: 만원/월)"],["h_eqscale_ori", "OECD 가구균등화지수_original"],
        ["h_eqscale_mod", "OECD 가구균등화지수_modified"],["h_sample98", "98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"],
        ["h_sample09", "통합표본 원가구여부 (1=통합표본 원가구, 2=통합표본 분가가구, 3=조사대상 가구 아님)"],["h_weight_1", "98표본 가구 가중치"],["h_weight_2", "통합표본 가구 가중치"]
    ];
$kt_select2_4 = [
    ["p_sex","가구원 성별 (1=남자, 2=여자)"],["p_age","가구원 나이"], ["p_rel","가구주와의 관계 KLIPS 코드북 참고"], ["p_edu","교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"],
    ["p_religion","종교 (1=무교, 2=불교, 3=기독교(개신교), 4=천주교, 5~10: KLIPS 코드북 참고)"], ["p_married","가구원 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],
    ["p_region","거주지역(16개시도, 19=세종시) KLIPS 코드북참고"], ["p_econstat","ILO기준경제활동 (1=취업자, 2=ILO기준실업자, 3=비경제활동자)"], ["p_job_type","임금근로자 여부 (1=임금근로자, 2=비임금근로자)"],
    ["p_wage","월평균 임금 또는 소득 (단위: 만원)"], ["p_hours","주당 평균근로시간(임금근로자)"], ["p_employ_type","취업형태 (1=임금근로자, 2=자영업, 3=무급가족종사자)"],
    ["p_job_status","종사상지위 (1=상용직, 2=임시직, 3=일용직, 4=고용주/자영업자, 5=무급가족 종사자)"], ["p_ind2000","업종(한국표준산업분류8차 개정:2000년 code) KLIPS 코드북 참고"],
    ["p_ind2007","업종(한국표준산업준류 9차 개정: 2007년 code) KLIPS 코드북 참고"], ["p_ind2017","업종(한국표준산업준류 10차 개정: 2017년 code) KLIPS 코드북 참고"],
    ["p_jobfam2000","직종(한국표준직업분류 5차: 2000년 code) KLIPS 코드북 참고"], ["p_jobfam2007","직종(한국표준직업분류 6차: 2007년 code) KLIPS 코드북 참고"],
    ["p_jobfam2017","직종(한국표준직업분류 6차: 2017년 code) KLIPS 코드북 참고"], ["p_firm_size","종업원규모(범주형) (1=10명미만, 2=10명~29명, 3=30명~99명, 4=100명~299명, 5=300명~499명, 6=500명이상)"],
    ["p_job_begin","취업시기(년도와 월)"], ["p_weight_1","종단가중치(98표본)"], ["p_weight_2","횡단가중치(98표본)"], ["p_weight_3","종단가중치(통합표본)"], ["p_weight_4","횡단가중치(통합표본)"],
    ["p_sample98","98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"], ["p_sample09", "통합표본 원가구여부 (1=통합표본 원가구, 2=통합표본 분가가구, 3=조사대상 가구 아님)"],
];

@endphp

<div class="accordion  accordion-toggle-arrow" id="accordionExample4">
{{--    <div class="card">
        <div class="card-header" id="headingOne4">
            <div class="card-title" data-toggle="collapse" data-target="#collapseOne4">
                <i class="flaticon2-layers-1"></i> 차수 : 01~21 (필수)
            </div>
        </div>
        <div id="collapseOne4" class="collapse show" data-parent="#accordionExample4">
            <div class="card-body">
                <div class="form-group">
                    <div class="list list-hover min-w-500px" data-inbox="list">
                        @for ($i = 1; $i <= 21; $i++)
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" name="kt_select2_5" value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex-grow-1  mr-2" data-toggle="view">
                                    <div class="font-weight-bolder mr-2">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    --}}{{--
                    <select class="form-control select2" id="kt_select2_3" name="kt_select2_3[]" multiple="multiple" required>
                        <option value="h_resid_type">h_resid_type</option>
                        <option value="h_hprice">h_hprice</option>
                        <option value="h_region">h_region</option>
                        <option value="h_hsex">h_hsex</option>
                        <option value="h_hage">h_hage</option>
                        <option value="h_kidage06">h_kidage06</option>
                        <option value="h_kidage712">h_kidage712</option>
                        <option value="h_kidage1315">h_kidage1315</option>
                        <option value="h_kid">h_kid</option>
                        <option value="h_num">h_num</option>
                        <option value="h_hmarital">h_hmarital</option>
                        <option value="h_hedu">h_hedu</option>
                        <option value="h_inc_1">h_inc_1</option>
                        <option value="h_inc_2">h_inc_2</option>
                        <option value="h_inc_3">h_inc_3</option>
                        <option value="h_inc_4">h_inc_4</option>
                        <option value="h_inc_5">h_inc_5</option>
                        <option value="h_inc_6">h_inc_6</option>
                        <option value="h_inc_total">h_inc_total</option>
                        <option value="h_incomeq">h_incomeq</option>
                        <option value="h_asset_1">h_asset_1</option>
                        <option value="h_asset_2_1">h_asset_2_1</option>
                        <option value="h_asset_2_2">h_asset_2_2</option>
                        <option value="h_asset_3_1">h_asset_3_1</option>
                        <option value="h_asset_3_2">h_asset_3_2</option>
                        <option value="h_debt_total">h_debt_total</option>
                        <option value="h_debt_pay">h_debt_pay</option>
                        <option value="h_eqscale_ori">h_eqscale_ori</option>
                        <option value="h_eqscale_mod">h_eqscale_mod</option>
                        <option value="h_sample98">h_sample98</option>
                        <option value="h_sample09">h_sample09</option>
                        <option value="h_weight_1">h_weight_1</option>
                        <option value="h_weight_2">h_weight_2</option>
                    </select>
                --}}{{--
                </div>
            </div>
        </div>
    </div>--}}
    <div class="card">
        <div class="card-header" id="headingTwo4">
            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4">
                <i class="flaticon2-copy"></i> 가구 레벨 변수
            </div>
        </div>
        <div id="collapseTwo4" class="collapse" data-parent="#accordionExample4">
            <div class="card-body">
                {{--가구레벨--}}
                <div class="form-group">
                    <div class="list list-hover min-w-500px" data-inbox="list">
                        @foreach($kt_select2_3 as $item)
                            <div class="d-flex align-items-center list-item card-spacer-x py-4" data-inbox="message">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" name="kt_select2_3[]" value="{{$item[0]}}"  @if(in_array($item, old('kt_select2_3')??[])) checked="checked" @endif>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex-grow-1  mr-2 " data-toggle="view">
                                    <div class="col"><span class="font-weight-bolder mr-2 font-size-h5-sm">{{$item[0]}} </span></div>
                                    <div class="col"><span class="text-primary font-size-sm">{{$item[1]}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{--
                    <select class="form-control select2" id="kt_select2_3" name="kt_select2_3[]" multiple="multiple" required>
                        <option value="h_resid_type">h_resid_type</option>
                        <option value="h_hprice">h_hprice</option>
                        <option value="h_region">h_region</option>
                        <option value="h_hsex">h_hsex</option>
                        <option value="h_hage">h_hage</option>
                        <option value="h_kidage06">h_kidage06</option>
                        <option value="h_kidage712">h_kidage712</option>
                        <option value="h_kidage1315">h_kidage1315</option>
                        <option value="h_kid">h_kid</option>
                        <option value="h_num">h_num</option>
                        <option value="h_hmarital">h_hmarital</option>
                        <option value="h_hedu">h_hedu</option>
                        <option value="h_inc_1">h_inc_1</option>
                        <option value="h_inc_2">h_inc_2</option>
                        <option value="h_inc_3">h_inc_3</option>
                        <option value="h_inc_4">h_inc_4</option>
                        <option value="h_inc_5">h_inc_5</option>
                        <option value="h_inc_6">h_inc_6</option>
                        <option value="h_inc_total">h_inc_total</option>
                        <option value="h_incomeq">h_incomeq</option>
                        <option value="h_asset_1">h_asset_1</option>
                        <option value="h_asset_2_1">h_asset_2_1</option>
                        <option value="h_asset_2_2">h_asset_2_2</option>
                        <option value="h_asset_3_1">h_asset_3_1</option>
                        <option value="h_asset_3_2">h_asset_3_2</option>
                        <option value="h_debt_total">h_debt_total</option>
                        <option value="h_debt_pay">h_debt_pay</option>
                        <option value="h_eqscale_ori">h_eqscale_ori</option>
                        <option value="h_eqscale_mod">h_eqscale_mod</option>
                        <option value="h_sample98">h_sample98</option>
                        <option value="h_sample09">h_sample09</option>
                        <option value="h_weight_1">h_weight_1</option>
                        <option value="h_weight_2">h_weight_2</option>
                    </select>
                --}}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingThree4">
            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4">
                <i class="flaticon2-layers-1"></i> 가구원 레벨변수
            </div>
        </div>
        <div id="collapseThree4" class="collapse" data-parent="#accordionExample4">
            <div class="card-body">
                {{--가구레벨--}}
                <div class="form-group">
                    <div class="list list-hover min-w-500px" data-inbox="list">
                        @foreach($kt_select2_4 as $item)
                            <div class="d-flex align-items-center align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" name="kt_select2_4[]" value="{{$item[0]}}" @if(in_array($item[0], old('kt_select2_4')??[])) checked="checked" @endif>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex-grow-1  mr-2 " data-toggle="view">
                                    <div class="col"><span class="font-weight-bolder mr-2 font-size-h5-sm">{{$item[0]}} </span></div>
                                    <div class="col"><span class="text-primary font-size-sm">{{$item[1]}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
    </div>

{{--가구원레벨--}}
{{--

<div class="form-group">
    <label>가구원 레벨 변수:</label>
    <list class="form-control select2" id="kt_select2_4" name="kt_select2_4[]" multiple="multiple" required>
        <option value="p_sex">p_sex</option>
        <option value="p_age">p_age</option>
        <option value="p_rel">p_rel</option>
        <option value="p_edu">p_edu</option>
        <option value="p_religion">p_religion</option>
        <option value="p_married">p_married</option>
        <option value="p_region">p_region</option>
        <option value="p_econstat">p_econstat</option>
        <option value="p_job_type">p_job_type</option>
        <option value="p_wage">p_wage</option>
        <option value="p_hours">p_hours</option>
        <option value="p_employ_type">p_employ_type</option>
        <option value="p_job_status">p_job_status</option>
        <option value="p_ind2000">p_ind2000</option>
        <option value="p_ind2007">p_ind2007</option>
        <option value="p_ind2017">p_ind2017</option>
        <option value="p_jobfam2000">p_jobfam2000</option>
        <option value="p_jobfam2007">p_jobfam2007</option>
        <option value="p_jobfam2017">p_jobfam2017</option>
        <option value="p_firm_size">p_firm_size</option>
        <option value="p_job_begin">p_job_begin</option>
        <option value="p_weight_1">p_weight_1</option>
        <option value="p_weight_2">p_weight_2</option>
        <option value="p_weight_3">p_weight_3</option>
        <option value="p_weight_4">p_weight_4</option>
        <option value="p_sample98">p_sample98</option>
        <option value="p_sample09">p_sample09</option>
        <option value=""></option>
    </list>

    <span class="form-text text-muted">멀티 선택이 가능합니다.</span>
</div>
--}}

<div class="form-group pt-6">
    <label>저장할 파일명:</label>
    <div class="form-group">
        <div class="radio-inline">
            <label class="radio">
                <input type="radio" checked="checked" name="radios3">
                <span></span>Stata</label>
            <label class="radio">
                <input type="radio" name="radios3" disabled>
                <span></span>Excel</label>
            <label class="radio">
                <input type="radio"  name="radios3" disabled>
                <span></span>CSV</label>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-12">
            <input type="text" class="form-control" placeholder="저장할 파일명을 입력하세요."/>
        </div>
       {{-- <div class="col-4 ">
            <div class="row align-items-center">
                <label class="mr-4">와이드패널</label>
                <span class="switch">
                <label>
                 <input type="checkbox" checked="checked" name="select"/>
                 <span></span>
                </label>
               </span>
            </div>
        </div>--}}
    </div>
</div>
</div>

