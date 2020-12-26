/*=============================================
 2018-01-09: smart_klips_v2 새로운 명령어 코딩 
 ==============================================*/
	program define smart_klips_v2, rclass 
	version 14.0 
	clear 
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) save(string)] wave(string) type(string) 
	if "`type'"=="h" {
			smart_klips_v2_h `varlist' , wd(`wd') save(`save') wave(`wave') 
	}
	
	else if "`type'"=="p" {
			smart_klips_v2_p `varlist' , wd(`wd') save(`save') wave(`wave')
	}
	
	else if "`type'"=="hp" {
			
			    local plist="" 
				local hlist="" 
				
				foreach v in `varlist'  {
				  local vv1=regexm("`v'","h")
				  local vv2=2*regexm("`v'","p")
					  
				   qui if `vv1'==1   {	    	   
				   local hlist `hlist'  `v'    // 띄어쓰기 아주 중요함 
				   }
				   
				   qui else if `vv2'==2 { 
				   local plist `plist' `v'   // 띄어쓰기 아주 중요함   
				   }						   
				}
						
						
			smart_klips_v2_h `hlist' , wd(`wd') save(`save') wave(`wave')
			tempfile data_h
			save `data_h', replace
			smart_klips_v2_p `plist' , wd(`wd') save(`save') wave(`wave')
			tempfile data_p
			save `data_p', replace 
			
			* merge 
			use `data_h', clear
			merge 1:m hhid wave using `data_p'
			keep if _m==3
			drop _m
			order hhid pid wave h* p*
			tsset pid wave 			
			save klips_v2_final, replace 
			
			if "`save'"~=""  {
				save `save', replace 
				capture erase klips_v2_final.dta		
			}					
	}
	
	end 	
		
