<template>
    <q-page-container>
    <q-page  class="q-pa-md  " >
        <div class="	" style="max-width: 900px; margin-right: auto;; margin-left: auto;">

            <q-card>
                <q-card dark  class="my-card bg-grey-9 q-mb-lg">
                    <q-card-section class="row">
                        <div class="col-1">
                            <q-icon class="text-white "  name="addchart"  :size="$q.screen.lt.sm?'sm':'xl'" />
                        </div>

                        <div class="col-11 text-bold " >
                            <span class="text-h6 text-yellow-8 text-bold">'Smart Klips'</span>는 한국노동패널 조사자료를 이용하여 연구자들이 연구분석을 위해 쉽게
                        데이터를 생성할 수 있도록 제공되는 맞춤형 “데이터추출” 지원 플랫폼입니다.
                        </div>
                    </q-card-section>
                </q-card>

            <q-tabs active-color="primary" align="justify" class="text-grey q-pa-md" dense indicator-color="primary" inline-label narrow-indicator v-model="tab">
                <q-tab icon="addchart" label="통합 패널데이터 생성" name="create"/>
                <q-tab icon="youtube_searched_for" label="추가변수 검색" name="search"/>
                <q-tab icon="contact_support" label="사용법 안내" name="add"/>
            </q-tabs>

            <q-tab-panels class="q-pa-md" animated v-model="tab">
                <!-- 1번째 탭 : 통합 패널데이터 생성-->
                <q-tab-panel  name="create">
                    <q-form  @submit="onSubmit">
                        <div class="">
                        <q-list>
                            <!-- 1단계 -->
                            <q-expansion-item   ><!--default-opened expand-separator-->
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>
                                    </q-item-section>
<!--                                    <q-item-section avatar>
                                        <q-avatar icon="format_list_numbered_rtl" color=" " text-color="" />
                                    </q-item-section>-->
                                    <q-item-section>
                                        차수 : 01 ~ 21 (필수)
                                        <q-item-label caption>차수는 통합할 패널데이터의 차수와 동일해야 합니다</q-item-label>
                                    </q-item-section>
                                </template>
                                <div class="row">
                                    <div class="q-pa-md q-ma-md bg-grey-2  rounded-borders">
                                        <q-option-group @input="waveSelectChg()" v-model="waveSelect" :options="waveSelectOptions" color="primary" inline/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-2 "  v-for="index in waveCount">
                                        <q-item dense>
                                            <q-item-section class="itemSectionWave" avatar>
                                                <q-checkbox    v-model="wave" :val=waveLabel(index) />
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{waveLabel(index)}}차수</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </div>
                                </div>
                            </q-expansion-item>
                            <q-separator class="q-my-lg"></q-separator>
                            <!-- 2단계-1 -->
                            <q-expansion-item   icon="house" label="">
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 2</q-chip>
                                    </q-item-section>
                                    <!--                                    <q-item-section avatar>
                                                                            <q-avatar icon="format_list_numbered_rtl" color=" " text-color="" />
                                                                        </q-item-section>-->
                                    <q-item-section>
                                        가구 레벨 변수
                                    </q-item-section>
                                </template>
                                <q-scroll-area style="height: 400px;">
                                    <q-item v-for="(list, index) in kt_select2_3_data" :key="index" tag="label" v-ripple>
                                        <q-item-section avatar>
                                            <q-checkbox   v-model="kt_select2_3" :val=list[0] />
                                        </q-item-section>
                                        <q-item-section>
                                            <q-item-label>{{list[0]}}</q-item-label>
                                            <q-item-label caption>{{list[1]}}</q-item-label>
                                        </q-item-section>
                                    </q-item>
                                </q-scroll-area>
                            </q-expansion-item>
                            <!-- 2단계-2 -->
                            <q-expansion-item   icon="family_restroom" label="가구원 레벨 변수">
                                <template v-slot:header>
                                    <q-item-section avatar class="q-ml-xl">
<!--                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>-->
                                    </q-item-section>
                                    <!--                                    <q-item-section avatar>
                                                                            <q-avatar icon="format_list_numbered_rtl" color=" " text-color="" />
                                                                        </q-item-section>-->
                                    <q-item-section class="" style="margin-left: 10px">
                                        가구원 레벨 변수
                                    </q-item-section>
                                </template>
                                <q-scroll-area style="height: 400px;">
                                    <q-item v-for="(list, index) in kt_select2_4_data" :key="index"  tag="label" v-ripple>
                                        <q-item-section avatar>
                                            <q-checkbox   v-model="kt_select2_4" :val=list[0] />
                                        </q-item-section>
                                        <q-item-section>
                                            <q-item-label>{{list[0]}}</q-item-label>
                                            <q-item-label caption>{{list[1]}}</q-item-label>
                                        </q-item-section>
                                    </q-item>
                                </q-scroll-area>
                            </q-expansion-item>
                            <q-separator class="q-my-lg"></q-separator>
                            <!-- 3단계 원변수 -->
                            <q-expansion-item   >
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 3</q-chip>
                                    </q-item-section>

                                    <q-item-section>원변수 입력</q-item-section>
                                </template>
                                <div class="row">
                                    <div class="col-12 " >
                                        <q-item class="row items-center">
                                            <div class="col-4">
                                                <q-item-section avatar class="q-pl-md">
                                                    <q-item-label  ><span class="text-primary text-bold">"가구"</span> 원변수 입력</q-item-label>
                                                </q-item-section>
                                            </div>
                                            <div class="col-8">
                                                <q-item-section>
                                                    <q-input outlined dense v-model="filename" style=""  placeholder="추가할 단어 입력"  />
                                                </q-item-section>
                                            </div>
                                        </q-item>
                                        <q-item class="row items-center">
                                            <div class="col-4">
                                                <q-item-section avatar class="q-pl-md">
                                                    <q-item-label  ><span class="text-primary text-bold">"가구원"</span> 원변수 입력</q-item-label>
                                                </q-item-section>
                                            </div>
                                            <div class="col-8">
                                                <q-item-section>
                                                    <q-input outlined dense v-model="filename" style=""  placeholder="추가할 단어 입력"  />
                                                </q-item-section>
                                            </div>
                                        </q-item>
                                        <q-item-label class="q-pl-lg" caption> - 원변수 추가 가능(<span class="text-red text-bold">선택사항</span>이므로 이 단계를 건너뛰어도 됨)</q-item-label>
                                        <q-item-label class="q-pl-lg" caption>- <span class="text-red text-bold">검색</span>을 통해 추가 가능</q-item-label>
                                        <q-item-label class="q-pl-lg" caption>- <span class="text-red text-bold">코드북</span>을 통해 추가 가능</q-item-label>
                                        <q-item-label class="q-pl-lg" caption>- Step 2에서 가구, 가구원 모두 선택했다면 Step 3도 모두 입력가능</q-item-label>
                                    </div>
                                </div>
                            </q-expansion-item>
                            <q-separator class="q-my-lg"></q-separator>
                            <!-- 4단계 -->
                            <q-expansion-item   >
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 4</q-chip>
                                    </q-item-section>

                                    <q-item-section>
                                        저장할 파일타입
                                        <q-item-label caption>3가지 타입중 한가지 선택</q-item-label>
                                    </q-item-section>
                                </template>
                                <div class="row">
                                    <div class="col-12 " >
                                        <q-item class="row items-center">
                                            <div class="col">
                                                <q-radio v-model="filesave" val="Stata" label="Stata" />
                                                <q-radio v-model="filesave" val="Excel" label="액셀" disable/>
                                                <q-radio v-model="filesave" val="Csv" label="텍스트" disable/>
                                            </div>
                                            <q-space></q-space>
                                            <q-item-label>저장할 파일명 : </q-item-label>
                                            <div class="q-pl-md">
                                                <q-input outlined dense v-model="filename" style=""  placeholder="예:save_20201220"  />
                                            </div>
                                        </q-item>
                                        <q-item-label class="q-pl-xl" caption>다른 저장 포맷은 추후 지원예정</q-item-label>
                                        <!-- <q-item-label icon="star" caption> - 3가지 타입중 한가지 선택</q-item-label>
     -->
                                    </div>
                                </div>
                                <!--
                                <q-item v-for="index in 21" tag="label" v-ripple>
                                    <q-item-section avatar>
                                        <q-checkbox    v-model="wave" :val=waveLabel(index) />
                                    </q-item-section>
                                    <q-item-section>
                                        <q-item-label>{{waveLabel(index)}}차수</q-item-label>
                                    </q-item-section>
                                </q-item>
                                -->
                            </q-expansion-item>
                            <q-separator class="q-my-lg"></q-separator>
                        </q-list>
                        <div class="q-mb-xl"></div>
                        <!-- 제출 -->
                        <div class="q-mt-md row justify-end q-gutter-sm">
                            <q-btn type="submit" color="primary" label="데이터 추출" />
                            <q-btn color="white" text-color="black" label="초기화" />
                        </div>
                    </div>
                    </q-form>
                </q-tab-panel>


                <!-- 2번째 탭 : 추가변수 검색 -->
                <q-tab-panel name="search" >
                    <q-form id="frmSearch"  @submit="onSearch">
                        <div class="">
                        <q-list>
                            <!-- 1단계 -->
                            <q-expansion-item   ><!--default-opened expand-separator-->
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>
                                    </q-item-section>
                                    <!--                                    <q-item-section avatar>
                                                                            <q-avatar icon="format_list_numbered_rtl" color=" " text-color="" />
                                                                        </q-item-section>-->
                                    <q-item-section>
                                        차수 : 01 ~ 21 (필수)
                                        <q-item-label caption>차수는 통합할 패널데이터의 차수와 동일해야 합니다</q-item-label>
                                    </q-item-section>
                                </template>
                                <div class="row">
                                    <div class="q-pa-md q-ma-md bg-grey-2  rounded-borders">
                                        <q-option-group @input="waveSelectChg()" v-model="waveSelect" :options="waveSelectOptions" color="primary" inline/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-2 "  v-for="index in waveCount">
                                        <q-item dense>
                                            <q-item-section class="itemSectionWave" avatar>
                                                <q-checkbox    v-model="wave" :val=waveLabel(index) />
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{waveLabel(index)}}차수</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </div>
                                </div>
                            </q-expansion-item>
                            <q-separator class="q-my-lg"></q-separator>

                            <q-expansion-item>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 2</q-chip>
                                    </q-item-section>

                                    <q-item-section>가구 또는 가구 원 선택(필수)</q-item-section>
                                </template>
                                <div class="row">
                                    <div class="col-12 " >
                                        <q-item class="row items-center">
                                            <div class="col-4">
                                                <q-item-section avatar class="q-pl-md">
                                                    <q-option-group v-model="hp" :options="hpOptions" color="primary" inline/>
                                                </q-item-section>
                                            </div>
                                            <div class="col-8">
                                                <q-item-section>
                                                    <q-input outlined dense v-model="word" style=""  placeholder="검색할 단어를 입력하세요."  />
                                                </q-item-section>
                                            </div>
                                        </q-item>
                                       <!--
                                        <q-item-label class="q-pl-lg" caption> - 원변수 추가 가능(<span class="text-red text-bold">선택사항</span>이므로 이 단계를 건너뛰어도 됨)</q-item-label>
                                        <q-item-label class="q-pl-lg" caption>- <span class="text-red text-bold">검색</span>을 통해 추가 가능</q-item-label>
                                        <q-item-label class="q-pl-lg" caption>- <span class="text-red text-bold">코드북</span>을 통해 추가 가능</q-item-label>
                                        <q-item-label class="q-pl-lg" caption>- Step 2에서 가구, 가구원 모두 선택했다면 Step 3도 모두 입력가능</q-item-label>
                                        -->
                                    </div>
                                </div>
                            </q-expansion-item>
                            <q-separator class="q-my-lg"></q-separator>
                            <q-expansion-item v-model="expansionSearchResult">
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-chip class="glossy" color="red-8" text-color="white" icon="star">검색결과</q-chip>
                                    </q-item-section>

                                    <q-item-section>여기를 클릭하시면 open / close가 가능합니다.</q-item-section>
                                </template>
                                <div class="row">
                                    <pre id="searchResult" class="" style="width: 100%" v-html="searchResult" ></pre>
                                </div>
                            </q-expansion-item>
                        </q-list>
                        <div class="q-mb-xl"></div>

                        <!-- 제출 -->
                        <div class="q-mt-md row justify-end q-gutter-sm">
                            <q-btn type="submit" color="primary" label="검색하기" />
                            <q-btn @click="searchInit" color="white" text-color="black" label="초기화" />
                        </div>
                    </div>
                    </q-form>
                </q-tab-panel>

                <!-- 3번째 탭 : 사용법 안내 -->
                <q-tab-panel name="add">
                    <div class="text-h6">스마트 변수 추가</div>
                    사용법 안내 ..들어갈 자리
                </q-tab-panel>
            </q-tab-panels>
        </q-card>
        </div>
    </q-page>
    </q-page-container>
</template>

<script>
  import exeption from 'src/store/exception'
  import { Loading } from 'quasar'
  import Api from 'src/apis/Api'
  import Swal from 'sweetalert2'

  export default {
  name: 'PageIndex',
  data() {
    return {
      expansionSearchResult:false,
      tab: 'search', //'create',
      color: 'cyan',
      filename:'',
      wave:[],

      kt_select2_3:[],
      kt_select2_4:[],
      kt_select2_3_data: [
        ["h_resid_type", '주택점유형태 (1=자가, 2=전세, 3=월세, 4=기타)'], ["h_hprice", '소유주택시가 (단위: 만원)'],
        ["h_region", "거주지역(16개시도, 19=세종시) KLIPS 코드북참고"], ["h_hsex", "가구주 성별 (1=남자, 2=여자)"], ["h_hage", "가구주 나이"], ["h_kidage06", "0세~6세자녀 수"],
        ["h_kidage712", "7세~12세자녀 수"], ["h_kidage1315", "13세~15세자녀 수"], ["h_kid", "0세 ~ 고등학교 자녀 수 "], ["h_num", "가구원 수"],
        ["h_hmarital", "가구주 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"], ["h_hedu", "가구주 교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"], ["h_inc_1", "이전소득(단위: 만원)"],
        ["h_inc_2", "사회보험소득(단위: 만원)"], ["h_inc_3", "기타소득(단위: 만원)"], ["h_inc_4", "근로소득(단위: 만원)"], ["h_inc_5", "금융소득(단위: 만원)"], ["h_inc_6", "부동산소득(단위: 만원)"],
        ["h_inc_total", "총소득(단위: 만원)"], ["h_incomeq", "소득10분위 (1=최하위 10%, 2=최하위 10%~20%...10=최상위 10%)"], ["h_asset_1", "금융자산(단위: 만원)"],
        ["h_asset_2_1", "부동산자산(거주주택 제외):연속형 (단위 : 만원)"],
        ["h_asset_2_2", "부동산자산(거주주택제외):범주형 (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],
        ["h_asset_3_1", "임차보증금(연속형) (단위: 만원)"],
        ["h_asset_3_2", "임차보증금(범주형) (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],
        ["h_debt_total", "부채총액(임대보증금 포함) (단위: 만원)"], ["h_debt_pay", "부채상환액 (단위: 만원/월)"], ["h_eqscale_ori", "OECD 가구균등화지수_original"],
        ["h_eqscale_mod", "OECD 가구균등화지수_modified"], ["h_sample98", "98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"],
        ["h_sample09", "통합표본 원가구여부 (1=통합표본 원가구, 2=통합표본 분가가구, 3=조사대상 가구 아님)"], ["h_weight_1", "98표본 가구 가중치"], ["h_weight_2", "통합표본 가구 가중치"]
      ],
      kt_select2_4_data: [
        ["p_sex", "가구원 성별 (1=남자, 2=여자)"], ["p_age", "가구원 나이"], ["p_rel", "가구주와의 관계 KLIPS 코드북 참고"], ["p_edu", "교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"],
        ["p_religion", "종교 (1=무교, 2=불교, 3=기독교(개신교), 4=천주교, 5~10: KLIPS 코드북 참고)"], ["p_married", "가구원 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],
        ["p_region", "거주지역(16개시도, 19=세종시) KLIPS 코드북참고"], ["p_econstat", "ILO기준경제활동 (1=취업자, 2=ILO기준실업자, 3=비경제활동자)"], ["p_job_type", "임금근로자 여부 (1=임금근로자, 2=비임금근로자)"],
        ["p_wage", "월평균 임금 또는 소득 (단위: 만원)"], ["p_hours", "주당 평균근로시간(임금근로자)"], ["p_employ_type", "취업형태 (1=임금근로자, 2=자영업, 3=무급가족종사자)"],
        ["p_job_status", "종사상지위 (1=상용직, 2=임시직, 3=일용직, 4=고용주/자영업자, 5=무급가족 종사자)"], ["p_ind2000", "업종(한국표준산업분류8차 개정:2000년 code) KLIPS 코드북 참고"],
        ["p_ind2007", "업종(한국표준산업준류 9차 개정: 2007년 code) KLIPS 코드북 참고"], ["p_ind2017", "업종(한국표준산업준류 10차 개정: 2017년 code) KLIPS 코드북 참고"],
        ["p_jobfam2000", "직종(한국표준직업분류 5차: 2000년 code) KLIPS 코드북 참고"], ["p_jobfam2007", "직종(한국표준직업분류 6차: 2007년 code) KLIPS 코드북 참고"],
        ["p_jobfam2017", "직종(한국표준직업분류 6차: 2017년 code) KLIPS 코드북 참고"], ["p_firm_size", "종업원규모(범주형) (1=10명미만, 2=10명~29명, 3=30명~99명, 4=100명~299명, 5=300명~499명, 6=500명이상)"],
        ["p_job_begin", "취업시기(년도와 월)"], ["p_weight_1", "종단가중치(98표본)"], ["p_weight_2", "횡단가중치(98표본)"], ["p_weight_3", "종단가중치(통합표본)"], ["p_weight_4", "횡단가중치(통합표본)"],
        ["p_sample98", "98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"], ["p_sample09", "통합표본 원가구여부 (1=통합표본 원가구, 2=통합표본 분가가구, 3=조사대상 가구 아님)"],
      ],

      filesave:'Stata',
      waveCount:21,
      waveSelect:'',
      waveSelectOptions:[
        {
          label: '전체선택',
          value: 'all'
        },
        {
          label: '최근 5개차수',
          value: '5'
        },
        {
          label: '최근 10개차수',
          value: '10'
        },
        {
          label: '전체해제',
          value: 'none'
        },
       /* {
          label: '취소',
          value: 'cancel'
        }*/
      ],
      // 2번째 탭 검색
      searchResult:'',
      word:'',
      hp:'h',
      hpOptions:[ { label: '가구', value: 'h' }, { label: '가구원', value: 'p' }]
    }
  },
mounted() {
  //document.getElementById("searchResult").innerHTML = this.test;

  /*  Swal.fire({
      title: '파일을 다운 받으시겠습니까?',
      html:'<a href="//daf.txt" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(48, 133, 214);">dta 저장</a>' +
        '<a href="//daf.txt" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(0, 151, 123);">csv 저장</a>' +
        '<a href="//daf.txt" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: black;">excel 저장</a>',
        // +'<a href="//d.txt"></a> <a href="//d.txt">csv 저장</a> <a href="//d.txt">excel 저장</a> ',
      text: 'dta가 생성되었습니다.',
      icon: 'success',
      confirmButtonColor: 'grey',
      confirmButtonText: '닫기',
    }).then((result) => {
      if (result.isConfirmed) {
        //window.open(process.env.API+res.data.name+'.dta', "_blank");
      }
    })*/
},
  methods: {
    waveSelectChg(evt){
      if(this.waveSelect==='all') {
        for(let i=0; i<= this.waveCount; i++) {
          this.wave.push(this.waveLabel(i))
        }
      }
      else if(this.waveSelect==='none') {
        this.wave = [];
      }
      else if(this.waveSelect==='cancel') {
        this.wave = [];
      }
      else if(this.waveSelect==='5') {
        this.wave = [];
        for(let i=this.waveCount; i> this.waveCount-5; i--) {
          this.wave.push(this.waveLabel(i))
        }
      }
      else if(this.waveSelect==='10') {
        this.wave = [];
        for(let i=this.waveCount; i> this.waveCount-10; i--) {
          this.wave.push(this.waveLabel(i))
        }
      }
    },
    onSubmit(evt) {
      console.log('@submit - do something here', evt)
      //Notify.create({message: e.message, type: 'negative', html: true})
      this.saveFile()
    },
    searchInit(){
      this.wave=false;
      this.waveSelect=null;
      this.waveSelect='';
      this.expansionSearchResult=false;
    },
    async onSearch(evt) {
      console.log('@onSearch - do something here', evt)
      //Notify.create({message: e.message, type: 'negative', html: true})

      try {
          Loading.show()
          let res = await Api().post('/api/stata/storeKlipsApi', {
            kt_select2_5:this.wave,
            word:this.word,
            hp:this.hp,
            tab:this.tab
          })
          // 성공시
          if(res.data) {
            //console.log(res.data);
            this.searchResult = res.data;
            this.expansionSearchResult = true;
            //document.getElementById("searchResult").innerHTML = this.searchResult;

          }
      } catch (e) {
        exeption(e)
      } finally {
        Loading.hide()
      }
    },

    async saveFile(ctx, p) {
      try {
        Loading.show()
/*
        res = await Api().post('/sanctum/token', {
          email: p.username,
          password: p.password,
          provider_token:p.provider_token||'',
          device_name: 'browser'
        });
*/
        let res = await Api().post('/api/stata/storeKlipsApi', {
          kt_select2_5:this.wave,
          kt_select2_3:this.kt_select2_3,
          kt_select2_4:this.kt_select2_4,
          tab:this.tab

        })
        // 성공시
        if(res.data.name) {
          Swal.fire({
            title: '파일을 다운 받으시겠습니까?',
            html:'<a href="'+process.env.API+res.data.name+'.dta" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(48, 133, 214);">dta 저장</a>' +
              '<a href="'+process.env.API+res.data.name+'.csv" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(0, 151, 123);">csv 저장</a>' +
              '<a href="'+process.env.API+res.data.name+'.xlsx" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: black;">excel 저장</a>',
            text: 'dta가 생성되었습니다.',
            icon: 'success',
            confirmButtonColor: 'grey',
            confirmButtonText: '닫기',
          }).then((result) => {
            if (result.isConfirmed) {
              //window.open(process.env.API+res.data.name+'.dta', "_blank");
            }
          })
         /* Swal.fire({
            title: '파일을 다운 받으시겠습니까?',
            text: 'dta가 생성되었습니다.',
            icon: 'success',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#00977b',
            denyButtonColor: '#595959',
            cancelButtonText: '닫기',
          }).then((result) => {
            if (result.isConfirmed) {
              window.open(process.env.API+res.data.name+'.dta', "_blank");
            }
          })*/
        }
        else {

        }

        debugger
      } catch (e) {
        exeption(e);
      } finally {
        Loading.hide();
      }
    },
    waveLabel(test) {
      let aa = String(test).padStart(2,'0')
      return aa
    }
  }
}</script>
<style>
/*    .itemSectionWave {
        padding-right: 0;
    }*/
    #searchResult{
        /*white-space: pre-wrap;*/
        /*word-break: break-all;*/
        border-radius: 8px;
        padding: 20px;
        font-weight: bold !important;
        background-color: #18171B;
        line-height: 1.2em;
        font-size: 12px;
        color: #56DB3A;
        font: 12px Menlo, Monaco, Consolas, monospace;
        font-style: normal;
        font-variant-ligatures: normal;
        font-variant-caps: normal;
        font-variant-numeric: normal;
        font-variant-east-asian: normal;
        font-weight: normal;
        font-stretch: normal;
        font-family: Menlo, Monaco, Consolas, monospace;
    }
</style>
