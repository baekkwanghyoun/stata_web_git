/*=============================================
 2018-01-09: smart_klips_v2 새로운 명령어 코딩 
 가구원 패널 
 ==============================================*/
	program define smart_klips_v2_p, rclass 
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
	* type: p
	/*================================================================================*/	
				qui foreach v of local v1   {								
						 use klips`v'p, clear
						 ren p`v'* p*
						 capture ren pa`v'* pa* 
						 capture ren w01p w01p_c  // 1차년도 횡단면 가중치 떄문에 
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
						drop if pid==.					
						
						if regexm(r(varlist), "sw")==1 {
							keep hhid pid `hhlist' w* sw* 		
							ren w`v'* w* 
							ren sw`v'* sw*
						}
						
						else if regexm(r(varlist), "sw")==0 {
							keep hhid pid `hhlist' w* 
							ren w`v'* w* 							
						}
												
						gen wave="`v'"
						gen wave1=real(wave)
						drop wave
						rename wave1 wave
						order hhid pid wave 
						tempfile klips`v'h_1 
						save "`klips`v'h_1'", replace 					
													
				}  // v1 loop  (wave loop) 				
						
				
					qui if r(NW)==1 {
					  foreach v of local v1   {
					  use "`klips`v'h_1'", clear
					  tsset pid wave 
					  capture drop __*
					  order hhid pid  wave
					  label var hhid "가구id"
					  label var wave "survey wave"
					  label var pid "가구원id" 
					  label var wp_c "가구원 횡단 가중치(98표본)"
					  label var wp_l "가구원 종단 가중치(98표본)"
					  capture label var swp_c "가구원 횡단 가중치(통합표본)"
					  capture label var swp_l "가구원 종단 가중치(통합표본)"					  
					  
					  tsset pid wave
					  compress
					  format hhid pid %15.0g
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
						 order hhid pid wave
						 tsset pid wave
						 label var hhid "가구id"
					     label var wave "survey wave"
					     label var pid "가구원id" 
						 label var wp_c "가구원 횡단 가중치(98표본)"
					     label var wp_l "가구원 종단 가중치(98표본)"
					     capture label var swp_c "가구원 횡단 가중치(통합표본)"
					     capture label var swp_l "가구원 종단 가중치(통합표본)"
						 compress
						 format hhid pid %15.0g
						 save klips_v2_final, replace  								 
			     	}
							

if "`save'"~=""  {
		use klips_v2_final, clear
		save `save', replace 
		capture erase klips_v2_final.dta		
}
	
	
end 

		
