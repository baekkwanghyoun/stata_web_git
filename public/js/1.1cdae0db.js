(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[1],{8041:function(t,e,a){"use strict";var s=a("cb9a"),i=a.n(s);i.a},"8b24":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("q-page-container",[a("q-page",{staticClass:"q-pa-md  "},[a("div",{staticClass:"\t",staticStyle:{"max-width":"900px","margin-right":"auto","margin-left":"auto"}},[a("q-card",[a("q-card",{staticClass:"my-card bg-grey-9 q-mb-lg",attrs:{dark:""}},[a("q-card-section",{staticClass:"row"},[a("div",{staticClass:"col-1"},[a("q-icon",{staticClass:"text-white ",attrs:{name:"addchart",size:t.$q.screen.lt.sm?"sm":"xl"}})],1),a("div",{staticClass:"col-11 text-bold "},[a("span",{staticClass:"text-h6 text-yellow-8 text-bold"},[t._v("'Smart Klips'")]),t._v("는 한국노동패널 조사자료를 이용하여 연구자들이 연구분석을 위해 쉽게\n                        데이터를 생성할 수 있도록 제공되는 맞춤형 “데이터추출” 지원 플랫폼입니다.\n                        ")])])],1),a("q-tabs",{staticClass:"text-grey q-pa-md",attrs:{"active-color":"primary",align:"justify",dense:"","indicator-color":"primary","inline-label":"","narrow-indicator":""},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[a("q-tab",{attrs:{icon:"addchart",label:"통합 패널데이터 생성",name:"create"}}),a("q-tab",{attrs:{icon:"youtube_searched_for",label:"추가변수 검색",name:"search"}}),a("q-tab",{attrs:{icon:"contact_support",label:"사용법 안내",name:"add"}})],1),a("q-tab-panels",{staticClass:"q-pa-md",attrs:{animated:""},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[a("q-tab-panel",{attrs:{name:"create"}},[a("q-form",{on:{submit:t.onSubmit}},[a("div",{},[a("q-list",[a("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 1")])],1),a("q-item-section",[t._v("\n                                        차수 : 01 ~ 21 (필수)\n                                        "),a("q-item-label",{attrs:{caption:""}},[t._v("차수는 통합할 패널데이터의 차수와 동일해야 합니다")])],1)]},proxy:!0}])},[a("div",{staticClass:"row"},[a("div",{staticClass:"q-pa-md q-ma-md bg-grey-2  rounded-borders"},[a("q-option-group",{attrs:{options:t.waveSelectOptions,color:"primary",inline:""},on:{input:function(e){return t.waveSelectChg()}},model:{value:t.waveSelect,callback:function(e){t.waveSelect=e},expression:"waveSelect"}})],1)]),a("div",{staticClass:"row"},t._l(t.waveCount,(function(e){return a("div",{staticClass:"col-12 col-sm-6 col-md-2 "},[a("q-item",{attrs:{dense:""}},[a("q-item-section",{staticClass:"itemSectionWave",attrs:{avatar:""}},[a("q-checkbox",{attrs:{val:t.waveLabel(e)},model:{value:t.wave,callback:function(e){t.wave=e},expression:"wave"}})],1),a("q-item-section",[a("q-item-label",[t._v(t._s(t.waveLabel(e))+"차수")])],1)],1)],1)})),0)]),a("q-separator",{staticClass:"q-my-lg"}),a("q-expansion-item",{attrs:{icon:"house",label:""},scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 2")])],1),a("q-item-section",[t._v("\n                                        가구 레벨 변수\n                                    ")])]},proxy:!0}])},[a("q-scroll-area",{staticStyle:{height:"400px"}},t._l(t.kt_select2_3_data,(function(e,s){return a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],key:s,attrs:{tag:"label"}},[a("q-item-section",{attrs:{avatar:""}},[a("q-checkbox",{attrs:{val:e[0]},model:{value:t.kt_select2_3,callback:function(e){t.kt_select2_3=e},expression:"kt_select2_3"}})],1),a("q-item-section",[a("q-item-label",[t._v(t._s(e[0]))]),a("q-item-label",{attrs:{caption:""}},[t._v(t._s(e[1]))])],1)],1)})),1)],1),a("q-expansion-item",{attrs:{icon:"family_restroom",label:"가구원 레벨 변수"},scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{staticClass:"q-ml-xl",attrs:{avatar:""}}),a("q-item-section",{staticStyle:{"margin-left":"10px"}},[t._v("\n                                        가구원 레벨 변수\n                                    ")])]},proxy:!0}])},[a("q-scroll-area",{staticStyle:{height:"400px"}},t._l(t.kt_select2_4_data,(function(e,s){return a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],key:s,attrs:{tag:"label"}},[a("q-item-section",{attrs:{avatar:""}},[a("q-checkbox",{attrs:{val:e[0]},model:{value:t.kt_select2_4,callback:function(e){t.kt_select2_4=e},expression:"kt_select2_4"}})],1),a("q-item-section",[a("q-item-label",[t._v(t._s(e[0]))]),a("q-item-label",{attrs:{caption:""}},[t._v(t._s(e[1]))])],1)],1)})),1)],1),a("q-separator",{staticClass:"q-my-lg"}),a("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 3")])],1),a("q-item-section",[t._v("원변수 입력")])]},proxy:!0}])},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 "},[a("q-item",{staticClass:"row items-center"},[a("div",{staticClass:"col-4"},[a("q-item-section",{staticClass:"q-pl-md",attrs:{avatar:""}},[a("q-item-label",[a("span",{staticClass:"text-primary text-bold"},[t._v('"가구"')]),t._v(" 원변수 입력")])],1)],1),a("div",{staticClass:"col-8"},[a("q-item-section",[a("q-input",{attrs:{outlined:"",dense:"",placeholder:"추가할 단어 입력"},model:{value:t.add_h,callback:function(e){t.add_h=e},expression:"add_h"}})],1)],1)]),a("q-item",{staticClass:"row items-center"},[a("div",{staticClass:"col-4"},[a("q-item-section",{staticClass:"q-pl-md",attrs:{avatar:""}},[a("q-item-label",[a("span",{staticClass:"text-primary text-bold"},[t._v('"가구원"')]),t._v(" 원변수 입력")])],1)],1),a("div",{staticClass:"col-8"},[a("q-item-section",[a("q-input",{attrs:{outlined:"",dense:"",placeholder:"추가할 단어 입력"},model:{value:t.add_p,callback:function(e){t.add_p=e},expression:"add_p"}})],1)],1)]),a("q-item-label",{staticClass:"q-pl-lg",attrs:{caption:""}},[t._v(" - 원변수 추가 가능("),a("span",{staticClass:"text-red text-bold"},[t._v("선택사항")]),t._v("이므로 이 단계를 건너뛰어도 됨)")]),a("q-item-label",{staticClass:"q-pl-lg",attrs:{caption:""}},[t._v("- "),a("span",{staticClass:"text-red text-bold"},[t._v("검색")]),t._v("을 통해 추가 가능")]),a("q-item-label",{staticClass:"q-pl-lg",attrs:{caption:""}},[t._v("- "),a("span",{staticClass:"text-red text-bold"},[t._v("코드북")]),t._v("을 통해 추가 가능")]),a("q-item-label",{staticClass:"q-pl-lg",attrs:{caption:""}},[t._v("- Step 2에서 가구, 가구원 모두 선택했다면 Step 3도 모두 입력가능")])],1)])]),a("q-separator",{staticClass:"q-my-lg"}),a("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 4")])],1),a("q-item-section",[t._v("\n                                        저장할 파일타입\n                                        "),a("q-item-label",{attrs:{caption:""}},[t._v("3가지 타입중 한가지 선택")])],1)]},proxy:!0}])},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 "},[a("q-item",{staticClass:"row items-center"},[a("div",{staticClass:"col"},[a("q-radio",{attrs:{val:"Stata",label:"Stata"},model:{value:t.filesave,callback:function(e){t.filesave=e},expression:"filesave"}}),a("q-radio",{attrs:{val:"Excel",label:"액셀"},model:{value:t.filesave,callback:function(e){t.filesave=e},expression:"filesave"}}),a("q-radio",{attrs:{val:"Csv",label:"텍스트"},model:{value:t.filesave,callback:function(e){t.filesave=e},expression:"filesave"}})],1)]),a("q-item-label",{staticClass:"q-pl-xl",attrs:{caption:""}},[t._v("다른 저장 포맷은 추후 지원예정")])],1)])]),a("q-separator",{staticClass:"q-my-lg"})],1),a("div",{staticClass:"q-mb-xl"}),a("div",{staticClass:"q-mt-md row justify-end q-gutter-sm"},[a("q-btn",{attrs:{type:"submit",color:"primary",label:"데이터 추출"}}),a("q-btn",{attrs:{color:"white","text-color":"black",label:"초기화"}})],1)],1)])],1),a("q-tab-panel",{attrs:{name:"search"}},[a("q-form",{attrs:{id:"frmSearch"},on:{submit:t.onSearch}},[a("div",{},[a("q-list",[a("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 1")])],1),a("q-item-section",[t._v("\n                                        차수 : 01 ~ 21 (필수)\n                                        "),a("q-item-label",{attrs:{caption:""}},[t._v("차수는 통합할 패널데이터의 차수와 동일해야 합니다")])],1)]},proxy:!0}])},[a("div",{staticClass:"row"},[a("div",{staticClass:"q-pa-md q-ma-md bg-grey-2  rounded-borders"},[a("q-option-group",{attrs:{options:t.waveSelectOptions,color:"primary",inline:""},on:{input:function(e){return t.waveSelectChg()}},model:{value:t.waveSelect,callback:function(e){t.waveSelect=e},expression:"waveSelect"}})],1)]),a("div",{staticClass:"row"},t._l(t.waveCount,(function(e){return a("div",{staticClass:"col-12 col-sm-6 col-md-2 "},[a("q-item",{attrs:{dense:""}},[a("q-item-section",{staticClass:"itemSectionWave",attrs:{avatar:""}},[a("q-checkbox",{attrs:{val:t.waveLabel(e)},model:{value:t.wave,callback:function(e){t.wave=e},expression:"wave"}})],1),a("q-item-section",[a("q-item-label",[t._v(t._s(t.waveLabel(e))+"차수")])],1)],1)],1)})),0)]),a("q-separator",{staticClass:"q-my-lg"}),a("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 2")])],1),a("q-item-section",[t._v("가구 또는 가구 원 선택(필수)")])]},proxy:!0}])},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 "},[a("q-item",{staticClass:"row items-center"},[a("div",{staticClass:"col-4"},[a("q-item-section",{staticClass:"q-pl-md",attrs:{avatar:""}},[a("q-option-group",{attrs:{options:t.hpOptions,color:"primary",inline:""},model:{value:t.hp,callback:function(e){t.hp=e},expression:"hp"}})],1)],1),a("div",{staticClass:"col-8"},[a("q-item-section",[a("q-input",{attrs:{outlined:"",dense:"",placeholder:"검색할 단어를 입력하세요."},model:{value:t.word,callback:function(e){t.word=e},expression:"word"}})],1)],1)])],1)])]),a("q-separator",{staticClass:"q-my-lg"}),a("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[a("q-item-section",{attrs:{avatar:""}},[a("q-chip",{staticClass:"glossy",attrs:{color:"red-8","text-color":"white",icon:"star"}},[t._v("검색결과")])],1),a("q-item-section",[t._v("여기를 클릭하시면 open / close가 가능합니다.")])]},proxy:!0}]),model:{value:t.expansionSearchResult,callback:function(e){t.expansionSearchResult=e},expression:"expansionSearchResult"}},[a("div",{staticClass:"row"},[a("pre",{staticStyle:{width:"100%"},attrs:{id:"searchResult"},domProps:{innerHTML:t._s(t.searchResult)}})])])],1),a("div",{staticClass:"q-mb-xl"}),a("div",{staticClass:"q-mt-md row justify-end q-gutter-sm"},[a("q-btn",{attrs:{type:"submit",color:"primary",label:"검색하기"}}),a("q-btn",{attrs:{color:"white","text-color":"black",label:"초기화"},on:{click:t.searchInit}})],1)],1)])],1),a("q-tab-panel",{attrs:{name:"add"}},[a("div",{staticClass:"text-h6"},[t._v("스마트 변수 추가")]),t._v("\n                    사용법 안내 ..들어갈 자리\n                ")])],1)],1)],1)])],1)},i=[],l=(a("b0c0"),a("4d90"),a("96cf"),a("c973")),r=a.n(l),o=a("2a19");a("c01e");function c(t){if(422===t.response.status){var e=t.response.data.errors,a="";for(var s in e)a+="".concat(e[s],"<br>");o["a"].create({message:a,type:"negative",html:!0})}else o["a"].create({message:t.message,type:"negative",html:!0})}var n=c,p=a("f508"),d=a("bc3a"),v=a.n(d);v.a.defaults.withCredentials=!0;var m=v.a.create({baseURL:"http://52.79.82.226"}),_=function(){var t=localStorage.getItem("token");return t&&(m.defaults.headers.common["Authorization"]="Bearer ".concat(t)),m},h=_,u=a("3d20"),b=a.n(u),q={name:"PageIndex",data:function(){return{expansionSearchResult:!1,tab:"search",color:"cyan",filename:"",wave:[],add_h:"",add_p:"",kt_select2_3:[],kt_select2_4:[],kt_select2_3_data:[["h_resid_type","주택점유형태 (1=자가, 2=전세, 3=월세, 4=기타)"],["h_hprice","소유주택시가 (단위: 만원)"],["h_region","거주지역(16개시도, 19=세종시) KLIPS 코드북참고"],["h_hsex","가구주 성별 (1=남자, 2=여자)"],["h_hage","가구주 나이"],["h_kidage06","0세~6세자녀 수"],["h_kidage712","7세~12세자녀 수"],["h_kidage1315","13세~15세자녀 수"],["h_kid","0세 ~ 고등학교 자녀 수 "],["h_num","가구원 수"],["h_hmarital","가구주 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],["h_hedu","가구주 교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"],["h_inc_1","이전소득(단위: 만원)"],["h_inc_2","사회보험소득(단위: 만원)"],["h_inc_3","기타소득(단위: 만원)"],["h_inc_4","근로소득(단위: 만원)"],["h_inc_5","금융소득(단위: 만원)"],["h_inc_6","부동산소득(단위: 만원)"],["h_inc_total","총소득(단위: 만원)"],["h_incomeq","소득10분위 (1=최하위 10%, 2=최하위 10%~20%...10=최상위 10%)"],["h_asset_1","금융자산(단위: 만원)"],["h_asset_2_1","부동산자산(거주주택 제외):연속형 (단위 : 만원)"],["h_asset_2_2","부동산자산(거주주택제외):범주형 (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],["h_asset_3_1","임차보증금(연속형) (단위: 만원)"],["h_asset_3_2","임차보증금(범주형) (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],["h_debt_total","부채총액(임대보증금 포함) (단위: 만원)"],["h_debt_pay","부채상환액 (단위: 만원/월)"],["h_eqscale_ori","OECD 가구균등화지수_original"],["h_eqscale_mod","OECD 가구균등화지수_modified"],["h_sample98","98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"],["h_sample09","통합표본 원가구여부 (1=통합표본 원가구, 2=통합표본 분가가구, 3=조사대상 가구 아님)"],["h_weight_1","98표본 가구 가중치"],["h_weight_2","통합표본 가구 가중치"]],kt_select2_4_data:[["p_sex","가구원 성별 (1=남자, 2=여자)"],["p_age","가구원 나이"],["p_rel","가구주와의 관계 KLIPS 코드북 참고"],["p_edu","교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"],["p_religion","종교 (1=무교, 2=불교, 3=기독교(개신교), 4=천주교, 5~10: KLIPS 코드북 참고)"],["p_married","가구원 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],["p_region","거주지역(16개시도, 19=세종시) KLIPS 코드북참고"],["p_econstat","ILO기준경제활동 (1=취업자, 2=ILO기준실업자, 3=비경제활동자)"],["p_job_type","임금근로자 여부 (1=임금근로자, 2=비임금근로자)"],["p_wage","월평균 임금 또는 소득 (단위: 만원)"],["p_hours","주당 평균근로시간(임금근로자)"],["p_employ_type","취업형태 (1=임금근로자, 2=자영업, 3=무급가족종사자)"],["p_job_status","종사상지위 (1=상용직, 2=임시직, 3=일용직, 4=고용주/자영업자, 5=무급가족 종사자)"],["p_ind2000","업종(한국표준산업분류8차 개정:2000년 code) KLIPS 코드북 참고"],["p_ind2007","업종(한국표준산업준류 9차 개정: 2007년 code) KLIPS 코드북 참고"],["p_ind2017","업종(한국표준산업준류 10차 개정: 2017년 code) KLIPS 코드북 참고"],["p_jobfam2000","직종(한국표준직업분류 5차: 2000년 code) KLIPS 코드북 참고"],["p_jobfam2007","직종(한국표준직업분류 6차: 2007년 code) KLIPS 코드북 참고"],["p_jobfam2017","직종(한국표준직업분류 6차: 2017년 code) KLIPS 코드북 참고"],["p_firm_size","종업원규모(범주형) (1=10명미만, 2=10명~29명, 3=30명~99명, 4=100명~299명, 5=300명~499명, 6=500명이상)"],["p_job_begin","취업시기(년도와 월)"],["p_weight_1","종단가중치(98표본)"],["p_weight_2","횡단가중치(98표본)"],["p_weight_3","종단가중치(통합표본)"],["p_weight_4","횡단가중치(통합표본)"],["p_sample98","98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"],["p_sample09","통합표본 원가구여부 (1=통합표본 원가구, 2=통합표본 분가가구, 3=조사대상 가구 아님)"]],filesave:"Stata",waveCount:21,waveSelect:"",waveSelectOptions:[{label:"전체선택",value:"all"},{label:"최근 5개차수",value:"5"},{label:"최근 10개차수",value:"10"},{label:"전체해제",value:"none"}],searchResult:"",word:"",hp:"h",hpOptions:[{label:"가구",value:"h"},{label:"가구원",value:"p"}]}},mounted:function(){},methods:{waveSelectChg:function(t){if("all"===this.waveSelect)for(var e=0;e<=this.waveCount;e++)this.wave.push(this.waveLabel(e));else if("none"===this.waveSelect)this.wave=[];else if("cancel"===this.waveSelect)this.wave=[];else if("5"===this.waveSelect){this.wave=[];for(var a=this.waveCount;a>this.waveCount-5;a--)this.wave.push(this.waveLabel(a))}else if("10"===this.waveSelect){this.wave=[];for(var s=this.waveCount;s>this.waveCount-10;s--)this.wave.push(this.waveLabel(s))}},onSubmit:function(t){console.log("@submit - do something here",t),this.saveFile()},searchInit:function(){this.wave=!1,this.waveSelect=null,this.waveSelect="",this.expansionSearchResult=!1},onSearch:function(t){var e=this;return r()(regeneratorRuntime.mark((function a(){var s;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return console.log("@onSearch - do something here",t),a.prev=1,p["a"].show(),a.next=5,h().post("/api/stata/storeKlipsApi",{kt_select2_5:e.wave,word:e.word,hp:e.hp,tab:e.tab});case 5:s=a.sent,s.data&&(e.searchResult=s.data,e.expansionSearchResult=!0),a.next=12;break;case 9:a.prev=9,a.t0=a["catch"](1),n(a.t0);case 12:return a.prev=12,p["a"].hide(),a.finish(12);case 15:case"end":return a.stop()}}),a,null,[[1,9,12,15]])})))()},saveFile:function(t,e){var a=this;return r()(regeneratorRuntime.mark((function t(){var e;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,p["a"].show(),t.next=4,h().post("/api/stata/storeKlipsApi",{kt_select2_5:a.wave,kt_select2_3:a.kt_select2_3,kt_select2_4:a.kt_select2_4,tab:a.tab,filesave:a.filesave,add_h:a.add_h,add_p:a.add_p});case 4:e=t.sent,e.data.name&&b.a.fire({title:"파일을 다운 받으시겠습니까?",html:'<a href="http://52.79.82.226'+e.data.name+'.dta" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(48, 133, 214);">dta 저장</a><a href="http://52.79.82.226'+e.data.name+'.csv" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(0, 151, 123);">csv 저장</a><a href="http://52.79.82.226'+e.data.name+'.xlsx" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: black;">excel 저장</a>',text:"dta가 생성되었습니다.",icon:"success",confirmButtonColor:"grey",confirmButtonText:"닫기"}).then((function(t){t.isConfirmed})),t.next=11;break;case 8:t.prev=8,t.t0=t["catch"](0),n(t.t0);case 11:return t.prev=11,p["a"].hide(),t.finish(11);case 14:case"end":return t.stop()}}),t,null,[[0,8,11,14]])})))()},waveLabel:function(t){var e=String(t).padStart(2,"0");return e}}},f=q,w=(a("8041"),a("2877")),x=a("09e3"),C=a("9989"),g=a("f09f"),y=a("a370"),S=a("0016"),k=a("429b"),Q=a("7460"),L=a("adad"),I=a("823b"),P=a("0378"),R=a("1c1c"),K=a("3b73"),T=a("4074"),E=a("b047"),O=a("cb32"),j=a("0170"),A=a("9f0a"),B=a("66e5"),z=a("8f8e"),F=a("eb85"),D=a("4983"),J=a("27f9"),N=a("3786"),W=a("2c91"),$=a("9c40"),G=a("714f"),H=a("eebe"),M=a.n(H),U=Object(w["a"])(f,s,i,!1,null,null,null);e["default"]=U.exports;M()(U,"components",{QPageContainer:x["a"],QPage:C["a"],QCard:g["a"],QCardSection:y["a"],QIcon:S["a"],QTabs:k["a"],QTab:Q["a"],QTabPanels:L["a"],QTabPanel:I["a"],QForm:P["a"],QList:R["a"],QExpansionItem:K["a"],QItemSection:T["a"],QChip:E["a"],QAvatar:O["a"],QItemLabel:j["a"],QOptionGroup:A["a"],QItem:B["a"],QCheckbox:z["a"],QSeparator:F["a"],QScrollArea:D["a"],QInput:J["a"],QRadio:N["a"],QSpace:W["a"],QBtn:$["a"]}),M()(U,"directives",{Ripple:G["a"]})},cb9a:function(t,e,a){}}]);