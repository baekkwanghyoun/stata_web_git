/*=============================================
variable label과 매칭되는 변수 찾기
2015-11-06: 띄어쓰기 문제해결
2015-09-03
2016-11-27: 띄어쓴 검색어 문제 해결, 변수명도 찾는 것이 가능 
2017-06-30 : 19차 업데이트 
2018-06-29 : 20차 업데이트 
2019-10-15: 21차 업데이터
2019-11-09: Version 3 (21차 까지 사용) 
2020-11-09: 22차 업데이트 
==============================================*/
program define smart_klips_search_v3, rclass
version 14.0 
clear
	syntax , [wd(string) website(string)] hp(string) word(string) wave(string)  	
	qui cd "`wd'" 
			local wlist ""			
			local wave "`wave'" 
			local wave=subinstr("`wave'"," -","-",.)
			local wave=subinstr("`wave'","- ","-",.)
			local wave=subinstr("`wave'"," - ","-",.)
			local wave=subinstr("`wave'","-","/",.)
			foreach www of numlist `wave' {
				local www1=string(`www',"%02.0f")	
				local wlist `wlist' `www1'	
			}
			local wave "`wlist'"	
			
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
			local Z1=substr("`Z'",1,1)+substr("`Z'",4,.)
			local aa: variable label `Z'
			local ab "`Z1';`aa'"
			qui label variable `Z' "`ab'"
			local Y=subinstr("`ab'"," ","",.)
			qui label var `Z' "`Y'"
		}
		local word=subinstr("`word'"," ","",.)			
		qui ds , has(varlabel *`word'*)		
		
		* 다시 원래대로 띄어쓰기를 돌린다. 
		use `file1', clear 
		
		if "`r(varlist)'"=="" {
			di _n
			di "===============" "klips`v'`hp'.dta 파일 중에서 `word' 포함한 변수 리스트" "==============="
			di in red "해당하는 변수가 없습니다. 검색어는 1개만 지정할 수 있습니다." 
			di _n
		}	
	
		else if "`r(varlist)'"~="" {
			di _n
			di "===============" "klips`v'`hp'.dta 파일 중에서 `word' 포함한 변수 리스트" "==============="
			d `r(varlist)'
			di _n
		}	
		
	}	
		
end 	
