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
	program define smart_klips_add_h_v3 , rclass 
	version 14.0 
	clear 
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) website(string) ] wave(string) 
	qui cd "`wd'"
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'			
			
				qui foreach v of local v1   {						
					if "`website'"=="" {
						use klips`v'h, clear					
					}					
					else {					
						use `website'/klips`v'h, clear				
					}					
						 
						 local hhlist ""
						 forvalues i=1/`NV' {
							local a1=substr("``i''",1,1)  // 2번째까지 문자를 가져와야 하는 경우도 있다. 
							local a2=substr("``i''",2,.)
							local a3="`a1'"+"`v'"+"`a2'"
							local hhlist `hhlist' `a3'							
												 
						 } // forvalues loop 
						rename hhid`v' hhid
						drop if hhid==. 
						keep if hwave`v'==1	
						label var hhid "가구id"
						
						* 2016-11-27에 수정한 부분 
							qui ds
							foreach kk of local hhlist {
								if regexm(r(varlist), "`kk'")==0 {
									gen `kk'=.
								}
							}	
							
						keep hhid `hhlist'
						gen wave="`v'"
						gen wave1=real(wave)
						drop wave
						rename wave1 wave
						ren h`v'* h*
						tempfile klips`v'h_1 
						save "`klips`v'h_1'", replace 					
													
				}  // v1 loop  (wave loop) 
				
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

		