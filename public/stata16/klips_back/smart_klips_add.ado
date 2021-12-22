/*=============================================
 KLIPS 변수 추가하기 
 2015-07-10
 klips_add 명령어  
 long type 형식으로만 가능하다. 
 
 2015-09-04
 2015년 1차-17차 작업 수정 
 ==============================================*/	
	program define smart_klips_add , rclass 
	version 13.0 
	clear 
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) website(string) master(string) save(string)] wave(string) mastertype(string) addtype(string)
	qui cd "`wd'" 
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'
			
			if "`addtype'"=="h" {
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
						label var hhid "가구id"
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
					  save klips_add, replace		 
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
						 save klips_add, replace      
									 
				}
						
			capture use klips_final, clear
			if "`master'"~="" {
				use `master', clear
			}			
				if "`mastertype'"=="h" {
					merge 1:1 hhid wave using klips_add, nogen 
					order hhid wave 
					sort hhid wave
					save klips_final_add, replace
				}
				else if "`mastertype'"=="p" {
					drop if pid==.
					merge m:1 hhid wave using klips_add, nogen 
					order hhid pid wave
					sort pid wave
					save klips_final_add, replace
				}					
			
			} // addtype loop 
	
	/*================================================================================*/
	* addtype: p
	/*================================================================================*/
			else if "`addtype'"=="p" {
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
						label var hhid "가구id"
						* rename h`v'_pid pid
						drop if pid==. 
						label var pid "가구원id"
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
					  save klips_add, replace		 
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
						save klips_add, replace 		     
									 
				}
			
			capture use klips_final, clear
			if "`master'"~="" {
				use `master', clear
			}	
				if "`mastertype'"=="h" {
					merge 1:m hhid wave using klips_add, nogen 
					order hhid pid wave 					
					sort hhid pid wave
					* drop if pid==.
					save klips_final_add, replace
				}
				else if "`mastertype'"=="p" {
				    drop if pid==.
					merge 1:1 pid wave using klips_add, nogen 
					order hhid pid wave 
					sort pid wave
					drop if pid==.
					save klips_final_add, replace
				}					
			
			} // addtype loop 
	
				
	/*===================================================================================================*/	
	if "`save'"~=""  {
		use klips_final_add, clear
		save `save', replace 
		capture erase klips_final_add.dta		
	}
		
capture {
	erase klips_add.dta 
	erase klips_h_final.dta 
	erase klips_p_final.dta 
	erase klips_h_final_wide.dta 
	erase klips_p_final_wide.dta 
}
	
end 

		