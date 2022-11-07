/*=============================================
KLIPS 변수 추가하기 
부가조사 데이터에서 변수 추가 
2019-11-09: Version 3 (21차 까지 사용)
최대 3개까지 선택가능하게 만든다. 
==============================================*/
	program define smart_klips_add_a17_v3 , rclass 
	version 14.0 
	clear 
	set more off
	
// (KIS) "변경" 최대 가능 변수추가 개수 20000개 수정 
    syntax newvarlist(min=1 max=20000 numeric generate) , [wd(string) website(string) ]  
	qui cd "`wd'" 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'			
	local v="17"	
	
	/*================================================================================*/
	* addtype: a17
	/*================================================================================*/								
					if "`website'"=="" {
						use klips`v'a, clear					
					}					
					else {					
						use `website'/klips`v'a, clear				
					}					
						 
						 local hhlist ""
						 forvalues i=1/`NV' {
							local a1=substr("``i''",1,1)  // 2번째까지 문자를 가져와야 하는 경우도 있다. 
							local a2=substr("``i''",2,.)
							local ccc=substr("``i''",1,2)
							local a3="`a1'"+"`v'"+"`a2'"							
																							
						local hhlist `hhlist' `a3'						 
						 } // forvalues loop
									
						drop if pid==. 
						label var pid "가구원id"
						
						* 2016-11-27에 수정한 부분 
							qui ds
							foreach kk of local hhlist {
								if regexm(r(varlist), "`kk'")==0 {
									gen `kk'=.
								}
							}	
							
						keep pid `hhlist'
						gen wave=17						
						* capture ren a`v'* a*_`v'th 
						* a로 시작하는 모든 변수 
						qui ds a*, 
						foreach v2 in `r(varlist)' {
							local v3: variable label `v2'
							label variable `v2' "`v'차_`v3'"							
						}
						*tempfile klips`v'h_1 
						*save "`klips`v'h_1'", replace 				
					
                      tsset pid wave 
					  capture drop __*
					  compress
					  format pid %15.0g
					  order pid wave 
					  drop if pid==.
					  
					  save klips_add_a`v', replace				

end 

		