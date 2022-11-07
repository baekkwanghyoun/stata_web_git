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
	program define smart_klips_add_h_v3 , rclass 
	version 14.0 
	clear 
	set more off
	
	// (KIS)최대 변수 추가 개수 200개 설정 -> 데이터 가공 시간 고려 
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) website(string) ] wave(string) 
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
						use klips`v'h, clear					
					}					
					else {					
						use `website'/klips`v'h, clear				
					}					
						 
						 local hhlist ""
						 
						 forvalues i=1/`NV' {	// (KIS)add variable에 추가한 변수 개수 
						 
						 // (KIS) (1) h로 시작하는 변수 (h**0151)
							local a1=substr("``i''",1,1)  // (KIS)h0151 -> h 
							local a2=substr("``i''",2,.)  // (KIS)h0151 -> 0151  
							local c1=substr("``i''",1,2)   // (KIS) "(추가)" fh** 변수를 위한 local 지정: fh1511 -> fh
							local a3="`a1'"+"`v'"+"`a2'"  // (KIS) h**0151 
						
						// (KIS) (2) "(추가)"fh로 시작하는 변수 (fh**1511)
							if "`c1'"=="fh" {
								local a1=substr("``i''",1,2)  // (KIS)fh1511 -> fh
								local a2=substr("``i''",3,.)  // (KIS)fh1511 -> 1511 
								local a3="`a1'"+"`v'"+"`a2'"  // (KIS)fh**1511
							}	
						
						// (KIS) (3) "(추가)" 차수에 따라 변수명이 변하지 않는 변수(hwaveent, orghid98, orghid09, orghid18)
						else if "``i''" == "hwaveent" | "``i''" == "orghid98" | "``i''" == "orghid09" | "``i''" == "orghid18" {
							local a3 = "``i''"
							}
							
						// (KIS) (4) "(추가)" htype** 
						else if ustrleft("``i''", 5) == "htype"  { 
							local a3 = usubstr("``i''", 1, 5) + "`v'"  // (KIS)htype** 
							}								
							

											
						// (KIS)원자료에서 불러운 변수명 local 지정 
						local hhlist `hhlist' `a3'						 
						 } // (KIS)forvalues loop 종료 
						 
					 
						rename hhid`v' hhid
						drop if hhid==. 
						keep if hwave`v'==1	
						label var hhid "가구id"
						
					
					
						* (2016-11-27에 수정한 부분)
						qui ds
							foreach kk of local hhlist {
								if regexm(r(varlist), "`kk'")==0 {  // (KIS)특정 차수에 조사되지 않은 변수를 추가한 경우 무응답으 변수 생성
									gen `kk'=.
								}
							}	
							
						keep hhid `hhlist' // (KIS)forvalues에서 지정한 변수들만 keep 
						gen wave="`v'" 
						gen wave1=real(wave)
						drop wave 
						rename wave1 wave
						
						// (KIS)그 외 변수는 변수명의 변경이 필요 없으므로 그대로 변수 rename 필요 없음 
						capture ren h`v'* h* // (KIS)h**0151 -> h0151로 다시 변경 (최종파일) 
						capture ren fh`v'* fh*  // (KIS) "(추가)" fh**1511 -> fh1511로 다시 변경 (최종파일)
						
						// (KIS) "(추가)" 가구/개인 변수명 동일이므로 가구/개인 구분
						capture ren hwaveent h_hwaveent  
						capture ren orghid98 h_orghid98  
						capture ren orghid09 h_orghid09  
						capture ren orghid18 h_orghid18  
						
						// (KIS) "(추가)" htype01은 없는 변수이므로 제외 
						capture drop htype01
						
						
						tempfile klips`v'h_1 
						save "`klips`v'h_1'", replace 					
													
				}  // (KIS)v1 loop 종료 
				
////////////////////////////////////////////////////////////////////////////////

					qui if r(NW)==1 {
					  foreach v of local v1   {
					  use "`klips`v'h_1'", clear
					  
					  tsset hhid wave 
					  capture drop __*
					  order hhid wave
					  tsset hhid wave
					  compress
					  format hhid %15.0g
					  cd "`sfolder'"
					  save klips_add_h, replace		 
					  }
					}


					qui else {
						 local v2=substr("`v1'", 1,2) 
						 use "`klips`v2'h_1'", clear  
						 
						 local v3=substr("`v1'",4, .)
						 
						 foreach v of local v3  {
							append using "`klips`v'h_1'" , force 
						 }
						 aorder 
						 order hhid
						 order wave ,after(hhid) 
						 capture drop __*
						 order hhid wave
						 tsset hhid wave
						 compress
						 format hhid %15.0g						 
						 save klips_add_h, replace   									 
				}		
	
end 

		