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
 ==============================================*/
	program define smart_klips_add_p_v3 , rclass 
	version 14.0 
	clear 
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) website(string) sfolder(string) ] wave(string)  
	qui cd "`wd'" 
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'			
				
	/*================================================================================*/
	* addtype: p
	/*================================================================================*/			
				qui foreach v of local v1   {						
					if "`website'"=="" {
						use klips`v'p, clear					
					}					
					else {					
						use `website'/klips`v'p, clear				
					}					
						 
						 local hhlist ""
						 forvalues i=1/`NV' {
							local a1=substr("``i''",1,1)  // 2번째까지 문자를 가져와야 하는 경우도 있다. 
							local a2=substr("``i''",2,.)
							local ccc=substr("``i''",1,2)
							local a3="`a1'"+"`v'"+"`a2'"
							if "`ccc'"=="pa" {
								local a1=substr("``i''",1,2)  // 시작이 pa인 경우 
								local a2=substr("``i''",3,.)
								local a3="`a1'"+"`v'"+"`a2'"
							}	
																							
						local hhlist `hhlist' `a3'						 
						 } // forvalues loop
									
						rename hhid`v' hhid
						drop if hhid==. 
						capture keep if hwave`v'==1	
						label var hhid "가구id"
						* rename h`v'_pid pid
						drop if pid==. 
						label var pid "가구원id"
						
						* 2016-11-27에 수정한 부분 
							qui ds
							foreach kk of local hhlist {
								if regexm(r(varlist), "`kk'")==0 {
									gen `kk'=.
								}
							}	
							
						keep hhid pid `hhlist'
						gen wave="`v'"
						gen wave1=real(wave)
						drop wave
						rename wave1 wave
						capture ren p`v'* p*
						capture ren pa`v'* pa*
						tempfile klips`v'h_1 
						save "`klips`v'h_1'", replace 					
													
				}  // v1 loop  (wave loop) 
				
					qui if r(NW)==1 {
					  foreach v of local v1   {
					  use "`klips`v'h_1'", clear
                      tsset pid wave 
					  capture drop __*
					  compress
					  format hhid pid %15.0g
					  order hhid pid wave 
					  drop if pid==.
					  cd "`sfolder'"
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
						cd "`sfolder'"
						save klips_add_p, replace 		     
									 
				}
			
			
qui cd "`wd'"
end 

		