<template>
    <q-page-container>
        <q-page  class="q-pa-md  " >
            <div class="	" style="max-width: 900px; margin-right: auto;; margin-left: auto;">

                <q-card>
                    <q-card dark  class="my-card q-pa-lg " style="background-color: #233D64;background-position: right 20px top 20px;  background-repeat: no-repeat; background-size: 80px; background-image:url('./symbol.png')" >
                        <q-card-section class="row">
                            <div class="col-12 col-sm-3 q-mb-md q-mt-md"> <!--gt-sm-->
                                <a href="https://www.kli.re.kr/klips/index.do" target="_blank">
                                    <!--<q-icon class="text-white "  name="addchart"  :size="$q.screen.lt.sm?'sm':'xl'" ></q-icon>-->
                                    <q-img class="" src="~assets/logo_new.png" style="max-width: 190px" ></q-img>
                                </a>
                            </div>
                            <div class="col-9   q-pl-sm q-pl-lg-lg" >
                                <span class="text-h6  text-bold q-mr-sm" style="color: #FFFF00; ">'자료추출 시스템'</span>은 사용자가 원하는 변수 및 차수를 선택하여<br>
                                자료를 원하는 형태로 병합하여 가공하는 <span class="text-h6  text-bold" style="color: #FFFF00">시스템</span>입니다.
                                <!--병합하여  원하는 데이터 형태로 생성하는 <span class="text-h6  text-bold" style="color: #FFFF00">‘데이터추출’</span> 시스템입니다.-->
                            </div>
                        </q-card-section>
                    </q-card>
                    <q-space style="height: 10px; background-color: #233D64;" ></q-space>
                    <q-tabs active-color="white"  align="justify" class="text-grey q-px-md shadow-up-5" style="background-color: #233D64" dense indicator-color="primary" inline-label narrow-indicator v-model="tab">
                        <q-tab icon="addchart" label="통합 패널데이터 생성" name="create" class="toptab  glossy" style=""/>
                        <q-tab icon="youtube_searched_for" label="KLIPS 원자료 변수 검색" name="search"  class="toptab glossy"/>
                        <q-tab icon="contact_support" label="사용법 및 주의사항" name="howto"  class="toptab glossy"/>
                        <q-tab icon="contact_support" label="FAQ" name="faq"  class="toptab glossy"/>
                    </q-tabs>

                    <q-tab-panels class="q-pa-md" animated v-model="tab">
                        <!-- 1번째 탭 : 통합 패널데이터 생성-->
                        <q-tab-panel  name="create">
                            <q-form  @submit="onSubmit" >
                                <div class="">
                                    <q-list>
                                        <!-- 1단계 -->
                                        <q-expansion-item   ><!--default-opened expand-separator-->
                                            <template v-slot:header>
                                                <q-item-section avatar>
                                                    <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>
                                                </q-item-section>

                                                <q-item-section >
                                                    <div class="text-grey-9 q-gutter-xs">
                                                        <span class="text-weight-bolder" >차수선택</span>
                                                        <span class="text-red-14 text-weight-bolder text-caption"  >(필수)</span>
                                                        <!--<span class="q-pl-md"  >차수 : 01 ~ 21 (필수)</span>-->
                                                    </div>
                                                    <!--선택한 값 적용-->
                                                    <q-card v-if="wave.length>0" class="my-card border q-mt-sm">
                                                        <q-card-section class="q-pa-sm">
                                                            <span class="  " style="word-break: break-all" >{{sortedWave.join('&nbsp;&nbsp;')}}</span>
                                                        </q-card-section>
                                                    </q-card>
                                                </q-item-section>
                                                <!--
                                                                                             반응형 샘플
                                                                                            <div class="row full-width">
                                                                                                <q-item-section avatar class="col-12 col-sm-2 q-pb-sm">
                                                                                                    <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>
                                                                                                </q-item-section>

                                                                                                <q-item-section class="col-12 col-sm-9"  >
                                                                                                    <div class="text-grey-9 q-gutter-xs">
                                                                                                        <span class="text-weight-bolder" >차수선택</span>
                                                                                                        <span class="text-red-14 text-weight-bold text-caption"  >(필수)</span>
                                                                                                        &lt;!&ndash;<span class="q-pl-md"  >차수 : 01 ~ 21 (필수)</span>&ndash;&gt;
                                                                                                    </div>
                                                                                                    &lt;!&ndash;선택한 값 적용&ndash;&gt;
                                                                                                    <q-card v-if="wave.length>0" class="my-card border q-mt-sm">
                                                                                                        <q-card-section class="q-pa-sm">
                                                                                                            <span class="  " style="word-break: break-all" >{{sortedWave.join('&nbsp;&nbsp;')}}</span>
                                                                                                        </q-card-section>
                                                                                                    </q-card>
                                                                                                </q-item-section>
                                                                                            </div>-->
                                            </template>
                                            <div class="row">
                                                <div class="q-pa-sm q-ma-md bg-grey-2  rounded-borders">
                                                    <q-option-group @input="waveSelectChg('wave')" v-model="waveSelect" :options="waveSelectOptions" color="primary" inline/>
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
                                        <q-item>
                                            <q-item-section avatar > <!--class="bg-grey-3 q-pa-sm"-->
                                                <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 2</q-chip>
                                            </q-item-section>
                                            <q-item-section >
                                                <div class="text-grey-9 q-gutter-xs">
                                                    <span class="text-weight-bolder text-subtitle2" >가구용 또는 개인용 가공 변수를 반드시 하나 이상 선택해야 합니다.</span>
                                                </div>
                                                <!--선택한 값 적용-->
                                                <!-- <q-card v-if="kt_select2_3.length>0" class="my-card border q-mt-sm">
                                                     <q-card-section class="q-pa-sm">
                                                         <span class="  " style="word-break: break-all; color: black" >{{kt_select2_3.join('&nbsp;&nbsp;&nbsp;')}}</span>
                                                     </q-card-section>
                                                 </q-card>-->
                                            </q-item-section>
                                        </q-item>
                                        <q-expansion-item  class="step2-1 q-mb-lg" label="" header-class="text-teal">
                                            <template v-slot:header>
                                                <q-item-section avatar class="q-ml-xl">
                                                    <!--                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>-->
                                                </q-item-section>
                                                <!--                                    <q-item-section avatar>
                                                                                        <q-avatar icon="format_list_numbered_rtl" color=" " text-color="" />
                                                                                    </q-item-section>-->
                                                <q-item-section style="margin-left: 10px">
                                                    <q-item-label class="text-weight-bolder">
                                                        <q-badge color="green" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">1</q-badge>
                                                        가구용 가공 변수 선택
                                                        <q-badge v-if="kt_select2_3.length>0" class="q-ml-md" color="green-6" align="middle" >
                                                            <q-icon name="verified_user" size="xs" class=""></q-icon> 선택완료
                                                        </q-badge>
                                                        <!--privacy_tip-->
                                                        <q-badge v-else  class="q-ml-md" color="grey" align="middle" >
                                                            <q-icon name="search_off" size="xs" class=""></q-icon>선택안함
                                                        </q-badge>
                                                    </q-item-label>
                                                </q-item-section>
                                            </template>
                                            <q-scroll-area style="height: 400px;">
                                                <div class="row q-ma-lg">
                                                    <div class="full-width q-pa-sm q-pr-lg bg-grey-2  rounded-borders">
                                                        <q-option-group @input="waveSelect2Chg()" v-model="waveSelect2" :options="waveSelect2Options" color="primary" inline/>
                                                    </div>
                                                </div>

                                                <q-item v-for="(list, index) in kt_select2_3_data" :key="index" tag="label" v-ripple>
                                                    <q-item-section avatar>
                                                        <q-checkbox @input="waveSelect2DataChg()" color="teal" keep-color   v-model="kt_select2_3" :val=list[0] />
                                                    </q-item-section>
                                                    <q-item-section>
                                                        <q-item-label>{{list[0]}}</q-item-label>
                                                        <q-item-label caption>{{list[1]}}</q-item-label>
                                                    </q-item-section>
                                                </q-item>
                                            </q-scroll-area>
                                        </q-expansion-item>


                                        <!-- 2단계-2 -->
                                        <q-expansion-item  class="step2-2  q-mb-lg" icon="family_restroom" label="개인용 변수" header-class="text-blue-8" >
                                            <template v-slot:header>
                                                <q-item-section avatar class="q-ml-xl">
                                                    <!--                                        <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 1</q-chip>-->
                                                </q-item-section>
                                                <!--                                    <q-item-section avatar>
                                                                                        <q-avatar icon="format_list_numbered_rtl" color=" " text-color="" />
                                                                                    </q-item-section>-->
                                                <q-item-section style="margin-left: 10px">
                                                    <q-item-label class="text-weight-bolder" style="color: #03B0F3">
                                                        <q-badge style="background-color: #03B0F3" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">2</q-badge>
                                                        개인용 가공 변수 선택
                                                        <q-badge v-if="kt_select2_4.length>0" class="q-ml-md" color="green-6" align="middle" >
                                                            <q-icon name="verified_user" size="xs" class=""></q-icon> 선택완료
                                                        </q-badge>
                                                        <!--privacy_tip-->
                                                        <q-badge v-else  class="q-ml-md" color="grey" align="middle" >
                                                            <q-icon name="search_off" size="xs" class=""></q-icon> 선택안함
                                                        </q-badge>
                                                    </q-item-label>

                                                    <!--선택한 값 적용-->
                                                    <!--<q-card v-if="kt_select2_4.length>0" class="my-card border q-mt-sm">
                                                        <q-card-section class="q-pa-sm">
                                                            <span class="  " style="word-break: break-all; color: black" >{{kt_select2_4.join('&nbsp;&nbsp;&nbsp;')}}</span>
                                                        </q-card-section>
                                                    </q-card>-->
                                                </q-item-section>
                                            </template>
                                            <q-scroll-area style="height: 400px;">
                                                <div class="row q-ma-lg">
                                                    <div class="full-width q-pa-sm q-pr-lg bg-grey-2  rounded-borders">
                                                        <q-option-group @input="waveSelect3Chg()" v-model="waveSelect3" :options="waveSelect3Options" color="primary" inline/>
                                                    </div>
                                                </div>


                                                <q-item v-for="(list, index) in kt_select2_4_data" :key="index"  tag="label" v-ripple>
                                                    <q-item-section avatar>
                                                        <q-checkbox  @input="waveSelect3DataChg()" color="blue-8" keep-color  v-model="kt_select2_4" :val=list[0] />
                                                    </q-item-section>
                                                    <q-item-section>
                                                        <q-item-label>{{list[0]}}</q-item-label>
                                                        <q-item-label caption>{{list[1]}}</q-item-label>
                                                    </q-item-section>
                                                </q-item>
                                            </q-scroll-area>
                                        </q-expansion-item>

                                        <!-- 2단계-3 -->
                                        <q-expansion-item  class="step2-3" icon="family_restroom" label="추가 변수 입력" header-class="text-grey-10" >
                                            <template v-slot:header>
                                                <q-item-section avatar class="q-ml-xl">
                                                </q-item-section>
                                                <q-item-section style="margin-left: 10px">
                                                    <q-item-label class="text-weight-bold " style="color: #B79958" >
                                                        <q-badge style="background-color: #B79958" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">3</q-badge>
                                                        KLIPS 원자료 변수 추가
                                                        <q-badge v-if="add_h.length>0 || add_p.length>0" class="q-ml-md" color="green-6" align="middle" >
                                                            <q-icon name="verified_user" size="xs" class=""></q-icon> 선택완료
                                                        </q-badge>
                                                        <q-badge v-else class="q-ml-md" color="grey" align="middle" >
                                                            <q-icon name="search_off" size="xs" class=""></q-icon> 선택안함
                                                        </q-badge>
                                                    </q-item-label>

                                                    <!--선택한 값 적용-->
                                                    <!--
                                                    <div v-if="add_h" class="text-grey-8 q-gutter-xs q-mb-sm">
                                                        <span class="text-caption text-weight-bold " style="word-break: break-all" >가구용:{{add_h}}</span>
                                                    </div>

                                                    <div v-if="add_p" class="text-grey-8 q-gutter-xs">
                                                        <span class="text-caption text-weight-bold" style="word-break: break-all" >개인용:{{add_p}}</span>
                                                    </div>-->
                                                </q-item-section>
                                            </template>
                                            <div class="row">
                                                <div class="col-12 q-pb-lg " >
                                                    <q-item class="row items-center">
                                                        <div class="col-4">
                                                            <q-item-section avatar class="q-pl-md">
                                                                <q-item-label  ><span class="text-primary text-bold">"가구용"</span> 원변수 입력</q-item-label>
                                                            </q-item-section>
                                                        </div>
                                                        <div class="col-8">
                                                            <q-item-section>
                                                                <q-input @keydown.enter.prevent="submit" outlined dense v-model="add_h" style=""  placeholder="추가할 변수를 입력 하세요. 예1) h0141      예2) h0151 h0152"  />
                                                            </q-item-section>
                                                        </div>
                                                    </q-item>
                                                    <q-item class="row items-center">
                                                        <div class="col-4">
                                                            <q-item-section avatar class="q-pl-md">
                                                                <q-item-label  ><span class="text-primary text-bold">"개인용"</span> 원변수 입력</q-item-label>
                                                            </q-item-section>
                                                        </div>
                                                        <div class="col-8">
                                                            <q-item-section>
                                                                <q-input @keydown.enter.prevent="submit" outlined dense v-model="add_p" style=""  placeholder="추가할 변수를 입력 하세요. 예1) p0101      예2) p0201 p0202"  />
                                                            </q-item-section>
                                                        </div>
                                                    </q-item>
                                                    <q-item-label class="q-pl-lg text-black text-bold" caption> 추가할 KLIPS 원자료 변수를 입력할 때는 변수의 6자리 숫자 중 조사차수를 의미하는 첫 2자리 숫자를 제외한 나머지 4자리 숫자만을 포함한 변수명을 입력해야 합니다. 예) h220141 -> h0141 또는 p220201 p220202 -> p0201 p0202
                                                        <!--<span class="text-red text-bold">(선택사항)</span>-->
                                                    </q-item-label>
                                                    <!-- <q-item-label class="q-pl-lg" caption>- <span class="text-red text-bold">검색</span>을 통해 추가 가능</q-item-label>
                                                     <q-item-label class="q-pl-lg" caption>- <span class="text-red text-bold">코드북</span>을 통해 추가 가능</q-item-label>
                                                     <q-item-label class="q-pl-lg" caption>- Step 2에서 가구, 가구원 모두 선택했다면 Step 3도 모두 입력가능</q-item-label>-->
                                                </div>
                                            </div>
                                        </q-expansion-item>
                                        <q-separator class="q-my-lg"></q-separator>
                                        <!-- 2-1단계 원변수 -->
                                        <!--
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
                                                                <q-item-label  ><span class="text-primary text-bold">"가구용"</span> 원변수 입력</q-item-label>
                                                            </q-item-section>
                                                        </div>
                                                        <div class="col-8">
                                                            <q-item-section>
                                                                <q-input outlined dense v-model="add_h" style=""  placeholder="추가할 변수 입력"  />
                                                            </q-item-section>
                                                        </div>
                                                    </q-item>
                                                    <q-item class="row items-center">
                                                        <div class="col-4">
                                                            <q-item-section avatar class="q-pl-md">
                                                                <q-item-label  ><span class="text-primary text-bold">"개인용"</span> 원변수 입력</q-item-label>
                                                            </q-item-section>
                                                        </div>
                                                        <div class="col-8">
                                                            <q-item-section>
                                                                <q-input outlined dense v-model="add_p" style=""  placeholder="추가할 변수 입력"  />
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
                                        -->
                                        <!-- 3단계 -->
                                        <q-expansion-item   >
                                            <template v-slot:header>
                                                <q-item-section avatar>
                                                    <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 3</q-chip>
                                                </q-item-section>

                                                <q-item-section>
                                                    <div class="text-grey-9 q-gutter-xs">
                                                        <span class="text-weight-bolder"  >저장파일</span>
                                                        <span class="text-red-14 text-weight-bold text-caption"  >(필수)</span>
                                                    </div>
                                                </q-item-section>
                                            </template>
                                            <div class="row">
                                                <div class="col-12 " >
                                                    <q-item class="row items-center">
                                                        <div class="col-2">
                                                            <q-item-label class="q-mr-md">저장할 파일명 : </q-item-label>
                                                        </div>
                                                        <div class="col-10">
                                                            <q-input outlined dense v-model="filename" style="width: 300px"  placeholder="예 : save_20201220"  />
                                                        </div>
                                                    </q-item>

                                                    <q-item class="row items-center">
                                                        <div class="col-2">파일타입 :</div>
                                                        <div class="col-10 " >

                                                            <!--<label>STATA(*.dta)</label>-->

                                                            <q-radio v-model="filesave" val="Stata" label="STATA(*.dta)" />
                                                            <q-radio v-model="filesave" val="Excel" label="Excel(*.xlsx)" />
                                                            <q-radio v-model="filesave" val="Csv" label="Text(*.csv)" />
                                                            <!--<q-radio v-model="Sas" val="Sas" label="SAS(*.sas7bdat)" disable/>
                                                            <q-radio v-model="Sas" val="Spss" label="SPSS(*.sav)" disable/>-->
                                                        </div>
                                                    </q-item>
                                                    <!--
                                                                                            <q-item class="row items-center ">
                                                                                                <div class="col">
                                                                                                    변수라벨 파일 :
                                                                                                    <q-radio v-model="Stata" val="Stata" label="변수라벨(*.xlsx)" />
                                                                                                    <q-radio v-model="Excel" val="Excel" label="변수라벨(*.csv)" />
                                                                                                </div>
                                                                                                <q-space></q-space>
                                                                                            </q-item>
                                                                                            -->
                                                    <q-item-label class="q-pl-md text-black text-bold" caption>- 다른 저장 포멧(SAS, SPSS)은 추후 지원예정</q-item-label>
                                                    <!--<q-item-label class="q-pl-md text-black text-bold" caption>- STATA파일은 기본적으로 저장이 됩니다.</q-item-label>-->
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
                                    <div class="q-mt-md row justify-center q-gutter-sm">
                                        <q-btn class="glossy" type="submit" color="primary" label="데이터 추출2" />
                                        <q-btn class="glossy" @click="searchInit()"  color="white" text-color="black" label="초기화" />
                                    </div>

                                    <div class="q-pt-lg text-center">
                                        <label class="text-overline">* 자료추출시스템은 <span class="text-orange text-weight-bold">크롬</span> 또는 <span class="text-orange text-weight-bold">MS-Edge</span> 브라우저에 최적화 되어있으니, 해당 브라우져 사용을 권장합니다</label>
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

                                                <q-item-section >
                                                    <div class="text-grey-9 q-gutter-xs">
                                                        <span class="text-weight-bolder"  >차수선택</span>
                                                        <span class="text-red-14 text-weight-bold text-caption"  >(필수)</span>
                                                        <!--<span class="q-pl-md"  >차수 : 01 ~ 21 (필수)</span>-->
                                                    </div>
                                                </q-item-section>
                                            </template>
                                            <div class="row">
                                                <div class="q-pa-md q-ma-md bg-grey-2  rounded-borders">
                                                    <q-option-group @input="waveSelectChg('wave2')" v-model="waveSelect2" :options="waveSelectOptions" color="primary" inline/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-2 "  v-for="index in waveCount">
                                                    <q-item dense>
                                                        <q-item-section class="itemSectionWave" avatar>
                                                            <q-checkbox    v-model="wave2" :val=waveLabel(index) />
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

                                                <q-item-section>
                                                    <div class="text-grey-9 q-gutter-xs">
                                                        <span class="text-weight-bolder"  >가구용 또는 개인용 선택</span>
                                                        <span class="text-red-14 text-weight-bold text-caption"  >(필수)</span>
                                                    </div>
                                                </q-item-section>
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
                                                                <q-input outlined dense v-model="word" style=""  placeholder="검색할 단어를 입력하세요. 예) 소득"  />
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
                                        <!-- 제출 -->
                                        <div class="q-mt-md q-mb-xl row justify-center q-gutter-sm">
                                            <q-btn type="submit" class="glossy"  color="primary" label="검색하기" />
                                            <q-btn @click="searchInit2" class="glossy"  color="white" text-color="black" label="초기화" />
                                        </div>
                                        <q-expansion-item v-model="expansionSearchResult">
                                            <template v-slot:header>
                                                <q-item-section avatar>
                                                    <q-chip class="glossy" color="red-8" text-color="white" icon="star">검색결과</q-chip>
                                                </q-item-section>

                                                <q-item-section></q-item-section>
                                                <!--<q-item-section>여기를 클릭하시면 open / close가 가능합니다.</q-item-section>-->
                                            </template>
                                            <div class="row">
                                                <pre id="searchResult" class="" style="width: 100%" v-html="searchResult" ></pre>
                                            </div>
                                        </q-expansion-item>
                                    </q-list>
                                    <div class="q-mb-xl"></div>


                                </div>
                            </q-form>
                        </q-tab-panel>

                        <!-- 3번째 탭 : 사용법 안내 -->
                        <q-tab-panel name="howto">

                            <q-list bordered class="rounded-borders ">
                                <q-expansion-item group="somegroup"    label="">
                                    <template v-slot:header>
                                        <q-item-section avatar>
                                            <q-chip class="glossy" color="primary" text-color="white" icon="star">'통합 패널데이터 생성' 탭 사용법 안내</q-chip>
                                        </q-item-section>
                                    </template>
                                    <div class="q-pa-lg">
                                        <div class="q-mb-xl">
                                            <!--<p class="text-h5 text-bold">"통합 패널데이터 생성" 탭 사용법 안내</p>-->
                                            <p class="text-subtitle1 text-bold text-bold" ><q-icon name="star" color="primary"></q-icon> STEP 1 차수선택<span class="text-red">(필수)</span></p>
                                            <p class="text-body2">사용자가 원하는 데이터의 차수를 선택합니다.</p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/1-1.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>

                                        <div class="q-mb-xl">
                                            <p class="text-subtitle1 text-bold"><q-icon name="star" color="primary"></q-icon> STEP 2 가구용 / 개인용 가공변수 선택(둘 중 하나 이상 선택 <span class="text-red">필수</span>)</p>
                                            <p class="text-body2">사용자가 원하는
                                                <label class=" text-green" ><q-badge color="green" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">1</q-badge>
                                                    <span class="text-weight-bolder">가구용</span>
                                                </label>
                                                ,
                                                <label  style="color: #03B0F3" ><q-badge style="background-color: #03B0F3" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">2</q-badge>
                                                    <span class="text-weight-bolder">개인용</span>
                                                </label>

                                                변수를 선택합니다. (둘 다 선택도 가능합니다)<br>해당 변수는 사용자가 편하게 사용할 수 있도록 KLIPS 원변수를 활용해 가공한 변수들입니다.<br>만약, KLIPS 원변수를 가공 데이터에 추가하고 싶다면, 아래의
                                                <span>
                                                    <q-chip class="glossy" color="primary" text-color="white" icon="star">STEP 2</q-chip>
                                                    <q-badge style="background-color: black" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">3</q-badge>
                                                    <span class="text-weight-bolder">KLIPS 원자료 변수 추가</span>
                                                </span>
                                                를 이용하시기 바랍니다.

                                            </p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/2-1.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>

                                        <div class="q-mb-xl">
                                            <p class="text-subtitle1 text-bold"><q-icon name="star" color="primary"></q-icon> STEP 2 KLIPS 원변수 변수 추가(필수 아님)</p>
                                            <p class="text-body2" style="white-space: pre-wrap;">사용자가 원하는 임의의 KLIPS 원변수를 추가하여 데이터를 생성할 수 있습니다.<br>
                                                <label class=" text-green" ><q-badge color="green" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">1</q-badge>
                                                    <span class="text-weight-bolder">가구용</span>
                                                </label>, <label  style="color: #03B0F3" ><q-badge style="background-color: #03B0F3" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">2</q-badge>
                                                    <span class="text-weight-bolder">개인용</span>
                                                </label> 변수를 구분하여 입력란에 넣으면 그 변수를 포함한 데이터가 생성됩니다.<br>변수 입력시에는 변수의 6자리 숫자 중 조사차수를 의미하는 첫 2자리 숫자를 제외한 나머지 4자리 숫자만을 포함한 변수명을 입력해야 합니다.<br>단, 변수를 여러 개 입력시 변수간에는 공백으로 구분하면 됩니다.
                                            </p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/3-1.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>

                                        <div class="q-mb-xl">
                                            <p class="text-subtitle1 text-bold"><q-icon name="star" color="primary"></q-icon> STEP3 저장파일 <span class="text-red">(필수)</span></p>
                                            <p class="text-body2" style="white-space: pre-wrap;">사용자는 저장하고자 하는 파일명을 직접 입력합니다.<br>저장할 파일형식은 Stata, Excel 또는 Text 중에서 선택할 수 있습니다. (다른 포맷의 데이터는 추후 업데이트 예정)</p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/4-1.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>
                                    </div>
                                </q-expansion-item>

                                <q-separator class="q-my-xs"></q-separator>


                                <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
                                <!-- 추가 변수 검색 -->
                                <q-expansion-item group="somegroup"    label="">
                                    <template v-slot:header>
                                        <q-item-section avatar>
                                            <q-chip class="glossy" color="primary" text-color="white" icon="star">'KLIPS 원자료 변수 검색' 탭 사용법 안내</q-chip>
                                        </q-item-section>
                                    </template>

                                    <div class="q-pa-lg">
                                        <div class="q-mb-xl">
                                            <!--<p class="text-h5 text-bold">"추가변수 검색" 탭 사용법 안내</p>-->
                                            <p class="text-subtitle1 text-bold"><q-icon name="star" color="primary"></q-icon> STEP 1 차수선택<span class="text-red">(필수)</span></p>
                                            <p class="text-body2" style="white-space: pre-wrap;">이전 “데이터생성” 탭에서 선택한 차수를 그대로 사용합니다.<br>만약 차수를 변경하면 “데이터생성” 탭의 차수도 자동으로 변경됩니다.</p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/1-1.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>

                                        <div class="q-mb-xl">
                                            <p class="text-subtitle1 text-bold"><q-icon name="star" color="primary"></q-icon> STEP2 가구용 또는 개인용 선택<span class="text-red">(필수)</span></p>
                                            <p class="text-body2" style="white-space: pre-wrap;">검색할 변수가 가구용 데이터에 있으면 <label class=" text-green" ><q-badge color="green" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">1</q-badge>
                                                <span class="text-weight-bolder">가구용</span>
                                            </label> 을 선택하고, 개인용 데이터에 있으면 <label  style="color: #03B0F3" ><q-badge style="background-color: #03B0F3" align="middle" class="q-mr-sm text-weight-bolder q-py-xs q-mb-xs">2</q-badge>
                                                <span class="text-weight-bolder">개인용</span>
                                            </label> 을 선택합니다.<br>가령 “소득”이라고 입력하고 키보드의 엔터키를 누르거나 “검색하기” 버튼을 누르면 해당 차수의 원변수 중에서<br>“소득”이 포함되어 있는 모든 변수가 검색창에 나타납니다.<br><br>* 한 단어만 검색 가능합니다.
                                            </p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/5.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>

                                        <div class="q-mb-xl">
                                            <p class="text-subtitle1 text-bold"><q-icon name="star" color="primary"></q-icon> 검색결과</p>
                                            <p class="text-body2" style="white-space: pre-wrap;">STEP 1, 2의 조건을 반영한 결과가 화면에 나타납니다.<br>이때 사용자는 원하는 변수명을 마우스로 복사하여 첫번째 “데이터생성” 탭의 “추가변수 입력”란에<br>붙여넣기 하여 그 변수가 포함된 데이터를 생성할 수 있습니다.<br><br>* 추가로 단어를 검색하여 “데이터생성” 탭 “추가변수 입력”란에 계속 추가할 수 있습니다.

                                            </p>
                                            <q-card bordered  flat>
                                                <q-card-section>
                                                    <q-img bordered class="border" src="~assets/howto/6.jpg" transition="fade" />
                                                </q-card-section>
                                            </q-card>
                                        </div>
                                    </div>
                                </q-expansion-item>
                            </q-list>



                        </q-tab-panel>

                        <!-- 4번째 탭 : FAQ -->
                        <q-tab-panel name="faq">

                            <q-list bordered class="rounded-borders ">

                                <q-expansion-item group="somegroup" header-style="font-weight: bolder" switch-toggle-side  label="질문 1) 생성된 Stata 파일은 모든 버전에서 사용이 가능한가요?">
                                    <q-card>
                                        <q-card-section style="white-space: pre-wrap;">Stata 버전 14 이상에서만 사용이 가능합니다.

                                            Stata 13 이하 버전 사용자께서는 Excel 혹은 text 형태의 데이터를 추출한 후,

                                            해당 프로그램에서 데이터를 불러오시기 바랍니다.</q-card-section>
                                    </q-card>
                                </q-expansion-item>
                                <q-separator />
                                <q-expansion-item group="somegroup"  header-style="font-weight: bolder" switch-toggle-side  label='질문 2) “KLIPS 원자료 변수 검색” 탭에서 단어검색은 한 개만 가능한가요?'>
                                    <q-card>
                                        <q-card-section>
                                            네, 단어는 1개씩만 검색할 수 있습니다. 그러나 반복하여 여러 개를 검색할 수 있습니다.
                                        </q-card-section>
                                    </q-card>
                                </q-expansion-item>
                                <q-separator />
                                <q-expansion-item group="somegroup"  header-style="font-weight: bolder" switch-toggle-side  label="질문 3) SAS, SPSS 사용자가 자료추출을 하고자 하면 어떻게 하나요?">
                                    <q-card>
                                        <q-card-section style="white-space: pre-wrap;">STATA로 지정하여 dta 파일로 추출한 후 해당 프로그램의 '불러오기' 기능을 이용해 보시기 바랍니다.

                                            또는 Excel혹은 Text로 추출하면 변수리스트 파일까지 한꺼번에 추출됩니다.

                                            이 파일을 이용해 해당 통계패키지에서 데이터에 라벨을 붙이기 바랍니다.
                                        </q-card-section>
                                    </q-card>
                                </q-expansion-item>

                                <q-separator />
                                <q-expansion-item group="somegroup"  header-style="font-weight: bolder" switch-toggle-side  label="질문 4) Internet Explorer사용시 에러가 발생합니다.">
                                    <q-card>
                                        <q-card-section style="white-space: pre-wrap;">자료추출시스템은 크롬 또는 마이크로소프트 Edge 브라우저에 최적화 되어있으니,

                                            해당 브라우져 사용을 권장합니다. Internet Explorer 사용시 정상적으로 작동하지 않을 수 있습니다.
                                        </q-card-section>
                                    </q-card>
                                </q-expansion-item>
                            </q-list>
                            <div class="q-pt-lg  vertical-middle">
                                한국노동패널조사에 대하여 문의해주세요.
                                <q-btn @click="openURL('https://www.kli.re.kr/klips/selectBbsNttList.do?bbsNo=87&key=442')"  target="_blank" icon="mail"  class="q-ml-lg glossy" type="submit" color="primary" label="문의하기" />
                            </div>
                        </q-tab-panel>
                    </q-tab-panels>

                    <q-card dark  class="my-card  q-mb-sm" style="background-color: #233D64;">
                        <q-card-section class="row">
                            <div class="col-12 col-sm-3 q-mb-md ">
                                <a href="https://www.kli.re.kr/klips/index.do" target="_blank">
                                    <q-img class="" src="~assets/logo_new.png" style="max-width: 190px" ></q-img>
                                </a>
                            </div>

                            <div class="col-9 text-bold " >
                                <p class="text-caption text-bold q-mb-xs " style="">COPYRIGHT KOREA LABOR INSTITUTE.ALL RIGHTS RESERVED BY KOREA LABOR INSTITUTE.</p>
                                <p class="text-caption  q-mb-none" style=""><span class="text-bold">E-MAIL</span> : klips@kli.re.kr
                                    <span class="q-pl-xl text-bold">TEL</span> : 044-287-6651, 6652, 6653, 6654 </p>
                            </div>
                        </q-card-section>
                    </q-card>
                </q-card>
            </div>
        </q-page>
    </q-page-container>
</template>

<script>
  import exeption from 'src/store/exception'
  import {openURL} from 'quasar'
  import { Loading } from 'quasar'
  import Api from 'src/apis/Api'
  import Swal from 'sweetalert2'
  export default {
    name: 'PageIndex',
    data() {
      return {
        expansionSearchResult:false,
        tab: 'create', //'',
        color: 'cyan',
        filesave:'Stata',//['Stata'],
        filename:'',
        wave:[],
        wave2:[],
        add_h:'',
        add_p:'',
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
          ["h_sample09", "09통합표본 원가구여부 (1=09통합표본 원가구, 2=09분가가구, 3=조사대상아님)"],["h_sample18", "18통합표본 원가구여부 (1=18통합표본 원가구, 2=18분가가구, 3=조사대상아님)"],
          ["h_weight98", "98표본 가구 가중치"], ["h_weight09", "09통합표본 가구 가중치"], ["h_weight18", "18통합표본 가구 가중치"]
        ],
        kt_select2_4_data: [
          ["p_sex", "가구원 성별 (1=남자, 2=여자)"], ["p_age", "가구원 나이"], ["p_rel", "가구주와의 관계 KLIPS 코드북 참고"], ["p_edu", "교육수준 (1=무학, 2=고졸미만, 3=고졸, 4=전문대졸, 5=대졸이상)"],
          ["p_religion", "종교 (1=무교, 2=불교, 3=기독교(개신교), 4=천주교, 5~10: KLIPS 코드북 참고)"], ["p_married", "가구원 혼인상태 (1=미혼, 2=기혼유배우, 3=기혼무배우)"],
          ["p_region", "거주지역(16개시도, 19=세종시) KLIPS 코드북참고"], ["p_econstat", "ILO기준경제활동 (1=취업자, 2=ILO기준실업자, 3=비경제활동자)"], ["p_jobtype", "임금근로자 여부 (1=임금근로자, 2=비임금근로자)"],
          ["p_wage", "월평균 임금 또는 소득 (단위: 만원)"], ["p_hours", "주당 평균근로시간(임금근로자)"], ["p_employ_type", "취업형태 (1=임금근로자, 2=자영업, 3=무급가족종사자)"],
          ["p_job_status", "종사상지위 (1=상용직, 2=임시직, 3=일용직, 4=고용주/자영업자, 5=무급가족 종사자)"], ["p_ind2000", "업종(한국표준산업분류8차 개정:2000년 code) KLIPS 코드북 참고"],
          ["p_ind2007", "업종(한국표준산업준류 9차 개정: 2007년 code) KLIPS 코드북 참고"], ["p_ind2017", "업종(한국표준산업준류 10차 개정: 2017년 code) KLIPS 코드북 참고"],
          ["p_jobfam2000", "직종(한국표준직업분류 5차: 2000년 code) KLIPS 코드북 참고"], ["p_jobfam2007", "직종(한국표준직업분류 6차: 2007년 code) KLIPS 코드북 참고"],
          ["p_jobfam2017", "직종(한국표준직업분류 7차: 2017년 code) KLIPS 코드북 참고"], ["p_firm_size", "종업원규모(범주형) (1=10명미만, 2=10명~29명, 3=30명~99명, 4=100명~299명, 5=300명~499명, 6=500명이상)"],
          ["p_job_begin", "취업시기(년도와 월)"],
          ["p_weight98_l", "종단가중치(98통합표본)"],["p_weight98_c", "횡단가중치(98통합표본)"],
          ["p_weight09_l", "종단가중치(09통합표본)"],["p_weight09_c", "횡단가중치(09통합표본)"],
          ["p_weight18_l", "종단가중치(18통합표본)"],["p_weight18_c", "횡단가중치(18통합표본)"],
          ["p_sample98", "98원가구여부 (1=98표본 원가구, 2=98표본 분가가구, 3=조사대상가구 아님)"], ["p_sample09", "09통합표본 원가구여부 (1=09통합표본 원가구, 2=09분가가구, 3=조사대상아님)"],
          ["p_sample18", "18통합표본 원가구여부 (1=18통합표본 원가구, 2=18분가가구, 3=조사대상아님)"],
        ],

        Stata:'Stata',
        Excel:'Excel',
        Csv:'Csv',
        Sas:'',
        Spss:'',
        waveCount:22,
        waveSelect:'',
        waveSelect2:'',
        //waveSelectTab2:'',
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
        waveSelect2:'',
        waveSelect2Options:[
          {
            label: '전체선택',
            value: 'all'
          },
          {
            label: '전체해제',
            value: 'none'
          }
        ],

        waveSelect3:'',
        waveSelect3Options:[
          {
            label: '전체선택',
            value: 'all'
          },
          {
            label: '전체해제',
            value: 'none'
          }
        ],
        // 2번째 탭 검색
        searchResult:'',
        word:'',
        hp:'h',
        hpOptions:[ { label: '가구용', value: 'h' }, { label: '개인용', value: 'p' }],
        loadingMsg:'<b>자료추출시스템은 <span class="text-orange text-weight-bold">크롬</span> 또는 <span class="text-orange text-weight-bold">MS-Edge</span> 브라우저에 최적화 되어있으니,<br>해당 브라우져 사용을 권장합니다</b>'
      }
    },
    mounted() {
      //Loading.show({message: loadingMsg})

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
    computed: {
      sortedWave: function() {
        function compare(a, b) {
          if (a < b)
            return -1;
          if (a > b)
            return 1;
          return 0;
        }
        return this.wave.sort(compare);
      },
    },
    methods: {
      openURL,
      waveOrderby(){
        if(this.wave) {
          return this.wave.sort();
        }

      },
      waveSelectChg(wavename){
        //if(this.waveSelect==='all') {
        var selectName="";
        if(wavename === "wave") {
          selectName = 'waveSelect';
        }
        else {
          selectName = 'waveSelect2';
        }

        if(this[selectName]==='all') {
          this[wavename] = [];
          for(let i=1; i<= this.waveCount; i++) {
            this[wavename].push(this.waveLabel(i))
          }
        }
        else if(this[selectName]==='none') {
          this[wavename] = [];
        }
        else if(this[selectName]==='cancel') {
          this[wavename] = [];
        }
        else if(this[selectName]==='5') {
          this[wavename] = [];
          for(let i=this.waveCount; i> this.waveCount-5; i--) {
            this[wavename].push(this.waveLabel(i))
          }
        }
        else if(this[selectName]==='10') {
          this[wavename] = [];
          for(let i=this.waveCount; i> this.waveCount-10; i--) {
            this[wavename].push(this.waveLabel(i))
          }
        }
      },

      waveSelect2Chg(evt){
        if(this.waveSelect2==='all') {
          this.kt_select2_3 = [];
          for(let i=0; i< this.kt_select2_3_data.length; i++) {
            this.kt_select2_3.push(this.kt_select2_3_data[i][0])
          }
        }
        else if(this.waveSelect2==='none') {
          this.kt_select2_3 = [];
        }
      },
      waveSelect2DataChg(evt) {
        this.waveSelect2='';
      },
      waveSelect3Chg(evt){
        if(this.waveSelect3==='all') {
          this.kt_select2_4 = [];

          for(let i=0; i< this.kt_select2_4_data.length; i++) {
            this.kt_select2_4.push(this.kt_select2_4_data[i][0])
          }
        }
        else if(this.waveSelect3==='none') {
          this.kt_select2_4 = [];
        }
      },
      waveSelect3DataChg(evt) {
        this.waveSelect3='';
      },
      onSubmit(evt) {
        console.log('@submit - do something here', evt)
        //Notify.create({message: e.message, type: 'negative', html: true})
        this.saveFile()
      },
      searchInit(){
        this.waveSelect2=''
        this.waveSelect3=''
        this.kt_select2_3 = [];
        this.kt_select2_4 = [];
        this.add_h = '',
          this.add_p = '',
          this.filename = '',
          this.filesave = ['Stata'],
          this.wave=false;
        this.waveSelect=null;
        this.waveSelect='';
        this.expansionSearchResult=false;
      },

      searchInit2(){
        this.wave2=false
        this.waveSelect2=null;
        this.word = '';
        this.hp = 'h';
      },

      async onSearch(evt) {
        console.log('@onSearch - do something here', evt)
        //Notify.create({message: e.message, type: 'negative', html: true})

        try {
          Loading.show({message: this.loadingMsg})
          let res = await Api().post('/api/stata/storeKlipsApi', {
            kt_select2_5:this.wave2,
            word:this.word,
            hp:this.hp,
            tab:this.tab,
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
          Loading.show({message: this.loadingMsg})
          /*
                  res = await Api().post('/sanctum/token', {
                    email: p.username,
                    password: p.password,
                    provider_token:p.provider_token||'',
                    device_name: 'browser'
                  });
          */
          let res;
          try {
            res = await Api().post('/api/stata/storeKlipsApi', {
              kt_select2_5:this.wave,
              kt_select2_3:this.kt_select2_3,
              kt_select2_4:this.kt_select2_4,
              tab:this.tab,
              filesave:this.filesave,
              filename:this.filename,
              add_h:this.add_h,
              add_p:this.add_p,
            })
          }
          catch (e) {
            exeption(e)
          }

          // 성공시
          if(res.data.name) {
            //window.open(process.env.API+res.data.name+'.zip', "_blank");
            Swal.fire({
              title: '파일을 다운 받으시겠습니까?',
              /*
              html:'<a href="'+process.env.API+res.data.name+'.dta" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(48, 133, 214);">Dta 저장</a>' +
                '<a href="'+process.env.API+res.data.name+'.csv" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(0, 151, 123);">Excel 저장</a>' +
                '<a href="'+process.env.API+res.data.name+'.xlsx" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color: black;">Csv 저장</a>'+
                '<a href="'+process.env.API+res.data.name+'_v.csv" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color:#2777b0ad ;">변수라벨.csv 저장</a>'+
                '<a href="'+process.env.API+res.data.name+'_v.xlsx" target="_blank"  class="swal2-confirm swal2-styled" style="display: inline-block; background-color:#2777b0ad ;">변수라벨.xlsx 저장</a>',
              */
              text: '파일이 생성되었습니다.',
              icon: 'success',
              confirmButtonColor: '',
              confirmButtonText: '저장하기',
            }).then((result) => {
              if (result.isConfirmed) {
                window.open(process.env.API+res.data.name+'.zip', "_blank");
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
  }

</script>
<style>
    #swal2-content {
        text-align: left;
        font-size:15px;
    }

    #q-app {
        font-size: 16px;
    }
    /*    .itemSectionWave {
            padding-right: 0;
        }*/
    #searchResult{
        /*white-space: pre-wrap;*/
        /*word-break: break-all;*/
        border-radius: 8px;
        padding: 20px;
        font-weight: bold !important;
        border-style: solid;
        border-width: 1px;
        /*background-color: #18171B;*/
        line-height: 1.2em;
        font-size: 12px;
        /*color: #56DB3A;*/
        color: #343434;
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

    a:link {
        text-decoration: none;
    }

    .bg_step2{
        /*background: #e0e0e0 !important;*/
    }

    /*    .q-item.q-item-type.row.no-wrap.q-item--clickable.q-link.cursor-pointer.q-focusable.q-hoverable {
            background: #e0e0e0 !important;
        }*/
    .step2-1.q-expansion-item--expanded {
        background-color: #D8E5E4;
    }
    .step2-2.q-expansion-item--expanded {
        background-color: #E9EEF5;
    }
    .step2-3.q-expansion-item--expanded {
        background-color: #E0E0E0;
    }
    .swal2-styled.swal2-confirm {
        font-size: 1em !important;
    }
    /*    .swal2-confirm {
            display: inline-block;background-color: white;border: 1px;border-style: solid;border-color: gray;color: gray !important;
        }*/

    .toptab {
        font-weight: bold;
        background-color: #007EC5;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        margin-right:2px;
    }
    .q-tab--inactive {
        background-color: #F2F2F2;
    }
    .q-tab__label {
        font-weight: bolder;
        /*font-size: medium;*/
    }
</style>

