<template>
    <q-page-container>
    <q-page  class="q-pa-md  " >
        <div class="	" style="max-width: 900px; margin-right: auto;; margin-left: auto;">
            <q-form  @submit="onSubmit">
            <q-card>
            <q-tabs active-color="primary" align="justify" class="text-grey q-pa-md" dense indicator-color="primary" inline-label narrow-indicator v-model="tab">
                <q-tab icon="addchart" label="스마트통합 패널데이터 생성" name="create"/>
                <q-tab icon="youtube_searched_for" label="스마트 검색" name="search"/>
                <q-tab icon="library_add" label="스마트 변수 추가" name="add"/>
            </q-tabs>

            <q-tab-panels class="q-pa-md" animated v-model="tab">
                <q-tab-panel  name="create">
                    <!--<div class="text-h6">통합 패널데이터 생성</div>-->

                    <div class="">
                        <q-list>
                            <!--
                              Rendering a <label> tag (notice tag="label")
                              so QRadios will respond to clicks on QItems to
                              change Toggle state.
                            -->
                            <!--default-opened -->
                            <q-expansion-item   expand-separator icon="format_list_numbered_rtl" label="차수 : 01 ~ 21 (필수)">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-2 "  v-for="index in 21">
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

                            <q-expansion-item  expand-separator icon="house" label="가구 레벨 변수">
                                <q-item v-for="(list, index) in kt_select2_3_data" :key="index" tag="label" v-ripple>
                                    <q-item-section avatar>
                                        <q-checkbox   v-model="kt_select2_3" :val=list[0] />
                                    </q-item-section>
                                    <q-item-section>
                                        <q-item-label>{{list[0]}}</q-item-label>
                                        <q-item-label caption>{{list[1]}}</q-item-label>
                                    </q-item-section>
                                </q-item>
                            </q-expansion-item>

                            <q-expansion-item  expand-separator icon="family_restroom" label="가구원 레벨 변수">
                                <q-item v-for="(list, index) in kt_select2_4_data" :key="index"  tag="label" v-ripple>
                                    <q-item-section avatar>
                                        <q-checkbox   v-model="kt_select2_4" :val=list[0] />
                                    </q-item-section>
                                    <q-item-section>
                                        <q-item-label>{{list[0]}}</q-item-label>
                                        <q-item-label caption>{{list[1]}}</q-item-label>
                                    </q-item-section>
                                </q-item>
                            </q-expansion-item>

                        </q-list>

                        <div class="q-pl-md q-mt-md">
                            <div class="">저장할 파일명</div>
                            <div class="q-gutter-sm">
                                <q-radio v-model="filesave" val="Stata" label="Stata" />
                                <q-radio v-model="filesave" val="Excel" label="Excel" disable/>
                                <q-radio v-model="filesave" val="Csv" label="Csv" disable/>
                                <q-input outlined v-model="filename" label="Label" placeholder="저장할 파일명을 입력하세요"  />
                            </div>
                        </div>
                        <div class="q-mt-md row justify-end q-gutter-sm">
                            <q-btn type="submit" color="primary" label="제출" />
                            <q-btn color="white" text-color="black" label="취소" />
                        </div>
                    </div>
                </q-tab-panel>


                <q-tab-panel name="search">
                    <div class="text-h6">스마트 검색</div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </q-tab-panel>
                <q-tab-panel name="add">
                    <div class="text-h6">스마트 변수 추가</div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </q-tab-panel>
            </q-tab-panels>
        </q-card>
        </q-form>
        </div>
    </q-page>
    </q-page-container>
</template>

<script>
  import exeption from "src/store/exception";
  import {Loading} from 'quasar';
  import Api from "src/apis/Api"
  import Swal from 'sweetalert2'

  export default {
  name: 'PageIndex',
  data() {
    return {
      tab: 'create',
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

    }
  },
  methods: {
    onSubmit(evt) {
      console.log('@submit - do something here', evt)
      //Notify.create({message: e.message, type: 'negative', html: true})
      this.saveFile()
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
          kt_select2_4:this.kt_select2_4
        })
        // 성공시
        if(res.data.name) {
          Swal.fire({
            title: '파일을 다운 받으시겠습니까?',
            text: 'klips_final.dta가 생성되었습니다.',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '다운받기',
            cancelButtonText: '창 닫기'
          }).then((result) => {
            if (result.isConfirmed) {
              window.open(process.env.API+"/klips/klips_final.dta", "_blank");
            }
          })
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
</style>
