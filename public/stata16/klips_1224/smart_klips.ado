/*=============================================
 가구패널과 개인패널 합치기
 2014-01-17
 smart_klips 명령어 

2015-09-03 작업
==============================================*/
	program define smart_klips, rclass 
	version 13.0 
	clear 
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) wide website(string) save(string)] wave(string) 
	
	local plist="" 
	local hlist="" 
	
	foreach v in `varlist'  {
	  local vv1=regexm("`v'","h_")
	  local vv2=2*regexm("`v'","p_")
	  	  
	   qui if `vv1'==1   {	    	   
	   local hlist `hlist'  `v'    // 띄어쓰기 아주 중요함 
	   }
	   
	   qui else if `vv2'==2 { 
	   local plist `plist' `v'   // 띄어쓰기 아주 중요함   
	   }
	    	   
	}
	
	local Nhlist=wordcount("`hlist'")
	local Nplist=wordcount("`plist'")
		
	* Case 1 
	if `Nhlist'==0 & `Nplist'~=0 {
			
				if "`website'"=="" {
				smart_p `plist' , wd(`wd') wave(`wave') 
				}
				else {
				smart_p `plist' , wd(`wd') wave(`wave') website(`website') 
				}	
				 
			  save klips_final, replace	
		
		    if "`wide'"=="wide" {
					if "`website'"=="" {
					smart_p `plist' , wd(`wd') wave(`wave') wide 
					}
					else {
					smart_p `plist' , wd(`wd') wave(`wave') wide website(`website') 
					}	
			  save klips_final_`wide', replace 	
			}
		}	

	* Case 2
	else if `Nplist'==0 & `Nhlist'~=0 {			
			
			if "`website'"=="" {
			smart_h `hlist' , wd(`wd') wave(`wave') 
			}
			else {
			smart_h `hlist' , wd(`wd') wave(`wave') website(`website') 
			}
			
			save klips_final, replace
			
		    if "`wide'"=="wide" {		
					if "`website'"=="" {
					smart_h `hlist' , wd(`wd') wave(`wave') wide 
					}
					else {
					smart_h `hlist' , wd(`wd') wave(`wave') wide  website(`website') 
					} 
			  save klips_final_wide, replace				
			}
	
	}
	* Case 3 
	else if  `Nhlist'~=0 & `Nplist'~=0  {
	
				if "`website'"=="" {
				smart_h `hlist' , wd(`wd') wave(`wave') 
				smart_p `plist' , wd(`wd') wave(`wave') 
				}
				else {
				smart_h `hlist' , wd(`wd') wave(`wave') website(`website') 
				smart_p `plist' , wd(`wd') wave(`wave') website(`website') 
				}				
	
				use klips_h_final,clear 
				merge 1:m hhid wave using klips_p_final, nogen
				aorder
				order hhid pid wave year 
				sort hhid pid wave
			    save klips_final, replace 					
		
			if "`wide'"=="wide" {
				capture drop year 
				drop if pid==.
				reshape wide hhid h_* p_*, i(pid) j(wave)
				aorder 
				order pid hhid*
				
		        save klips_final_`wide', replace 
				}					
	}

if "`save'"~=""  {
		use klips_final, clear
		save `save', replace 
		capture erase klips_final.dta
		
		capture {
		use klips_final_wide, replace
		save `save'_wide, replace
		erase klips_final_wide.dta 		
		}
}

capture {
	erase klips_h_final.dta 
	erase klips_p_final.dta 
	erase klips_h_final_wide.dta 
	erase klips_p_final_wide.dta 
}
end

	
	