(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[4],{"06dd":function(t,e,a){t.exports=a.p+"img/3-1.05b8e471.jpg"},2395:function(t,e,a){t.exports=a.p+"img/6.eacbd5a2.jpg"},3770:function(t,e,a){t.exports=a.p+"img/5.763f77f8.jpg"},"39d8":function(t,e,a){t.exports=a.p+"img/logo_v3.70b52ea1.png"},"3bea":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("q-page-container",[s("q-page",{staticClass:"q-pa-md  "},[s("div",{staticClass:"\t",staticStyle:{"max-width":"900px","margin-right":"auto","margin-left":"auto"}},[s("q-card",[s("q-card",{staticClass:"my-card bg-grey-9 q-mb-lg",attrs:{dark:""}},[s("q-card-section",{staticClass:"row"},[s("div",{staticClass:"col-3"},[s("a",{attrs:{href:"https://www.kli.re.kr/klips/index.do",target:"_blank"}},[s("q-img",{staticStyle:{"max-width":"140px"},attrs:{src:a("39d8")}})],1)]),s("div",{staticClass:"col-9 text-bold "},[s("span",{staticClass:"text-h5  text-bold q-mr-sm",staticStyle:{color:"#03A683"}},[t._v("'자료추출 시스템'")]),t._v("  은 사용자가 원하는 변수 및 차수를 선택 및 병합하여 원하는"),s("br"),t._v("\n                            데이터 형태로 생성하는 "),s("span",{staticClass:"text-h6 text-yellow-8 text-bold"},[t._v("'데이터추출'")]),t._v(" 시스템입니다.\n                        ")])])],1),s("q-tabs",{staticClass:"text-grey q-pa-md",attrs:{"active-color":"primary",align:"justify",dense:"","indicator-color":"primary","inline-label":"","narrow-indicator":""},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[s("q-tab",{attrs:{icon:"addchart",label:"통합 패널데이터 생성",name:"create"}}),s("q-tab",{attrs:{icon:"youtube_searched_for",label:"KLIPS 원자료 변수 검색",name:"search"}}),s("q-tab",{attrs:{icon:"contact_support",label:"사용법 및 주의사항",name:"howto"}}),s("q-tab",{attrs:{icon:"contact_support",label:"FAQ",name:"faq"}})],1),s("q-tab-panels",{staticClass:"q-pa-md",attrs:{animated:""},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},[s("q-tab-panel",{attrs:{name:"create"}},[s("q-form",{on:{submit:t.onSubmit}},[s("div",{},[s("q-list",[s("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 1")])],1),s("q-item-section",[s("div",{staticClass:"text-grey-8 q-gutter-xs"},[s("span",{},[t._v("차수선택")]),s("span",{staticClass:"text-red-14 text-weight-bold text-caption"},[t._v("(필수)")])]),t.wave.length>0?s("q-card",{staticClass:"my-card border q-mt-sm"},[s("q-card-section",{staticClass:"q-pa-sm"},[s("span",{staticClass:"  ",staticStyle:{"word-break":"break-all"}},[t._v(t._s(t.sortedWave.join("  ")))])])],1):t._e()],1)]},proxy:!0}])},[s("div",{staticClass:"row"},[s("div",{staticClass:"q-pa-sm q-ma-md bg-grey-2  rounded-borders"},[s("q-option-group",{attrs:{options:t.waveSelectOptions,color:"primary",inline:""},on:{input:function(e){return t.waveSelectChg()}},model:{value:t.waveSelect,callback:function(e){t.waveSelect=e},expression:"waveSelect"}})],1)]),s("div",{staticClass:"row"},t._l(t.waveCount,(function(e){return s("div",{staticClass:"col-12 col-sm-6 col-md-2 "},[s("q-item",{attrs:{dense:""}},[s("q-item-section",{staticClass:"itemSectionWave",attrs:{avatar:""}},[s("q-checkbox",{attrs:{val:t.waveLabel(e)},model:{value:t.wave,callback:function(e){t.wave=e},expression:"wave"}})],1),s("q-item-section",[s("q-item-label",[t._v(t._s(t.waveLabel(e))+"차수")])],1)],1)],1)})),0)]),s("q-separator",{staticClass:"q-my-lg"}),s("q-expansion-item",{staticClass:"step2-1 q-mb-lg",attrs:{icon:"house",label:"","header-class":"text-teal"},scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 2")])],1),s("q-item-section",{attrs:{color:"primary"}},[s("q-item-label",{staticClass:"text-black text-bold",attrs:{caption:""}},[t._v("가구용 또는 개인용 가공 변수를 반드시 하나 이상 선택해야 합니다.")]),s("q-item-label",[s("q-badge",{staticClass:"q-mr-sm",attrs:{color:"green-6",align:"middle"}},[t._v("1")]),t._v("\n                                                    가구용 가공 변수 선택\n                                                    "),t.kt_select2_3.length>0?s("q-badge",{staticClass:"q-ml-md",attrs:{color:"green-6",align:"middle"}},[s("q-icon",{staticClass:"q-mr-sm q-py-xs",attrs:{name:"verified_user",size:"xs"}}),t._v(" 선택완료\n                                                    ")],1):s("q-badge",{staticClass:"q-ml-md",attrs:{color:"warning",align:"middle"}},[s("q-icon",{staticClass:"q-mr-sm q-py-xs",attrs:{name:"search_off",size:"xs"}}),t._v(" 선택안함\n                                                    ")],1)],1)],1)]},proxy:!0}])},[s("q-scroll-area",{staticStyle:{height:"400px"}},[s("div",{staticClass:"row q-ma-lg"},[s("div",{staticClass:"full-width q-pa-sm q-pr-lg bg-grey-2  rounded-borders"},[s("q-option-group",{attrs:{options:t.waveSelect2Options,color:"primary",inline:""},on:{input:function(e){return t.waveSelect2Chg()}},model:{value:t.waveSelect2,callback:function(e){t.waveSelect2=e},expression:"waveSelect2"}})],1)]),t._l(t.kt_select2_3_data,(function(e,a){return s("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],key:a,attrs:{tag:"label"}},[s("q-item-section",{attrs:{avatar:""}},[s("q-checkbox",{attrs:{color:"teal","keep-color":"",val:e[0]},on:{input:function(e){return t.waveSelect2DataChg()}},model:{value:t.kt_select2_3,callback:function(e){t.kt_select2_3=e},expression:"kt_select2_3"}})],1),s("q-item-section",[s("q-item-label",[t._v(t._s(e[0]))]),s("q-item-label",{attrs:{caption:""}},[t._v(t._s(e[1]))])],1)],1)}))],2)],1),s("q-expansion-item",{staticClass:"step2-2  q-mb-lg",attrs:{icon:"family_restroom",label:"개인용 변수","header-class":"text-blue-8"},scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{staticClass:"q-ml-xl",attrs:{avatar:""}}),s("q-item-section",{staticStyle:{"margin-left":"10px"}},[s("q-item-label",[s("q-badge",{staticClass:"q-mr-sm",attrs:{color:"blue",align:"middle"}},[t._v("2")]),t._v("\n                                                    개인용 가공 변수 선택\n                                                    "),t.kt_select2_4.length>0?s("q-badge",{staticClass:"q-ml-md",attrs:{color:"green-6",align:"middle"}},[s("q-icon",{staticClass:"q-mr-sm q-py-xs",attrs:{name:"verified_user",size:"xs"}}),t._v(" 선택완료\n                                                    ")],1):s("q-badge",{staticClass:"q-ml-md",attrs:{color:"warning",align:"middle"}},[s("q-icon",{staticClass:"q-mr-sm q-py-xs",attrs:{name:"search_off",size:"xs"}}),t._v(" 선택안함\n                                                    ")],1)],1)],1)]},proxy:!0}])},[s("q-scroll-area",{staticStyle:{height:"400px"}},[s("div",{staticClass:"row q-ma-lg"},[s("div",{staticClass:"full-width q-pa-sm q-pr-lg bg-grey-2  rounded-borders"},[s("q-option-group",{attrs:{options:t.waveSelect3Options,color:"primary",inline:""},on:{input:function(e){return t.waveSelect3Chg()}},model:{value:t.waveSelect3,callback:function(e){t.waveSelect3=e},expression:"waveSelect3"}})],1)]),t._l(t.kt_select2_4_data,(function(e,a){return s("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],key:a,attrs:{tag:"label"}},[s("q-item-section",{attrs:{avatar:""}},[s("q-checkbox",{attrs:{color:"blue-8","keep-color":"",val:e[0]},on:{input:function(e){return t.waveSelect3DataChg()}},model:{value:t.kt_select2_4,callback:function(e){t.kt_select2_4=e},expression:"kt_select2_4"}})],1),s("q-item-section",[s("q-item-label",[t._v(t._s(e[0]))]),s("q-item-label",{attrs:{caption:""}},[t._v(t._s(e[1]))])],1)],1)}))],2)],1),s("q-expansion-item",{staticClass:"step2-3",attrs:{icon:"family_restroom",label:"추가 변수 입력","header-class":"text-grey-10"},scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{staticClass:"q-ml-xl",attrs:{avatar:""}}),s("q-item-section",{staticStyle:{"margin-left":"10px"}},[s("q-item-label",[s("q-badge",{staticClass:"q-mr-sm",attrs:{color:"black",align:"middle"}},[t._v("3")]),t._v("\n                                                    KLIPS 원자료 변수 추가\n                                                    "),t.add_h.length>0||t.add_p.length>0?s("q-badge",{staticClass:"q-ml-md",attrs:{color:"green-6",align:"middle"}},[s("q-icon",{staticClass:"q-mr-sm q-py-xs",attrs:{name:"verified_user",size:"xs"}}),t._v(" 선택완료\n                                                    ")],1):s("q-badge",{staticClass:"q-ml-md",attrs:{color:"warning",align:"middle"}},[s("q-icon",{staticClass:"q-mr-sm q-py-xs",attrs:{name:"search_off",size:"xs"}}),t._v(" 선택안함\n                                                    ")],1)],1)],1)]},proxy:!0}])},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-12 q-pb-lg "},[s("q-item",{staticClass:"row items-center"},[s("div",{staticClass:"col-4"},[s("q-item-section",{staticClass:"q-pl-md",attrs:{avatar:""}},[s("q-item-label",[s("span",{staticClass:"text-primary text-bold"},[t._v('"가구용"')]),t._v(" 원변수 입력")])],1)],1),s("div",{staticClass:"col-8"},[s("q-item-section",[s("q-input",{attrs:{outlined:"",dense:"",placeholder:"추가할 변수를 입력 하세요. 예1) h0141      예2) h0151 h0152"},on:{keydown:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.submit(e))}},model:{value:t.add_h,callback:function(e){t.add_h=e},expression:"add_h"}})],1)],1)]),s("q-item",{staticClass:"row items-center"},[s("div",{staticClass:"col-4"},[s("q-item-section",{staticClass:"q-pl-md",attrs:{avatar:""}},[s("q-item-label",[s("span",{staticClass:"text-primary text-bold"},[t._v('"개인용"')]),t._v(" 원변수 입력")])],1)],1),s("div",{staticClass:"col-8"},[s("q-item-section",[s("q-input",{attrs:{outlined:"",dense:"",placeholder:"추가할 변수를 입력 하세요. 예1) p0101      예2) p0201 p0202"},on:{keydown:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.submit(e))}},model:{value:t.add_p,callback:function(e){t.add_p=e},expression:"add_p"}})],1)],1)]),s("q-item-label",{staticClass:"q-pl-lg text-black text-bold",attrs:{caption:""}},[t._v(" 추가할 KLIPS 원자료 변수를 입력할 때는 변수의 6자리 숫자 중 조사차수를 의미하는 첫 2자리 숫자를 제외한 나머지 4자리 숫자만을 포함한 변수명을 입력해야 합니다. 예) h220141 -> h0141 또는 p220201 p220202 -> p0201 p0202\n                                                    ")])],1)])]),s("q-separator",{staticClass:"q-my-lg"}),s("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 3")])],1),s("q-item-section",[s("div",{staticClass:"text-grey-8 q-gutter-xs"},[s("span",{},[t._v("저장파일")]),s("span",{staticClass:"text-red-14 text-weight-bold text-caption"},[t._v("(필수)")])])])]},proxy:!0}])},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-12 "},[s("q-item",{staticClass:"row items-center"},[s("q-item-label",{staticClass:"q-mr-md"},[t._v("저장할 파일명 : ")]),s("q-input",{attrs:{outlined:"",dense:"",placeholder:"예 : save_20201220"},model:{value:t.filename,callback:function(e){t.filename=e},expression:"filename"}})],1),s("q-item",{staticClass:"row items-center"},[s("div",{staticClass:"col"},[t._v("\n                                                        파일타입 :\n                                                        "),s("q-radio",{attrs:{val:"Stata",label:"STATA(*.dta)"},model:{value:t.filesave,callback:function(e){t.filesave=e},expression:"filesave"}}),s("q-radio",{attrs:{val:"Excel",label:"Excel(*.xlsx)"},model:{value:t.filesave,callback:function(e){t.filesave=e},expression:"filesave"}}),s("q-radio",{attrs:{val:"Csv",label:"Text(*.csv)"},model:{value:t.filesave,callback:function(e){t.filesave=e},expression:"filesave"}}),s("q-radio",{attrs:{val:"Sas",label:"SAS(*.sas7bdat)",disable:""},model:{value:t.Sas,callback:function(e){t.Sas=e},expression:"Sas"}}),s("q-radio",{attrs:{val:"Spss",label:"SPSS(*.sav)",disable:""},model:{value:t.Sas,callback:function(e){t.Sas=e},expression:"Sas"}})],1)]),s("q-item-label",{staticClass:"q-pl-md q-mb-lg text-black text-bold",attrs:{caption:""}},[t._v("다른 저장 포맷은 추후 지원예정")])],1)])]),s("q-separator",{staticClass:"q-my-lg"})],1),s("div",{staticClass:"q-mb-xl"}),s("div",{staticClass:"q-mt-md row justify-end q-gutter-sm"},[s("q-btn",{attrs:{type:"submit",color:"primary",label:"데이터 추출"}}),s("q-btn",{attrs:{color:"white","text-color":"black",label:"초기화"},on:{click:function(e){return t.searchInit()}}})],1)],1)])],1),s("q-tab-panel",{attrs:{name:"search"}},[s("q-form",{attrs:{id:"frmSearch"},on:{submit:t.onSearch}},[s("div",{},[s("q-list",[s("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 1")])],1),s("q-item-section",[s("div",{staticClass:"text-grey-8 q-gutter-xs"},[s("span",{},[t._v("차수선택")]),s("span",{staticClass:"text-red-14 text-weight-bold text-caption"},[t._v("(필수)")])])])]},proxy:!0}])},[s("div",{staticClass:"row"},[s("div",{staticClass:"q-pa-md q-ma-md bg-grey-2  rounded-borders"},[s("q-option-group",{attrs:{options:t.waveSelectOptions,color:"primary",inline:""},on:{input:function(e){return t.waveSelectChg()}},model:{value:t.waveSelect,callback:function(e){t.waveSelect=e},expression:"waveSelect"}})],1)]),s("div",{staticClass:"row"},t._l(t.waveCount,(function(e){return s("div",{staticClass:"col-12 col-sm-6 col-md-2 "},[s("q-item",{attrs:{dense:""}},[s("q-item-section",{staticClass:"itemSectionWave",attrs:{avatar:""}},[s("q-checkbox",{attrs:{val:t.waveLabel(e)},model:{value:t.wave,callback:function(e){t.wave=e},expression:"wave"}})],1),s("q-item-section",[s("q-item-label",[t._v(t._s(t.waveLabel(e))+"차수")])],1)],1)],1)})),0)]),s("q-separator",{staticClass:"q-my-lg"}),s("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("STEP 2")])],1),s("q-item-section",[s("div",{staticClass:"text-grey-8 q-gutter-xs"},[s("span",{},[t._v("가구용 또는 개인용 선택")]),s("span",{staticClass:"text-red-14 text-weight-bold text-caption"},[t._v("(필수)")])])])]},proxy:!0}])},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-12 "},[s("q-item",{staticClass:"row items-center"},[s("div",{staticClass:"col-4"},[s("q-item-section",{staticClass:"q-pl-md",attrs:{avatar:""}},[s("q-option-group",{attrs:{options:t.hpOptions,color:"primary",inline:""},model:{value:t.hp,callback:function(e){t.hp=e},expression:"hp"}})],1)],1),s("div",{staticClass:"col-8"},[s("q-item-section",[s("q-input",{attrs:{outlined:"",dense:"",placeholder:"검색할 단어를 입력하세요. 예) 소득"},model:{value:t.word,callback:function(e){t.word=e},expression:"word"}})],1)],1)])],1)])]),s("q-separator",{staticClass:"q-my-lg"}),s("div",{staticClass:"q-mt-md row justify-end q-gutter-sm"},[s("q-btn",{attrs:{type:"submit",color:"primary",label:"검색하기"}}),s("q-btn",{attrs:{color:"white","text-color":"black",label:"초기화"},on:{click:t.searchInit}})],1),s("q-expansion-item",{scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"red-8","text-color":"white",icon:"star"}},[t._v("검색결과")])],1),s("q-item-section",[t._v("여기를 클릭하시면 open / close가 가능합니다.")])]},proxy:!0}]),model:{value:t.expansionSearchResult,callback:function(e){t.expansionSearchResult=e},expression:"expansionSearchResult"}},[s("div",{staticClass:"row"},[s("pre",{staticStyle:{width:"100%"},attrs:{id:"searchResult"},domProps:{innerHTML:t._s(t.searchResult)}})])])],1),s("div",{staticClass:"q-mb-xl"})],1)])],1),s("q-tab-panel",{attrs:{name:"howto"}},[s("q-list",{staticClass:"rounded-borders ",attrs:{bordered:""}},[s("q-expansion-item",{attrs:{group:"somegroup",label:""},scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("'통합 패널데이터 생성' 탭 사용법 안내")])],1)]},proxy:!0}])},[s("div",{staticClass:"q-pa-lg"},[s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" STEP 1 차수선택"),s("span",{staticClass:"text-red"},[t._v("(필수)")])],1),s("p",{staticClass:"text-body2"},[t._v("사용자가 원하는 데이터의 차수를 선택합니다.")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("69cf"),transition:"fade"}})],1)],1)],1),s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" STEP 2 가구용 / 개인용 가공변수 선택(둘 중 하나 이상 선택 "),s("span",{staticClass:"text-red"},[t._v("필수")]),t._v(")")],1),s("p",{staticClass:"text-body2"},[t._v("사용자가 원하는 가구용, 개인용 변수를 선택합니다. (둘 다 선택도 가능합니다)"),s("br"),t._v("해당 변수는 사용자가 편하게 사용할 수 있도록 KLIPS 원변수를 활용해 가공한 변수들입니다."),s("br"),t._v("만약, KLIPS 원변수를 가공 데이터에 추가하고 싶다면, 아래의 ‘STEP2 KLIPS 원자료 변수 추가’를 이용하시기 바랍니다.\n\n                                            ")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("754d"),transition:"fade"}})],1)],1)],1),s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" STEP 2 KLIPS 원변수 변수 추가(필수 아님)")],1),s("p",{staticClass:"text-body2",staticStyle:{"white-space":"pre-wrap"}},[t._v("사용자가 원하는 임의의 KLIPS 원변수를 추가하여 데이터를 생성할 수 있습니다."),s("br"),t._v("가구용, 개인용 변수를 구분하여 입력란에 넣으면 그 변수를 포함한 데이터가 생성됩니다."),s("br"),t._v("변수 입력시에는 변수의 6자리 숫자 중 조사차수를 의미하는 첫 2자리 숫자를 제외한 나머지 4자리 숫자만을 포함한 변수명을 입력해야 합니다."),s("br"),t._v("단, 변수를 여러 개 입력시 변수간에는 공백으로 구분하면 됩니다.\n                                            ")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("06dd"),transition:"fade"}})],1)],1)],1),s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" STEP3 저장파일 "),s("span",{staticClass:"text-red"},[t._v("(필수)")])],1),s("p",{staticClass:"text-body2",staticStyle:{"white-space":"pre-wrap"}},[t._v("사용자는 저장하고자 하는 파일명을 직접 입력합니다."),s("br"),t._v("저장할 파일형식은 Stata, Excel 또는 Text 중에서 선택할 수 있습니다. (다른 포맷의 데이터는 추후 업데이트 예정)")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("9c16"),transition:"fade"}})],1)],1)],1)])]),s("q-separator",{staticClass:"q-my-xs"}),s("q-expansion-item",{attrs:{group:"somegroup",label:""},scopedSlots:t._u([{key:"header",fn:function(){return[s("q-item-section",{attrs:{avatar:""}},[s("q-chip",{staticClass:"glossy",attrs:{color:"primary","text-color":"white",icon:"star"}},[t._v("'KLIPS 원자료 변수 검색' 탭 사용법 안내")])],1)]},proxy:!0}])},[s("div",{staticClass:"q-pa-lg"},[s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" STEP 1 차수선택"),s("span",{staticClass:"text-red"},[t._v("(필수)")])],1),s("p",{staticClass:"text-body2",staticStyle:{"white-space":"pre-wrap"}},[t._v("이전 “데이터생성” 탭에서 선택한 차수를 그대로 사용합니다."),s("br"),t._v("만약 차수를 변경하면 “데이터생성” 탭의 차수도 자동으로 변경됩니다.")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("69cf"),transition:"fade"}})],1)],1)],1),s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" STEP2 가구용 또는 개인용 선택"),s("span",{staticClass:"text-red"},[t._v("(필수)")])],1),s("p",{staticClass:"text-body2",staticStyle:{"white-space":"pre-wrap"}},[t._v("검색할 변수가 가구용 데이터에 있으면 “가구용”을 선택하고, 개인용 데이터에 있으면 “개인용”을 선택합니다."),s("br"),t._v("가령 “소득”이라고 입력하고 키보드의 엔터키를 누르거나 “검색하기” 버튼을 누르면 해당 차수의 원변수 중에서"),s("br"),t._v("“소득”이 포함되어 있는 모든 변수가 검색창에 나타납니다."),s("br"),s("br"),t._v("* 한 단어만 검색 가능합니다.\n                                            ")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("3770"),transition:"fade"}})],1)],1)],1),s("div",{staticClass:"q-mb-xl"},[s("p",{staticClass:"text-subtitle1 text-bold"},[s("q-icon",{attrs:{name:"star",color:"primary"}}),t._v(" 검색결과")],1),s("p",{staticClass:"text-body2",staticStyle:{"white-space":"pre-wrap"}},[t._v("STEP 1, 2의 조건을 반영한 결과가 화면에 나타납니다."),s("br"),t._v("이때 사용자는 원하는 변수명을 마우스로 복사하여 첫번째 “데이터생성” 탭의 “추가변수 입력”란에"),s("br"),t._v("붙여넣기 하여 그 변수가 포함된 데이터를 생성할 수 있습니다."),s("br"),s("br"),t._v("* 추가로 단어를 검색하여 “데이터생성” 탭 “추가변수 입력”란에 계속 추가할 수 있습니다.\n\n                                            ")]),s("q-card",{attrs:{bordered:"",flat:""}},[s("q-card-section",[s("q-img",{staticClass:"border",attrs:{bordered:"",src:a("2395"),transition:"fade"}})],1)],1)],1)])])],1)],1),s("q-tab-panel",{attrs:{name:"faq"}},[s("q-list",{staticClass:"rounded-borders ",attrs:{bordered:""}},[s("q-expansion-item",{attrs:{group:"somegroup","switch-toggle-side":"",label:"질문 1) 생성된 Stata 파일은 모든 버전에서 사용이 가능한가요?"}},[s("q-card",[s("q-card-section",{staticStyle:{"white-space":"pre-wrap"}},[t._v("Stata 버전 14 이상에서만 사용이 가능합니다.\n\nStata 13 이하 버전 사용자께서는 Excel 혹은 text 형태의 데이터를 추출한 후,\n\n해당 프로그램에서 데이터를 불러오시기 바랍니다.")])],1)],1),s("q-separator"),s("q-expansion-item",{attrs:{group:"somegroup","switch-toggle-side":"",label:"질문 2) “KLIPS 원자료 변수 검색” 탭에서 단어검색은 한 개만 가능한가요?"}},[s("q-card",[s("q-card-section",[t._v("\n                                            네, 단어는 1개씩만 검색할 수 있습니다. 그러나 반복하여 여러 개를 검색할 수 있습니다.\n                                        ")])],1)],1),s("q-separator"),s("q-expansion-item",{attrs:{group:"somegroup","switch-toggle-side":"",label:"질문 3) SAS, SPSS 사용자가 자료추출을 하고자 하면 어떻게 하나요?"}},[s("q-card",[s("q-card-section",{staticStyle:{"white-space":"pre-wrap"}},[t._v("STATA로 지정하여 dta 파일로 추출한 후 해당 프로그램의 '불러오기' 기능을 이용해 보시기 바랍니다.\n\n또는 Excel혹은 Text로 추출하면 변수리스트 파일까지 한꺼번에 추출됩니다.\n\n이 파일을 이용해 해당 통계패키지에서 데이터에 라벨을 붙이기 바랍니다.\n                                        ")])],1)],1)],1),s("div",{staticClass:"q-pt-lg  vertical-middle"},[t._v("\n                                한국노동패널조사에 대하여 문의해주세요.\n                                "),s("q-btn",{staticClass:"q-ml-lg",attrs:{target:"_blank",icon:"mail",type:"submit",color:"primary",label:"문의하기"},on:{click:function(e){return t.openURL("https://www.kli.re.kr/klips/selectBbsNttList.do?bbsNo=87&key=442")}}})],1)],1)],1)],1)],1)])],1)},i=[],r=(a("4e82"),a("b0c0"),a("4d90"),a("96cf"),a("c973")),l=a.n(r),c=a("ba17"),o=a("b06b"),n=a("f508"),d=a("4a4a"),p=a("3d20"),v=a.n(p),m={name:"PageIndex",data:function(){return{expansionSearchResult:!1,tab:"create",color:"cyan",filesave:"Stata",filename:"",wave:[],add_h:"",add_p:"",kt_select2_3:[],kt_select2_4:[],kt_select2_3_data:[["h_resid_type","주택점유형태 (1=자가, 2=전세, 3=월세, 4=기타)"],["h_hprice","소유주택시가 (단위: 만원)"],["h_region","거주지역(16개시도, 19=세종시) KLIPS 코드북참고"],["h_hsex","가구주 성별 (1=남자, 2=여자)"],["h_hage","가구주 나이"],["h_kidage06","0세~6세자녀 수"],["h_kidage712","7세~12세자녀 수"],["h_kidage1315","13세~15세자녀 수"],["h_kid","0세 ~ 고등학교 자녀 수 "],["h_num","가구원 수"],["h_hmarital","가구주 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],["h_hedu","가구주 교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=대재/중퇴 5=전문대졸, 6=대졸이상)"],["h_inc_1","이전소득(단위: 만원)"],["h_inc_2","사회보험소득(단위: 만원)"],["h_inc_3","기타소득(단위: 만원)"],["h_inc_4","근로소득(단위: 만원)"],["h_inc_5","금융소득(단위: 만원)"],["h_inc_6","부동산소득(단위: 만원)"],["h_inc_total","총소득(단위: 만원)"],["h_incomeq","소득10분위 (1=최하위 10%, 2=최하위 10%~20%...10=최상위 10%)"],["h_asset_1","금융자산(단위: 만원)"],["h_asset_2_1","부동산자산(거주주택 제외):연속형 (단위 : 만원)"],["h_asset_2_2","부동산자산(거주주택제외):범주형 (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],["h_asset_3_1","임차보증금(연속형) (단위: 만원)"],["h_asset_3_2","임차보증금(범주형) (1=1천만원 미만, 2=1천 ~ 5천만원 미만, 3=5천 ~ 1억원 미만, 4=1억 ~ 5억원 미만, 5=5억 ~10억원 미만, 6=10억 이상) "],["h_debt_total","부채총액(임대보증금 포함) (단위: 만원)"],["h_debt_pay","부채상환액 (단위: 만원/월)"],["h_eqscale_ori","OECD 가구균등화지수_original"],["h_eqscale_mod","OECD 가구균등화지수_modified"],["h_sample98","98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"],["h_sample09","09통합표본 원가구여부 (1=09통합표본 원가구, 2=09분가가구, 3=조사대상아님)"],["h_sample18","18통합표본 원가구여부 (1=18통합표본 원가구, 2=18분가가구, 3=조사대상아님)"],["h_weight98","98표본 가구 가중치"],["h_weight09","09통합표본 가구 가중치"],["h_weight18","18통합표본 가구 가중치"]],kt_select2_4_data:[["p_sex","가구원 성별 (1=남자, 2=여자)"],["p_age","가구원 나이"],["p_rel","가구주와의 관계 KLIPS 코드북 참고"],["p_edu","교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=대재/중퇴, 5=전문대졸, 6=대졸이상)"],["p_religion","종교 (1=무교, 2=불교, 3=기독교(개신교), 4=천주교, 5~10: KLIPS 코드북 참고)"],["p_married","가구원 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],["p_region","거주지역(16개시도, 19=세종시) KLIPS 코드북참고"],["p_econstat","ILO기준경제활동 (1=취업자, 2=ILO기준실업자, 3=비경제활동자)"],["p_jobtype","임금근로자 여부 (1=임금근로자, 2=비임금근로자)"],["p_wage","월평균 임금 또는 소득 (단위: 만원)"],["p_hours","주당 평균근로시간(임금근로자)"],["p_employ_type","취업형태 (1=임금근로자, 2=자영업, 3=무급가족종사자)"],["p_job_status","종사상지위 (1=상용직, 2=임시직, 3=일용직, 4=고용주/자영업자, 5=무급가족 종사자)"],["p_ind2000","업종(한국표준산업분류8차 개정:2000년 code) KLIPS 코드북 참고"],["p_ind2007","업종(한국표준산업준류 9차 개정: 2007년 code) KLIPS 코드북 참고"],["p_ind2017","업종(한국표준산업준류 10차 개정: 2017년 code) KLIPS 코드북 참고"],["p_jobfam2000","직종(한국표준직업분류 5차: 2000년 code) KLIPS 코드북 참고"],["p_jobfam2007","직종(한국표준직업분류 6차: 2007년 code) KLIPS 코드북 참고"],["p_jobfam2017","직종(한국표준직업분류 7차: 2017년 code) KLIPS 코드북 참고"],["p_firm_size","종업원규모(범주형) (1=10명미만, 2=10명~29명, 3=30명~99명, 4=100명~299명, 5=300명~499명, 6=500명이상)"],["p_job_begin","취업시기(년도와 월)"],["p_weight98_l","종단가중치(98통합표본)"],["p_weight98_c","횡단가중치(98통합표본)"],["p_weight09_l","종단가중치(09통합표본)"],["p_weight09_c","횡단가중치(09통합표본)"],["p_weight18_l","종단가중치(18통합표본)"],["p_weight18_c","횡단가중치(18통합표본)"],["p_sample98","98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"],["p_sample09","09통합표본 원가구여부 (1=09통합표본 원가구, 2=09분가가구, 3=조사대상아님)"],["p_sample18","18통합표본 원가구여부 (1=18통합표본 원가구, 2=18분가가구, 3=조사대상아님)"]],Stata:"Stata",Excel:"Excel",Csv:"Csv",Sas:"",Spss:"",waveCount:22,waveSelect:"",waveSelectOptions:[{label:"전체선택",value:"all"},{label:"최근 5개차수",value:"5"},{label:"최근 10개차수",value:"10"},{label:"전체해제",value:"none"}],waveSelect2:"",waveSelect2Options:[{label:"전체선택",value:"all"},{label:"전체해제",value:"none"}],waveSelect3:"",waveSelect3Options:[{label:"전체선택",value:"all"},{label:"전체해제",value:"none"}],searchResult:"",word:"",hp:"h",hpOptions:[{label:"가구용",value:"h"},{label:"개인용",value:"p"}]}},mounted:function(){},computed:{sortedWave:function(){function t(t,e){return t<e?-1:t>e?1:0}return this.wave.sort(t)}},methods:{openURL:o["a"],waveOrderby:function(){if(this.wave)return this.wave.sort()},waveSelectChg:function(t){if("all"===this.waveSelect){this.wave=[];for(var e=1;e<=this.waveCount;e++)this.wave.push(this.waveLabel(e))}else if("none"===this.waveSelect)this.wave=[];else if("cancel"===this.waveSelect)this.wave=[];else if("5"===this.waveSelect){this.wave=[];for(var a=this.waveCount;a>this.waveCount-5;a--)this.wave.push(this.waveLabel(a))}else if("10"===this.waveSelect){this.wave=[];for(var s=this.waveCount;s>this.waveCount-10;s--)this.wave.push(this.waveLabel(s))}},waveSelect2Chg:function(t){if("all"===this.waveSelect2){this.kt_select2_3=[];for(var e=0;e<this.kt_select2_3_data.length;e++)this.kt_select2_3.push(this.kt_select2_3_data[e][0])}else"none"===this.waveSelect2&&(this.kt_select2_3=[])},waveSelect2DataChg:function(t){this.waveSelect2=""},waveSelect3Chg:function(t){if("all"===this.waveSelect3){this.kt_select2_4=[];for(var e=0;e<this.kt_select2_4_data.length;e++)this.kt_select2_4.push(this.kt_select2_4_data[e][0])}else"none"===this.waveSelect3&&(this.kt_select2_4=[])},waveSelect3DataChg:function(t){this.waveSelect3=""},onSubmit:function(t){console.log("@submit - do something here",t),this.saveFile()},searchInit:function(){this.waveSelect2="",this.waveSelect3="",this.kt_select2_3=[],this.kt_select2_4=[],this.add_h="",this.add_p="",this.filename="",this.filesave="Stata",this.wave=!1,this.waveSelect=null,this.waveSelect="",this.expansionSearchResult=!1,this.word="",this.hp="h"},onSearch:function(t){var e=this;return l()(regeneratorRuntime.mark((function a(){var s;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return console.log("@onSearch - do something here",t),a.prev=1,n["a"].show(),a.next=5,Object(d["a"])().post("/api/stata/storeKlipsApi",{kt_select2_5:e.wave,word:e.word,hp:e.hp,tab:e.tab});case 5:s=a.sent,s.data&&(e.searchResult=s.data,e.expansionSearchResult=!0),a.next=12;break;case 9:a.prev=9,a.t0=a["catch"](1),Object(c["a"])(a.t0);case 12:return a.prev=12,n["a"].hide(),a.finish(12);case 15:case"end":return a.stop()}}),a,null,[[1,9,12,15]])})))()},saveFile:function(t,e){var a=this;return l()(regeneratorRuntime.mark((function t(){var e;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,n["a"].show(),t.prev=2,t.next=5,Object(d["a"])().post("/api/stata/storeKlipsApi",{kt_select2_5:a.wave,kt_select2_3:a.kt_select2_3,kt_select2_4:a.kt_select2_4,tab:a.tab,filesave:a.filesave,filename:a.filename,add_h:a.add_h,add_p:a.add_p});case 5:e=t.sent,t.next=11;break;case 8:t.prev=8,t.t0=t["catch"](2),Object(c["a"])(t.t0);case 11:e.data.name&&v.a.fire({title:"파일을 다운 받으시겠습니까?",text:"파일이 생성되었습니다.",icon:"success",confirmButtonColor:"",confirmButtonText:"저장하기"}).then((function(t){t.isConfirmed&&window.open("http://52.79.82.226"+e.data.name+".zip","_blank")})),t.next=17;break;case 14:t.prev=14,t.t1=t["catch"](0),Object(c["a"])(t.t1);case 17:return t.prev=17,n["a"].hide(),t.finish(17);case 20:case"end":return t.stop()}}),t,null,[[0,14,17,20],[2,8]])})))()},waveLabel:function(t){var e=String(t).padStart(2,"0");return e}}},_=m,b=(a("5b18"),a("2877")),u=a("09e3"),h=a("9989"),q=a("f09f"),f=a("a370"),x=a("0016"),w=a("068f"),g=a("429b"),C=a("7460"),S=a("adad"),y=a("823b"),k=a("0378"),P=a("1c1c"),L=a("3b73"),I=a("4074"),E=a("b047"),Q=a("9f0a"),T=a("66e5"),O=a("8f8e"),j=a("0170"),K=a("eb85"),R=a("58a81"),A=a("4983"),z=a("cb32"),D=a("27f9"),B=a("3786"),F=a("2c91"),N=a("9c40"),W=a("714f"),U=a("eebe"),J=a.n(U),G=Object(b["a"])(_,s,i,!1,null,null,null);e["default"]=G.exports;J()(G,"components",{QPageContainer:u["a"],QPage:h["a"],QCard:q["a"],QCardSection:f["a"],QIcon:x["a"],QImg:w["a"],QTabs:g["a"],QTab:C["a"],QTabPanels:S["a"],QTabPanel:y["a"],QForm:k["a"],QList:P["a"],QExpansionItem:L["a"],QItemSection:I["a"],QChip:E["a"],QOptionGroup:Q["a"],QItem:T["a"],QCheckbox:O["a"],QItemLabel:j["a"],QSeparator:K["a"],QBadge:R["a"],QScrollArea:A["a"],QAvatar:z["a"],QInput:D["a"],QRadio:B["a"],QSpace:F["a"],QBtn:N["a"]}),J()(G,"directives",{Ripple:W["a"]})},"4a4a":function(t,e,a){"use strict";var s=a("bc3a"),i=a.n(s);i.a.defaults.withCredentials=!0;var r=i.a.create({baseURL:"http://52.79.82.226"}),l=function(){var t=localStorage.getItem("token");return t&&(r.defaults.headers.common["Authorization"]="Bearer ".concat(t)),r};e["a"]=l},"5b18":function(t,e,a){"use strict";var s=a("d4a2"),i=a.n(s);i.a},"69cf":function(t,e,a){t.exports=a.p+"img/1-1.aa4d6e9b.jpg"},"754d":function(t,e,a){t.exports=a.p+"img/2-1.84a02254.jpg"},"9c16":function(t,e,a){t.exports=a.p+"img/4-1.fdf090fc.jpg"},ba17:function(t,e,a){"use strict";a("2a19");var s=a("3d20"),i=a.n(s);a("c01e");function r(t){if(422===t.response.status){var e=t.response.data.errors,a="";for(var s in e)a+="".concat(e[s],"<br>");i.a.fire({title:"Error",html:a,icon:"error"})}else i.a.fire({title:"Error",text:t.message,icon:"error"})}e["a"]=r},d4a2:function(t,e,a){}}]);