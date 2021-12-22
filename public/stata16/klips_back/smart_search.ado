/*=============================================
variable label과 매칭되는 변수 찾기
2015-11-06: 띄어쓰기 문제해결
2015-09-03
==============================================*/
program define smart_search, rclass
version 13.0 
clear
	syntax , [wd(string) website(string)] hp(string) word(string) wave(string)  	
	qui cd "`wd'" 
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	
	foreach v of local v1   {	
	
		set more off
		if "`website'"=="" {
			use klips`v'`hp', clear 
		}
		else if "`website'"~="" {		
			use `website'/klips`v'`hp', clear
		}
		
		* 여기서부터 11월 6일 수정함 
		tempfile file1
		qui save `file1', replace 
		
		* 데이터를 불러온 후 레이블에서 띄어쓰기를 모두 해결한다. 
		qui ds
		local varlist2 `r(varlist)' 
		local nn=wordcount("`varlist2'") 

		forvalues i=1(1)`nn'  {
			local Z: word `i' of `varlist2'
			local aa: variable label `Z'
			local Y=subinstr("`aa'"," ","",.)
			label var `Z' "`Y'"
		}
					
		qui ds , has(varlabel *`word'*)
		
		* 다시 원래대로 띄어쓰기를 돌린다. 
		use `file1', clear 
		
		if "`r(varlist)'"=="" {
			di _n
			di "===============" "klips`v'`hp'.dta 파일 중에서 `word'를(을)포함한 변수 리스트" "==============="
			di in red "해당하는 변수가 없습니다. word( ) 검색어에서 띄어쓰기를 하지 마세요" 
			di _n
		}	
	
		else if "`r(varlist)'"~="" {
			di _n
			di "===============" "klips`v'`hp'.dta 파일 중에서 `word'를(을) 포함한 변수 리스트" "==============="
			d `r(varlist)'
			di _n
		}	
		
	}	
		
end 	
