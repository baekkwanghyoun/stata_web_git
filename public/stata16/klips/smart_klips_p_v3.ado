/*===============================================
 개인패널 만들기  
 2014-01-19
 
 2014-03-24 15차 데이터까지 업데이트 
 2014-07-19 KLI 수정사항 반영함  
 
 일자리의 고용형태, 임금 반영해야함 
 
 2015-09-03
 1차 ~ 17차 수정 작업(2015년 용역)  
 2017-06-30: 19차 업데이트 
 2018-06-29: 20차 업데이트 
 2019-10-15: 21차 업데이터 
 2019-11-09: Version 3 (21차 까지 사용)
 2020-11-06: Web버전을 위한 수정 
 2020-11-09: 22차 업데이트 
 2021-01-12: 2000년 업종 변수 수정 , 2017년 업종 변수 추가, sample18 변수 추가 
 2021-02-01: KLI 요청사항 수정 
 2021-02-02: 노동패널팀 수정 
 1) 98원가구 여부(sample98) 라벨 수정 
 2) 18통합표본 가구가중치 (h_weight18) 변수 추가
 3) 가구주의 교육수준(h_edu) 문제 수정 
 4) wave 라벨 변경
=====================================================================*/
	program define smart_klips_p_v3, rclass 
	version 14.0 
	clear 
	set more off
	syntax newvarlist(min=1 max=100 numeric generate) , [wd(string) wide website(string) ] wave(string)   
	qui cd "`wd'" 
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'
			
	qui foreach v of local v1   {

			if "`website'"=="" {
				if "`v'"=="01" | "`v'"=="12" | "`v'"=="13" | "`v'"=="14" | "`v'"=="15"| "`v'"=="16" | "`v'"=="17"| "`v'"=="18"| "`v'"=="19" | "`v'"=="20"  | "`v'"=="21" | "`v'"=="22" {
					use klips`v'p, clear
				}
				
				else if "`v'"=="02" | "`v'"=="03" | "`v'"=="04" | "`v'"=="05" | "`v'"=="06" | "`v'"=="07" | "`v'"=="08" | "`v'"=="09" | "`v'"=="10" | "`v'"=="11" {
						use klips01p, clear
						keep pid p019031
						tempfile religion
						save `religion', replace
						use klips`v'p, clear
						merge 1:1 pid using `religion'
						drop if _m==2
						drop _m 						
				}
			}			
			
			
			else {
						if "`v'"=="01" | "`v'"=="12" | "`v'"=="13" | "`v'"=="14" | "`v'"=="15"| "`v'"=="16" | "`v'"=="17" | "`v'"=="18"| "`v'"=="19" | "`v'"=="20"   | "`v'"=="21"| "`v'"=="22" {	
							use `website'/klips`v'p, clear
						}	
						
						else if "`v'"=="02" | "`v'"=="03" | "`v'"=="04" | "`v'"=="05" | "`v'"=="06" | "`v'"=="07" | "`v'"=="08" | "`v'"=="09" | "`v'"=="10" | "`v'"=="11" {
								use `website'/klips01p, clear
								keep pid p019031
								tempfile religion
								save `religion', replace
								use `website'/klips`v'p, clear
								merge 1:1 pid using `religion'
								drop if _m==2
								drop _m 								
						}							
			}
			
			drop if pid==.	
	        forvalues i=1/`NV' {			
			
						* 1번
						if "``i''"=="p_sex" {
						gen   ``i''=p`v'0101	
						label var ``i'' "성별(1=남자, 2=여자)" 
						}
						
						* 3번 
						else if "``i''"=="p_age" {
						gen   ``i''=p`v'0107
						recode ``i'' (-1=.) 
						label var ``i'' "가구원나이 " 
						}
						
						* 4번 
						else if "``i''"=="p_rel" {
						gen   ``i''=p`v'0102
						* recode ``i'' (10=1) (min/9=0) (11/300=0) (300/max=.)
						* recode ``i'' (10=1) (20=2) (1/9=0) (11/19=0) (21/max=0) (-1 9999=.)   
						recode ``i''  (-1 9999=.) 
						label var ``i'' "가구주와의 관계(코드북 참고)" 
						}						
								

/***** 노동패널팀 수정: 교육수준(p_edu) 변수 수정 *****/								
								
						* 5번 
						else if "``i''"=="p_edu" {
							recode p`v'0110 (1=.) (2=1) (3/4=2) (5=3) (6=5) (7/9=6) (-1 99=.), gen(``i'')
							tempvar bb 
							gen `bb'=p`v'0111
							replace ``i''=2 if ``i''==3 & (`bb'>1 & `bb'<9)
							replace ``i''=4 if (p`v'0110==6 | p`v'0110==7) & (`bb'>1 & `bb'<9) 				
							label var ``i'' "교육수준(1=무학. 2=고졸미만. 3=고졸, 4=대재/중퇴, 5=전문대졸 6=대졸이상)" 
						}
							
					
						
						* 6번: 종교 : 2차년도부터는 신규응답자만 
						else if "``i''"=="p_religion" {
							if "`v'"=="01" | "`v'"=="12" | "`v'"=="13" | "`v'"=="14" | "`v'"=="15"| "`v'"=="16" | "`v'"=="17"  | "`v'"=="18"| "`v'"=="19" | "`v'"=="20"| "`v'"=="21"  | "`v'"=="22" {
								gen ``i''=p`v'9031 
								recode ``i'' (-1 99=.)  
							}
							
							else if "`v'"=="02" | "`v'"=="03" | "`v'"=="04" | "`v'"=="05" | "`v'"=="06" | "`v'"=="07" | "`v'"=="08" | "`v'"=="09" | "`v'"=="10" | "`v'"=="11" {
								gen ``i''=p`v'9031 if p`v'9031~=. 
								replace ``i''=p019031 if p`v'9031==.
								recode ``i''  (-1 99=.)
							}												
							label var ``i'' "종교(1=무교 2=불교, 3=기독교(개신교) 4=천주교 5~10=KLIPS 자체 코드북 참고)" 
						}	
											
																
						* 7번 : 결혼여부 
						else if "``i''"=="p_married" {
						gen   ``i''=p`v'5501  
						mvdecode ``i'' , mv(-1 9=.) 
						recode ``i'' (1=1) (2=2) (3/5=3)  
						label var ``i'' "가구원혼인상태(1=미혼 2=유배우자 3=무배우자)"
						}
						
						* 8번 : 거주지역 
						else if "``i''"=="p_region" {
						gen   ``i''=p`v'0121
						label var ``i'' " 거주지역(코드북 참고)  "
						}
						
						/*=====================================================================================*/
						else if "``i''"=="p_econstat" {
						gen   ``i''=3
						replace ``i''=1 if p`v'0201==1
						replace ``i''=2 if p`v'2801==1 & p`v'2806==1
						label var ``i'' "ILO기준경제활동(1=취업자 2=ILO 기준 실업자 3=비경제활동자)"
						}
						
											
						* 1번 
						else if "``i''"=="p_jobtype" {
						gen   ``i''=jobtype
						label var ``i'' "1=임금 2=비임금근로자 "
						}						
						
						* 2번 : 월평균 임금 
						else if "``i''"=="p_wage" {						
						mvdecode p`v'1642 p`v'1672 , mv(-1 9999 999999=.) 
						gen   ``i''=p`v'1642 if jobtype==1 
						replace ``i''=p`v'1672 if jobtype==2
						label var ``i'' "월평균 임금(소득): 자영업자는 소득, 단위: 만원" 
						}
												
						* 16번 : 주당근로시간  : 임금 근로자 
						else if "``i''"=="p_hours" {
						gen   ``i''=p`v'1004 if jobtype==1 & p`v'1003==2
						replace ``i''=p`v'1006 if jobtype==1 & p`v'1003==1
						
						replace ``i''=p`v'1031 if jobtype==2 
						mvdecode ``i'' , mv(-1 999 99=.) 
						label var ``i'' "주당 평균근로시간"  
						}
											
						* 9번 : 취업형태  
						else if "``i''"=="p_employ_type" {
						gen   ``i''=p`v'0211
						mvdecode ``i'' , mv(-1=.) 
						label var ``i'' "1=임금근로자 2=자영업 3=무급가족종사자"
						}
						
						* 12번 :종사상지위 
						else if "``i''"=="p_job_status" {
						gen   ``i''=p`v'0314
						mvdecode ``i'' , mv(-1 9=.) 
						label var ``i'' "종사상 지위(1=상용직 2=임시직 3=일용직 4=고용주/자영업자 5=무급가족 종사자)"
						}
																					
						* 11번 : 업종  
						else if "``i''"=="p_ind2000" {			
							gen ``i''=p`v'0340   // 2021-01-12 수정 							
							mvdecode ``i'' , mv(-1 999=.) 
							label var ``i'' "업종(2000): 2000년 분류 , 코드북 참고  " 
						}	
						
						else if "``i''"=="p_ind2007" {	
						    if  "`v'"=="12" | "`v'"=="13" |"`v'"=="14" |"`v'"=="15"|"`v'"=="16" |"`v'"=="17"| "`v'"=="18"| "`v'"=="19" | "`v'"=="20" | "`v'"=="21"| "`v'"=="22"    {   
								gen ``i''=p`v'0341						
								mvdecode ``i'' , mv(-1 999=.) 
							}
							else {
								gen ``i''=.	
							}						
							
							label var ``i'' "업종(2007): 2007년 분류, 코드북 참고  " 
						}
						
						else if "``i''"=="p_ind2017" {	
						    if  "`v'"=="12" | "`v'"=="13" |"`v'"=="14" |"`v'"=="15"|"`v'"=="16" |"`v'"=="17"| "`v'"=="18"| "`v'"=="19" | "`v'"=="20" | "`v'"=="21"| "`v'"=="22"    {   
								gen ``i''=p`v'0342						
								mvdecode ``i'' , mv(-1 999=.) 
							}
							else {
								gen ``i''=.	
							}						
							
							label var ``i'' "업종(2017): 2017년 분류, 코드북 참고  " 
						}
						
						
						* 직종 
						else if "``i''"=="p_jobfam2000" {			
							gen ``i''=p`v'0350							
							mvdecode ``i'' , mv(-1 999=.) 
							label var ``i'' "직종(2000): 2000년 분류, 코드북 참고  " 
						}	
						
						else if "``i''"=="p_jobfam2007" {			
							if  "`v'"=="12" | "`v'"=="13" |"`v'"=="14" |"`v'"=="15"|"`v'"=="16" |"`v'"=="17"| "`v'"=="18"| "`v'"=="19" | "`v'"=="20"| "`v'"=="21"  | "`v'"=="22"  {   
								gen ``i''=p`v'0351						
								mvdecode ``i'' , mv(-1 999=.) 
							}
							else {
								gen ``i''=.	
							}
							label var ``i'' "직종(2007): 2007년분류, 코드북 참고 " 
						}
						
						else if "``i''"=="p_jobfam2017" {			
							if  "`v'"=="12" | "`v'"=="13" |"`v'"=="14" |"`v'"=="15"|"`v'"=="16" |"`v'"=="17"| "`v'"=="18"| "`v'"=="19" | "`v'"=="20"| "`v'"=="21"  | "`v'"=="22"  {   
								gen ``i''=p`v'0352						
								mvdecode ``i'' , mv(-1 999=.) 
							}
							else {
								gen ``i''=.	
							}
							label var ``i'' "직종(2017): 2017년분류, 코드북 참고 " 
						}
						
						
						* 15번 : 종업원규모 
						else if "``i''"=="p_firm_size" {
						tempvar size1 size2 
						gen `size1'=p`v'0402 
						mvdecode `size1', mv(-1 999999=.) 
						gen `size2'=p`v'0403 if `size1'==. 
						mvdecode `size2', mv(-1 99 11=.) 
						recode `size2' (1=3 ) (2=7 ) (3=20 ) (4=40 ) (5=60 ) (6=80 ) (7=200 ) (8=300 ) (9=750 ) (10=1000 ) 
						egen   ``i''=rowtotal(`size1' `size2'), miss 
						recode ``i'' (1/9=1) (10/29=2) (30/99=3) (100/299=4)  (300/499=5) (500/max=6)
						label var ``i'' "종업원규모(범주형) 1=10명 미만 2=10명~29명 3=30명~99명 4=100명~299명 5=300명~499명 6=500명 이상"
						}
						
						* 10번 : 취업시기 
						else if "``i''"=="p_job_begin" {
							tempvar year month
							gen `year'=p`v'0301
							gen `month'=p`v'0302
							mvdecode `month' `year', mv(-1 9999 99=.) 
							replace `month'=6 if `month'==. & `year'~=. 
							gen  ``i''=ym(`year',`month') if `year'~=. & `month'~=.
							format ``i'' %tm 
							label var ``i'' " 취업시기(년도와 월)" 
						}
						/*================================================*/
						else if "``i''"=="p_weight98_l" {	
						
							if "`v'"=="01" {
								gen ``i''=.
							}
							else {
								gen ``i''=w`v'p_l							
							}
							label var ``i'' "종단가중치(98표본)"
						}
						
						else if "``i''"=="p_weight98_c" {		
							if "`v'"=="01" {
								gen ``i''=w`v'p
							}
							else {
								gen ``i''=w`v'p_c							
							}								
							label var ``i'' "횡단가중치(98표본)"
						}
						
						else if "``i''"=="p_weight09_l" {	
						
							if "`v'"=="12"  {
								gen ``i''=.
							}
							else if "`v'"=="13" |  "`v'"=="14"| "`v'"=="15" | "`v'"=="16"| "`v'"=="17"| "`v'"=="18"| "`v'"=="19"| "`v'"=="20"  | "`v'"=="21"| "`v'"=="22"    {
								gen ``i''=sw`v'p_l
							}
							else {
								gen ``i''=.
							}
							label var ``i'' "종단가중치(09통합표본)"
						}
						
						else if "``i''"=="p_weight09_c" {			
							if "`v'"=="12"  {
								gen ``i''=sw`v'p
							}	
							
							else if "`v'"=="13" | "`v'"=="14"| "`v'"=="15" | "`v'"=="16"| "`v'"=="17"| "`v'"=="18" | "`v'"=="19"| "`v'"=="20" | "`v'"=="21"| "`v'"=="22"   {
								gen ``i''=sw`v'p_c
							}
							else {
								gen ``i''=.
							}
							label var ``i'' "횡단가중치(09통합표본)"
						}
						
/***** 노동패널팀 수정: 18통합표본 종단가중치 (p_weight18_l) 변수 추가 *****/		

						else if "``i''"=="p_weight18_l" {	
							if "`v'"=="21"  {
								gen ``i''=.
							}
							else if "`v'"=="22" {
								gen ``i''=nw`v'p_l
							}
							else {
								gen ``i''=.
							}
							label var ``i'' "종단가중치(18통합표본)"
						}

						
/***** 노동패널팀 수정: 18통합표본 횡단가중치 (p_weight18_l) 변수 추가 *****/

						else if "``i''"=="p_weight18_c" {			
							if "`v'"=="21"  {
								gen ``i''=nw`v'p
							}	
							else if "`v'"=="22"{
								gen ``i''=nw`v'p_c
							}
							else {
								gen ``i''=.
							}
							label var ``i'' "횡단가중치(18통합표본)"
						}				
						
/***** 노동패널팀 수정: 98원가구 여부(sample98) 라벨 수정 *****/
						
						* sample98	: 가구원 데이터에서 		
						else if "``i''"=="p_sample98" {
							gen   ``i''=sample98				
							label var ``i'' "98원가구 여부(1=98원가구, 2=98분가가구,3=조사대상아님) " 
						}
						
						* sample09 : 가구원 데이터 에서 
						else if "``i''"=="p_sample09" {
							if "`v'"=="12" |"`v'"=="13" | "`v'"=="13" | "`v'"=="14"| "`v'"=="15"| "`v'"=="16"| "`v'"=="17"| "`v'"=="18"| "`v'"=="19"| "`v'"=="20"    | "`v'"=="21" | "`v'"=="22" {
							gen   ``i''=sample09
							}
							
							else {
							gen   ``i''=.
							}
							label var ``i'' "09통합표본 원가구여부(1=09통합표본원가구, 2=09분가가구, 3=조사대상아님)" 
						}				
			
					* sample18 : 가구원 데이터 에서 
						else if "``i''"=="p_sample18" {
							if  "`v'"=="21"    | "`v'"=="22" {
							gen   ``i''=sample18
							}
							
							else {
							gen   ``i''=.
							}
							label var ``i'' "18통합표본 원가구여부(1=18통합표본원가구, 2=18분가가구, 3=조사대상아님)" 
						}	
						
												
						* error message 
						else {
						di as err "``i'' is not supposed to be on the new variable list" 
						}
				
		}   // the end of forvalues loop
												
			gen wave="`v'"
			gen wave1=real(wave)
			drop wave
			rename wave1 wave 
			label var wave "패널차수" 
			gen year=wave+1997
			label var year "조사년도"
			rename hhid`v' hhid 
			drop if hhid==. 
			label var hhid "가구번호"  
			drop if pid==. 
			label var pid "개인고유번호"  
			keep hhid pid wave year `varlist'
						
			keep hhid pid wave year p_* 
			
	tempfile klips`v'p_1 
	save "`klips`v'p_1'", replace 
	}
	
	
	qui if r(NW)==1 {
			  foreach v of local v1   {
			  use "`klips`v'p_1'", clear
			  order hhid pid wave year
			  tsset pid wave 	
			  compress
			  capture format p_job_begin* %tm 
			  
			  save klips_p_final, replace    
			 }
	}
	
	qui else {
				 local v2=substr("`v1'", 1,2) 
				 use "`klips`v2'p_1'", clear 
				 local v3=substr("`v1'",4, .)
					 
				 foreach v of local v3  {
				 append using "`klips`v'p_1'" 
				 }
			aorder 
			order hhid pid wave
			format p_* %18.0g
			capture drop __* 
			order hhid pid wave year
			tsset pid wave 	
			compress
			capture format p_job_begin* %tm 
			
			save klips_p_final, replace 
	}
			
	if "`wide'"=="wide" {
	capture drop year 
	reshape wide hhid p_*,  i(pid) j(wave)
	aorder 
	order pid hhid*   
	format p_* %18.0g
	capture drop __* 
	compress 	
	capture format p_job_begin* %tm 
	
	save klips_p_final_`wide', replace 
	}	
	
	end 
	 
 