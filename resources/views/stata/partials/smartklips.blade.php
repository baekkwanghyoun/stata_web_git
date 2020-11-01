@php
 $kt_select2_3 = [
        "h_resid_type","h_hprice","h_region","h_hsex","h_hage","h_kidage06","h_kidage712","h_kidage1315","h_kid","h_num","h_hmarital","h_hedu","h_inc_1","h_inc_2","h_inc_3","h_inc_4","h_inc_5","h_inc_6","h_inc_total","h_incomeq","h_asset_1","h_asset_2_1","h_asset_2_2","h_asset_3_1","h_asset_3_2","h_debt_total","h_debt_pay","h_eqscale_ori","h_eqscale_mod","h_sample98","h_sample09","h_weight_1","h_weight_2"];
$kt_select2_4 = [
"p_age", "p_rel", "p_edu", "p_religion", "p_married", "p_region", "p_econstat", "p_job_type", "p_wage", "p_hours", "p_employ_type", "p_job_status", "p_ind2000", "p_ind2007", "p_ind2017", "p_jobfam2000", "p_jobfam2007", "p_jobfam2017", "p_firm_size", "p_job_begin", "p_weight_1", "p_weight_2", "p_weight_3", "p_weight_4", "p_sample98", "p_sample09",
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
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" name="kt_select2_3[]" value="{{$item}}"  @if(in_array($item, old('kt_select2_3')??[])) checked="checked" @endif>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex-grow-1  mr-2" data-toggle="view">
                                    <div class="font-weight-bolder mr-2">{{$item}}</div>
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
                            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                        <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                            <input type="checkbox" name="kt_select2_4[]" value="{{$item}}" @if(in_array($item, old('kt_select2_4')??[])) checked="checked" @endif>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex-grow-1  mr-2" data-toggle="view">
                                    <div class="font-weight-bolder mr-2">{{$item}}</div>
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

