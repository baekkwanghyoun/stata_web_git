/*=============================================
 2018-01-09: smart_klips_v2 새로운 명령어 코딩 
 가구 패널데이터 만들기 
 ==============================================*/
	program define smart_klips_v2_h, rclass 
	version 14.0 
	clear 
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) save(string)] wave(string)  
	qui cd "`wd'" 
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'			
	/*================================================================================*/
	* type: h
	/*================================================================================*/	
	
				qui foreach v of local v1   {					
						
						 use klips`v'h, clear
						 ren h`v'* h*
						 qui ds
						 local hhlist ""
								
								forvalues i=1/`NV' {
								   local a1=subinstr("``i''","__","",.)  //__를 ""로 바꾼다.		
								   if regexm(r(varlist), "`a1'")==0 {
										gen `a1'=.
									}
								   local hhlist `hhlist' `a1'														 
								 								 
								 } // forvalues loop 								 
								 
						rename hhid`v' hhid
						drop if hhid==. 
						
						if regexm(r(varlist), "sw")==1 {
							keep hhid `hhlist' w* sw* 		
							ren w`v'* w* 
							ren sw`v'* sw*
						}
						
						else if regexm(r(varlist), "sw")==0 {
							keep hhid `hhlist' w* 
							ren w`v'* w* 							
						}
						
						gen wave="`v'"
						gen wave1=real(wave)
						drop wave
						rename wave1 wave						
						order hhid wave 
						tempfile klips`v'h_1 
						save "`klips`v'h_1'", replace 					
													
				}  // v1 loop  (wave loop) 				
						
				
					qui if r(NW)==1 {
					  foreach v of local v1   {
					  use "`klips`v'h_1'", clear
					  label var hhid "가구id"
					  label var wave "survey wave"
					  label var wh "가구가중치(98표본)"
					  capture label var swh "가구가중치(통합표본)"
					  tsset hhid wave 
					  capture drop __*
					  order hhid wave 
					  tsset hhid wave
					  compress
					  format hhid %15.0g
					  save klips_v2_final, replace		 
					  }
					}
				
					qui else {
						 clear 						 
						 set obs 1
						 gen hhid=0
						 
						 foreach v of local v1  {
							append using "`klips`v'h_1'" , force 
						 }
						 drop if hhid==0
						 aorder 
						 order hhid
						 order wave ,after(hhid) 
						 capture drop __*
						 label var hhid "가구id"
					     label var wave "survey wave"
						 label var wh "가구가중치(98표본)"
					     capture label var swh "가구가중치(통합표본)"
						 order hhid wave
						 tsset hhid wave
						 compress
						 format hhid %15.0g
						 save klips_v2_final, replace  								 
			     	}
					
	if "`save'"~=""  {
		use klips_v2_final, clear
		save `save', replace 
		capture erase klips_v2_final.dta		
	}
		
end 

		
