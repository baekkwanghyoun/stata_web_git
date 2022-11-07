/*=============================================
 KLIPS 변수 추가하기 
 2015-07-10
 klips_add 명령어  
 long type 형식으로만 가능하다. 
 
 2015-09-04
 2015년 1차-17차 작업 수정 
 2017-06-30: 19차 업데이트 
 2018-06-29: 20차 업데이트 
 2019-10-15: 21차 업데이터 
 2019-11-09: Version 3 (21차 까지 사용)
 2022-08-27: 변수명 유형 추가 
 ==============================================*/
	program define smart_klips_add_p_v3 , rclass 
	version 14.0 
	clear 
	set more off
	
	// (KIS)최대 변수 추가 개수 200개 설정 -> 데이터 가공 시간 고려 
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) website(string)  ] wave(string)  
	qui cd "`wd'" 
	
	// (KIS)차수 local 지정(v1)
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	
	// (KIS)add variable에 추가한 변수 개수 local 지정(varlist)	
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'			
				
//// (KIS) 변수명 설정 //////////////////////////////////////////////////////////

/// 2022-08-27: "(추가)" 참조 ///
				qui foreach v of local v1   {						
					if "`website'"=="" {
						use klips`v'p, clear					
					}					
					else {					
						use `website'/klips`v'p, clear				
					}					
						 
						 local hhlist ""
						 forvalues i=1/`NV' {  // (KIS)add variable에 추가한 변수 개수 

						 // (KIS) (1) p로 시작하는 변수 (p**0101 or p**orghid98, p**orig09, p**orig18)
							local a1=substr("``i''",1,1)  // (KIS)p0101 -> p
							local a2=substr("``i''",2,.)  // (KIS)p0101 -> 0101
							local c1=substr("``i''",1,2)   // (KIS) "(추가)" (ccc -> c1변경)pa** 변수를 위한 local 지정: pa5101 -> pa 
							local a3="`a1'"+"`v'"+"`a2'"
							
						// (KIS) (2) pa로 시작하는 변수 (pa*5101)							
							if "`c1'"=="pa" { // (KIS) "(추가)" (ccc -> c1변경)
								local a1=substr("``i''",1,2)  // (KIS)pa5101 -> pa
								local a2=substr("``i''",3,.)  // (KIS)pa5101 -> 5101
								local a3="`a1'"+"`v'"+"`a2'"  // (KIS)pa**1511
							}	
								
						// (KIS) (3) "(추가)" 차수에 따라 변수명이 변하지 않는 변수(hwaveent, orghid98, orghid09, orghid18, jobclass, jobnum, jobtype)
						else if "``i''" == "hwaveent" | "``i''" == "orghid98" | "``i''" == "orghid09" | "``i''" == "orghid18" | "``i''" == "jobclass" | "``i''" == "jobnum" | "``i''" == "jobtype" {
							local a3 = "``i''"
							}			
							
						// (KIS) (4) "(추가)" hmem** 
						else if ustrleft("``i''", 4) == "hmem" {
							local a3 = usubstr("``i''", 1, 4) + "`v'"  // (KIS) hmem** 
							}								
								
								
						// (KIS)원자료에서 불러운 변수명 local 지정 								
						local hhlist `hhlist' `a3'	 
						
						 } // (KIS)forvalues loop 종료 
									
						rename hhid`v' hhid
						drop if hhid==. 
						capture keep if hwave`v'==1	
						label var hhid "가구id"
						* rename h`v'_pid pid
						drop if pid==. 
						label var pid "가구원id"
						
						* (2016-11-27에 수정한 부분)
						qui ds
							foreach kk of local hhlist {
								if regexm(r(varlist), "`kk'")==0 {  // (KIS)특정 차수에 조사되지 않은 변수를 추가한 경우 무응답으 변수 생성
									gen `kk'=.
								}
							}	
							
						keep hhid pid `hhlist'  // (KIS)forvalues에서 지정한 변수들만 keep 
						gen wave="`v'"
						gen wave1=real(wave)
						drop wave
						rename wave1 wave
						
						// (KIS)그 외 변수는 변수명의 변경이 필요 없으므로 그대로 변수 rename 필요 없음 
						capture ren p`v'* p*  // (KIS)p**0101 -> p0101로 다시 변경 (최종파일) 
						capture ren pa`v'* pa*  // (KIS) "(추가)" pa**5101 -> pa5101로 다시 변경 (최종파일) 
						
						// (KIS) "(추가)" 가구/개인 변수명 동일이므로 가구/개인 구분 
						capture ren hwaveent p_hwaveent 
						capture ren orghid98 p_orghid98  
						capture ren orghid09 p_orghid09  
						capture ren orghid18 p_orghid18  
						
						tempfile klips`v'h_1 
						save "`klips`v'h_1'", replace 					
													
				}  // (KIS)v1 loop 종료 

////////////////////////////////////////////////////////////////////////////////

					qui if r(NW)==1 {
					  foreach v of local v1   {
					  use "`klips`v'h_1'", clear
                      tsset pid wave 
					  capture drop __*
					  compress
					  format hhid pid %15.0g
					  order hhid pid wave 
					  drop if pid==.
					  
					  save klips_add_p, replace		 
					  }
					}
				
					qui else {
						 local v2=substr("`v1'", 1,2) 
						 use "`klips`v2'h_1'", clear  
						 local v3=substr("`v1'",4, .)
						 foreach v of local v3  {
							append using "`klips`v'h_1'" , force 
						 }
						order hhid pid wave
						tsset pid wave 	
						aorder 
						order hhid pid wave 
						format hhid pid %15.0g
						capture drop __*
						compress
						drop if pid==.
						
						save klips_add_p, replace 		     
									 
				}
			

end 

		