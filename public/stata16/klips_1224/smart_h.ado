/*=============================================
 가구패널 데이터 만들기 
 Ado file coding 
 2014-01-20
 version 1.1.0
 여러변수를 동시에 generate
 wide 옵션 추가  
 smart_h명령어  
 
 2014-03-24 15차년도 데이터까지 업데이트 
 5월1일 수정함 
 
 2014-06-24
 연구원 요구사항 수정 
 
 2014-07-14 
 연구원 요구사항 재 수정 
 
 2015-09-03
 1차 ~ 17차 수정 작업(2015년 용역) 
 klips_h에서 smart_h로 변경함 
 
 2015-09-10 
 h_eqscale 변수 추가 
 
 2016-06-22 
 1차 ~ 18차 수정 작업
 
 2019-08-06
 1차 ~ 21차 수정 작업 
 변수병 h_kidage1315 오류 수정 
 변수병 h_hedu 범주 변경 
 
 2020-02-28
 h_inc_1 (이전소득) 
 h_inc_2 (금융소득) 수정 
 
==============================================*/
	program define smart_h, rclass 
	version 13.0 
	clear 
	set more off
	syntax newvarlist(min=1 max=50 numeric generate) , [wd(string) wide website(string)] wave(string) 	
	qui cd "`wd'" 
	local v1 "`wave'" 
	return scalar NW=wordcount("`v1'") 
	local NV=wordcount("`varlist'")
	return scalar NV=`NV'
	
	
	qui foreach v of local v1   {						
			if "`website'"=="" {
						use klips`v'p, clear
						tempfile file`v'p10 
						keep hhid`v' p`v'5501 p`v'0102    // 여기에 계속 변수를 추가한다. (개인패널에서 가져온 가구주 변수)
						keep if p`v'0102==10
						drop p`v'0102
						mvdecode _all, mv(-1=.)
						save `file`v'p10', replace	
						
						use klips`v'p, clear	
						tempfile file`v'p20 
						keep hhid`v' p`v'5501 p`v'0102   // 여기에 계속 변수를 추가한다. (개인패널에서 가져온 가구주 배우자 변수)
						keep if p`v'0102==20	
						ren (p`v'5501 ) (p`v'5501_20    )  // 이런 식으로 계속 변수이름을 바꾸어 준다. 
						drop p`v'0102
						mvdecode _all, mv(-1=.)
						save `file`v'p20', replace		
					
					use klips`v'h, clear
					keep if hwave`v'==1	
					merge 1:1 hhid`v' using `file`v'p10'
					drop if _m==2
					drop _m
					merge 1:1 hhid`v' using `file`v'p20'
					drop if _m==2
					drop _m			
			}			
			else {			
					use `website'/klips`v'p, clear
					tempfile file`v'p10 
					keep hhid`v' p`v'5501 p`v'0102   // 여기에 계속 변수를 추가한다. (개인패널에서 가져온 가구주 변수)
					keep if p`v'0102==10
					drop p`v'0102
					mvdecode _all, mv(-1=.)
					save `file`v'p10', replace	
					
					use `website'/klips`v'p, clear	
					tempfile file`v'p20 
					keep hhid`v' p`v'5501 p`v'0102   // 여기에 계속 변수를 추가한다. (개인패널에서 가져온 가구주 배우자 변수)
					keep if p`v'0102==20	
					ren (p`v'5501 ) (p`v'5501_20    )  // 이런 식으로 계속 변수이름을 바꾸어 준다. 
					drop p`v'0102
					mvdecode _all, mv(-1=.)
					save `file`v'p20', replace		
				
				use `website'/klips`v'h, clear
				keep if hwave`v'==1	
				merge 1:1 hhid`v' using `file`v'p10'
				drop if _m==2
				drop _m
				merge 1:1 hhid`v' using `file`v'p20'
				drop if _m==2
				drop _m			
			}
	
	  keep if hwave`v'==1	
	  
      local h=1
	  foreach head of varlist h`v'0261-h`v'0275 {
	  tempvar head`h'
	  gen `head`h''= `head' 
	  local ++h
	  }
	  
	  local k=1
	  foreach age of varlist h`v'0361-h`v'0375 {
	  tempvar age`k'
	  rename `age' `age`k''
	  local ++k
	  }
	  
	  
	  if "`v'"~="01" {
			  local m=1
			  foreach drop of varlist h`v'0421-h`v'0435 {
			  tempvar drop`m'
			  ren `drop' `drop`m'' 
			  local ++m
			  }
	  }
	  
	  * 소득변수는 앞서 만든다. 
	  /*=============================================================================================*/
	  tempvar inc1
	  		   
				if "`v'"=="09" | "`v'"=="10" | "`v'"=="11" |  "`v'"=="12" { 
						tempvar h`v'2156
						gen `h`v'2156'=.  
						
						mvdecode h`v'2152 h`v'2153 h`v'2155 `h`v'2156' ///
						h`v'2157 h`v'2158 h`v'2159 h`v'2160, mv(-1 99999  999999 9999=.)
						
						egen   `inc1'=rowtotal(h`v'2152 h`v'2153 h`v'2155 `h`v'2156' ///
						h`v'2157 h`v'2158 h`v'2159 h`v'2160), miss
						replace `inc1'=. if h`v'2151==2
			    }	
			    
				else if "`v'"=="13" | "`v'"=="14" | "`v'"=="15" | "`v'"=="16" | "`v'"=="17" | "`v'"=="18"{ 
						tempvar h`v'2156
						gen `h`v'2156'=.  
						
						mvdecode h`v'2152 h`v'2153 h`v'2155 `h`v'2156' ///
						h`v'2157 h`v'2158 h`v'2159 h`v'2160 h`v'4002, mv(-1 99999  999999 9999=.)
						
						egen   `inc1'=rowtotal(h`v'2152 h`v'2153 h`v'2155 `h`v'2156' ///
						h`v'2157 h`v'2158 h`v'2159 h`v'2160 h`v'4002), miss
						replace `inc1'=. if h`v'2151==2 & h`v'4001==2   // 근로소득 장려세 포함
			    }
				
				else if "`v'"=="19" | "`v'"=="20" | "`v'"=="21"{ 
						tempvar h`v'2156
						gen `h`v'2156'=.  
						
						mvdecode h`v'2152 h`v'2153 h`v'2155 `h`v'2156' ///
						h`v'2157 h`v'2158 h`v'2159 h`v'2160 h`v'4002 h`v'4004, mv(-1 99999  999999 9999=.)
						
						egen   `inc1'=rowtotal(h`v'2152 h`v'2153 h`v'2155 `h`v'2156' ///
						h`v'2157 h`v'2158 h`v'2159 h`v'2160 h`v'4002 h`v'4004), miss
						replace `inc1'=. if h`v'2151==2 & h`v'4001==2 & h`v'4003==2   // 자녀장려금 지원금 포함 
			    }
				
				
						
				
				else if "`v'"=="08" | "`v'"=="07" |"`v'"=="06" {
						tempvar h`v'2157 h`v'2158 h`v'2159
						gen `h`v'2157'=. 
						gen `h`v'2158'=. 
						gen `h`v'2159'=.
						
						mvdecode h`v'2152 h`v'2153 h`v'2155 h`v'2156 ///
						`h`v'2157' `h`v'2158' `h`v'2159' h`v'2160, mv(-1 99999  999999 9999=.)
						
						egen   `inc1'=rowtotal(h`v'2152 h`v'2153 h`v'2155 h`v'2156 ///
						`h`v'2157' `h`v'2158' `h`v'2159' h`v'2160), miss
						replace `inc1'=. if h`v'2151==2
				}
	  	
				else if "`v'"=="01"   {
						tempvar h`v'2153 h`v'2155 h`v'2156 h`v'2157 h`v'2158 h`v'2159 h`v'2160
						gen `h`v'2153'=. 
						gen `h`v'2155'=.
						gen `h`v'2156'=. 
						gen `h`v'2157'=. 
						gen `h`v'2158'=. 
						gen `h`v'2159'=.
						gen `h`v'2160'=.
						
						mvdecode h`v'2152 `h`v'2153' `h`v'2155' `h`v'2156' ///
						`h`v'2157' `h`v'2158' `h`v'2159' `h`v'2160', mv(-1 99999  999999 9999=.)
						
						egen   `inc1'=rowtotal(h`v'2152 `h`v'2153' `h`v'2155' `h`v'2156' ///
						`h`v'2157' `h`v'2158' `h`v'2159' `h`v'2160'), miss
						replace `inc1'=. if h`v'2151==2
				}
		
				else   {
						tempvar h`v'2153 h`v'2157 h`v'2158 h`v'2159
						gen `h`v'2153'=. 
						gen `h`v'2157'=. 
						gen `h`v'2158'=. 
						gen `h`v'2159'=.
						
						mvdecode h`v'2152 `h`v'2153' h`v'2155 h`v'2156 ///
						`h`v'2157' `h`v'2158' `h`v'2159' h`v'2160, mv(-1 99999  999999 9999=.)
						
						egen   `inc1'=rowtotal(h`v'2152 `h`v'2153' h`v'2155 h`v'2156 ///
						`h`v'2157' `h`v'2158' `h`v'2159' h`v'2160), miss
						replace `inc1'=. if h`v'2151==2
				}
			
			  // 0인 사람과 . 인 사람을 구별한다.  
			  recode `inc1' (0=.)
			  label var `inc1' "이전소득(단위: 만원)"  				  
			 	
					
			* 7번 : 사회보험  
			tempvar inc2
			
			      if "`v'"=="05" | "`v'"=="04"  {
						  tempvar h`v'2142 
						  gen `h`v'2142'=.
						  
						  mvdecode h`v'2134  h`v'2136 h`v'2138 h`v'2140 `h`v'2142', mv(-1 99999  999999 9999=.)
						  egen   `inc2'=rowtotal(h`v'2134  h`v'2136 h`v'2138 h`v'2140 `h`v'2142'), miss
						  replace `inc2'=. if h`v'2131==2
				  }	
		
				  else if "`v'"=="03"|"`v'"=="02" {
						  tempvar h`v'2142   h`v'2140 
						  gen `h`v'2142'=.
						  gen `h`v'2140'=.
						  mvdecode h`v'2134  h`v'2136 h`v'2138 `h`v'2140' `h`v'2142', mv(-1 99999  999999 9999=.)
						  egen   `inc2'=rowtotal(h`v'2134  h`v'2136 h`v'2138 `h`v'2140' `h`v'2142'), miss
						  replace `inc2'=. if h`v'2131==2
				  }	
				  
				  else if "`v'"=="01" {
							mvdecode h`v'2270- h`v'2287, mv(-1=.) 
							egen `inc2'=rowtotal(h`v'2270- h`v'2287), miss
							replace `inc2'=. if h`v'2131==2
				  }
		          
				  else   {
						  mvdecode h`v'2134  h`v'2136 h`v'2138 h`v'2140 h`v'2142, mv(-1 99999  999999 9999=.)
						  egen   `inc2'=rowtotal(h`v'2134  h`v'2136 h`v'2138 h`v'2140 h`v'2142), miss
						  replace `inc2'=. if h`v'2131==2
				  }
				  
				 // 0인 사람과 . 인 사람을 구별한다.  
			     recode `inc2' (0=.)
				 label var `inc2' "사회보험 소득(단위: 만원)" 
			
			   
		    * 8번 
			tempvar inc3
			
			     if "`v'"=="09" | "`v'"=="10" | "`v'"=="11"|"`v'"=="12" | "`v'"=="13" | "`v'"=="14" | "`v'"=="15"| "`v'"=="16" | "`v'"=="17" | "`v'"=="18" | "`v'"=="19" | "`v'"=="20" | "`v'"=="21" {
						 tempvar h`v'2182
						 gen `h`v'2182'=.
						 
						 mvdecode `h`v'2182' h`v'2183 h`v'2184 h`v'2185 h`v'2186 ///
						 h`v'2187 h`v'2188 h`v'2189 h`v'2190 h`v'2191, mv(-1 99999  999999 9999=.)
						 
						 egen   `inc3'=rowtotal(`h`v'2182' h`v'2183 h`v'2184 h`v'2185 h`v'2186 ///
						 h`v'2187 h`v'2188 h`v'2189 h`v'2190 h`v'2191), miss
						 replace `inc3'=. if h`v'2181==2
				 }	
				
				else if  "`v'"=="08" | "`v'"=="07" |  "`v'"=="06" | "`v'"=="05" | "`v'"=="04" {
						tempvar  h`v'2183 h`v'2184 h`v'2185 h`v'2188 h`v'2189 h`v'2190
						gen `h`v'2183'=.
						gen `h`v'2184'=. 
						gen `h`v'2185'=.
						gen `h`v'2188'=.
						gen `h`v'2189'=. 
						gen `h`v'2190'=.
						
						 mvdecode h`v'2182 `h`v'2183' `h`v'2184' `h`v'2185' h`v'2186 ///
						 h`v'2187 `h`v'2188' `h`v'2189' `h`v'2190' h`v'2191, mv(-1 99999  999999 9999=.)
						 egen   `inc3'=rowtotal(h`v'2182 `h`v'2183' `h`v'2184' `h`v'2185' h`v'2186 ///
						 h`v'2187 `h`v'2188' `h`v'2189' `h`v'2190' h`v'2191), miss
						 replace `inc3'=. if h`v'2181==2
				 }
		
				else if "`v'"=="03" |"`v'"=="02" { 
						tempvar  h`v'2183 h`v'2184 h`v'2185 h`v'2187 h`v'2188 h`v'2189 h`v'2190
						gen `h`v'2183'=. 
						gen `h`v'2184'=. 
						gen `h`v'2185'=. 
						gen `h`v'2187'=. 
						gen `h`v'2188'=.
						gen `h`v'2189'=. 
						gen `h`v'2190'=. 
						
						 mvdecode h`v'2182 `h`v'2183' `h`v'2184' `h`v'2185' h`v'2186 ///
						 `h`v'2187' `h`v'2188' `h`v'2189' `h`v'2190' h`v'2191, mv(-1 99999  999999 9999=.)
						 egen   `inc3'=rowtotal(h`v'2182 `h`v'2183' `h`v'2184' `h`v'2185' h`v'2186 ///
						 `h`v'2187' `h`v'2188' `h`v'2189' `h`v'2190' h`v'2191), miss
						 replace `inc3'=. if h`v'2181==2
			 	}
		
				else if   "`v'"=="01"  {
						tempvar  h`v'2183 h`v'2184 h`v'2185 h`v'2186 h`v'2187 h`v'2188 h`v'2189 h`v'2190 h`v'2191
						
						gen `h`v'2183'=. 
						gen `h`v'2184'=. 
						gen `h`v'2185'=. 
						gen `h`v'2186'=. 
						gen `h`v'2187'=. 
						gen `h`v'2188'=.
						gen `h`v'2189'=. 
						gen `h`v'2190'=. 
						gen `h`v'2191'=. 
						
						 mvdecode h`v'2182 `h`v'2183' `h`v'2184' `h`v'2185' `h`v'2186' ///
						 `h`v'2187' `h`v'2188' `h`v'2189' `h`v'2190' `h`v'2191', mv(-1 99999  999999 9999=.)
						 egen   `inc3'=rowtotal(h`v'2182 `h`v'2183' `h`v'2184' `h`v'2185' `h`v'2186' ///
						 `h`v'2187' `h`v'2188' `h`v'2189' `h`v'2190' `h`v'2191'), miss
						 replace `inc3'=. if h`v'2181==2
				}	 	
				
				// 0인 사람과 . 인 사람을 구별한다.  
			     label var `inc3' "기타 소득(단위: 만원) " 
				 recode `inc3' (0=.)
 			  
		
			* 9번 : 근로소득 
			
				tempvar inc4
						mvdecode h`v'2102, mv(-1 99999  999999 9999=.)
						gen   `inc4'=h`v'2102
						replace `inc4'=. if h`v'2101==2
						recode `inc4' (0=.)
						label var `inc4' "근로소득(단위: 만원)"  				
			
			
			* 10번 : 금융소득 			
				tempvar inc5
				
				if "`v'"=="01" {
							tempvar h`v'2113 h`v'2115 h`v'2116
							gen `h`v'2113'=. 
							gen `h`v'2115'=. 
							gen `h`v'2116'=.
							
							mvdecode h`v'2112 `h`v'2113' `h`v'2115' `h`v'2116', mv(-1 99999  999999 9999=.)
							egen   `inc5'=rowtotal(h`v'2112 `h`v'2113' `h`v'2115' `h`v'2116'), miss 
							replace `inc5'=. if h`v'2111==2
				}
							  
				else {
							mvdecode h`v'2112 h`v'2113 h`v'2115 h`v'2116, mv(-1 99999  999999 9999=.)
							egen   `inc5'=rowtotal(h`v'2112 h`v'2113 h`v'2115 h`v'2116), miss 
							replace `inc5'=. if h`v'2111==2
				}
				
				recode `inc5' (0=.)
				label var `inc5' "금융소득(단위: 만원)" 
			
				
				* 11번 : 부동산 소득  
				tempvar inc6
				
				if "`v'"=="03" {
						tempvar h`v'2125 
						gen `h`v'2125'=. 
										
						mvdecode h`v'2122 h`v'2123 h`v'2124 `h`v'2125' h`v'2126, mv(-1 99999  999999 9999=.)
						egen   `inc6'=rowtotal(h`v'2122 h`v'2123 h`v'2124 `h`v'2125' h`v'2126), miss 
						replace `inc6'=. if h`v'2121==2
				}
				  
				else if "`v'"=="02" {
						tempvar h`v'2125  h`v'2124
						gen `h`v'2125'=. 
						gen `h`v'2124'=.				
						mvdecode h`v'2122 h`v'2123 `h`v'2124' `h`v'2125' h`v'2126, mv(-1 99999  999999 9999=.)
						egen   `inc6'=rowtotal(h`v'2122 h`v'2123 `h`v'2124' `h`v'2125' h`v'2126), miss 
						replace `inc6'=. if h`v'2121==2
				}
				  
				else if "`v'"=="01" {
						tempvar h`v'2125  h`v'2124 h`v'2123 h`v'2126
						gen `h`v'2125'=. 
						gen `h`v'2124'=.
						gen `h`v'2123'=. 
						gen `h`v'2126'=.
						
						mvdecode h`v'2122 `h`v'2123' `h`v'2124' `h`v'2125' `h`v'2126', mv(-1 99999  999999 9999=.)
						egen   `inc6'=rowtotal(h`v'2122 `h`v'2123' `h`v'2124' `h`v'2125' `h`v'2126'), miss 
						replace `inc6'=. if h`v'2121==2
				}
				  
				  
				else {
						mvdecode h`v'2122 h`v'2123 h`v'2124 h`v'2125 h`v'2126, mv(-1 99999  999999 9999=.)
						egen   `inc6'=rowtotal(h`v'2122 h`v'2123 h`v'2124 h`v'2125 h`v'2126), miss 
						replace `inc6'=. if h`v'2121==2
				}
				
				recode `inc6' (0=.) 			  
				label var `inc6' "부동산소득(단위: 만원)" 				
				
									
			* 12번 : 총 소득 
				tempvar inc7			    
					egen   `inc7'=rowtotal(`inc1' `inc2' `inc3' `inc4' `inc5' `inc6'), miss 
					label var `inc7' "총소득(6개항목 소득 합계, 단위: 만원)" 
			 
			 * 소득 10분위 
			 tempvar inc8
			 xtile `inc8'=`inc7' , n(10)
		/*=========================================================================================================================*/
		* equivalence scale 
		tempvar h_num_kid
						
			tempvar kid1 kid2 kid3 kid4 kid5 kid6 kid7 kid8 kid9 kid10 kid11 kid12 kid13 kid14 kid15
					foreach n of num 1/15 {
					* gen `kid`n''=`age`n'' if `head`n''>=11 &  `head`n''<=19 
					gen `kid`n''=`age`n'' 
					replace `kid`n''=(`kid`n''>=0 & `kid`n''<=14) 
						if "`v'"~="01" {
						replace `kid`n''=0 if `drop`n''==3 | `drop`n''==4
						}
					}  							
			egen   `h_num_kid'=rowtotal(`kid1' `kid2' `kid3' `kid4' `kid5' `kid6' `kid7' `kid8' ///
			`kid9' `kid10' `kid11' `kid12' `kid13' `kid14' `kid15')
			
		tempvar h_num_total					
		gen `h_num_total'=h`v'0150				
			
		/*========================================================================================================================*/						
				 					
	        forvalues i=1/`NV' {
							
			* 1번 
	        if "``i''"=="h_resid_type" {
					gen ``i''=h`v'1406
					recode ``i'' (4/max=4) (-10/-1=.)
					label var ``i'' "주택점유형태(1=자가, 2=전세, 3=월세, 4=기타) "
			}
			
		    * 2번
		    else if "``i''"=="h_hprice" {
					gen   ``i''=h`v'1412	
					mvdecode ``i'', mv(0 -1 999999 99999 9999=.)
					label var ``i'' "소유주택 시가(단위: 만원)"					
			}
			
			* 3번 
			else if "``i''"=="h_region" {
					gen   ``i''=h`v'0141
					label var ``i'' "거주지역(16개시도, 19=세종시): 코드북 참고" 
			}
			
			* 4번 
			else if "``i''"=="h_hsex" {			
					
					local j=1
					foreach sex of varlist h`v'0241-h`v'0255 {
					tempvar sex`j'
					rename `sex' `sex`j''
					local ++j
					}
					   
					gen   ``i''=.
					foreach n of num 1/15 {
					replace ``i''=`sex`n'' if `head`n''==10
					}   
			label var ``i'' "가구주 성별(1=남자 2=여자)"     
			}			
			
			* 5번 
			else if "``i''"=="h_hage" {
							
				gen   ``i''=.
				foreach n of num 1/15 {
				replace ``i''=`age`n'' if `head`n''==10
				}  	
			label var ``i'' "가구주 나이" 
			}
			
			* 5-1 번 
			else if "``i''"=="h_kidage06" {
						
			tempvar kid1 kid2 kid3 kid4 kid5 kid6 kid7 kid8 kid9 kid10 kid11 kid12 kid13 kid14 kid15
					foreach n of num 1/15 {
					gen `kid`n''=`age`n'' if `head`n''>=11 &  `head`n''<=19 
					replace `kid`n''=(`kid`n''>=0 & `kid`n''<=6) 
						if "`v'"~="01" {
						replace `kid`n''=0 if `drop`n''==3 | `drop`n''==4
						}
					}  							
			egen   ``i''=rowtotal(`kid1' `kid2' `kid3' `kid4' `kid5' `kid6' `kid7' `kid8' ///
			`kid9' `kid10' `kid11' `kid12' `kid13' `kid14' `kid15')
			label var ``i'' "0세 ~ 6세 자녀 수"
			}
			
			* 5-2 번 
			else if "``i''"=="h_kidage712" {
							
					tempvar kid1 kid2 kid3 kid4 kid5 kid6 kid7 kid8 kid9 kid10 kid11 kid12 kid13 kid14 kid15
					foreach n of num 1/15 {
					gen `kid`n''=`age`n'' if `head`n''>=11 &  `head`n''<=19 
					replace `kid`n''=(`kid`n''>=7 & `kid`n''<=12) 
						if "`v'"~="01" {
						replace `kid`n''=0 if `drop`n''==3 | `drop`n''==4
						}
					}  	
						
			egen   ``i''=rowtotal(`kid1' `kid2' `kid3' `kid4' `kid5' `kid6' `kid7' `kid8' ///
			`kid9' `kid10' `kid11' `kid12' `kid13' `kid14' `kid15')
			label var ``i'' "7세 ~ 12세 자녀 수"
			}
			
			* 5-3 번 
			else if "``i''"=="h_kidage1315" {
						
					tempvar kid1 kid2 kid3 kid4 kid5 kid6 kid7 kid8 kid9 kid10 kid11 kid12 kid13 kid14 kid15
					foreach n of num 1/15 {
					gen `kid`n''=`age`n'' if `head`n''>=11 &  `head`n''<=19 
					replace `kid`n''=(`kid`n''>=13 & `kid`n''<=15) 
						if "`v'"~="01" {
						replace `kid`n''=0 if `drop`n''==3 | `drop`n''==4
						}
					}  	
						
			egen   ``i''=rowtotal(`kid1' `kid2' `kid3' `kid4' `kid5' `kid6' `kid7' `kid8' ///
			`kid9' `kid10' `kid11' `kid12' `kid13' `kid14' `kid15')
			label var ``i'' "13세 ~ 15세 자녀 수"
			}
			
			* 5-4번 : 가구원 수 
			else if "``i''"=="h_num" {					
				gen   ``i''=h`v'0150				
				label var ``i'' "가구원 수 " 		
			}			
										
			* 5-5번 : 가구주 혼인상태  
			else if "``i''"=="h_hmarital" {							
				gen ``i''=p`v'5501
				mvdecode ``i'' , mv(9=.) 
				recode ``i'' (1=1) (2=2) (3/5=3)  				
				label var ``i'' "혼인상태(1=미혼,2=기혼유배우  3=기혼무배우) " 			
			}
			
			* 5-6번 : 가구주 교육수준   
			else if "``i''"=="h_hedu" {		
					local j1=1
					foreach edu of varlist h`v'0661-h`v'0675 {
					tempvar edu`j1'
					rename `edu' `edu`j1''
					local ++j1
					}
					local j2=1
					foreach edu0 of varlist h`v'0681-h`v'0695 {
					tempvar edu0`j2'
					rename `edu0' `edu0`j2''
					local ++j2
					}
										
			    tempvar aa bb 
			    gen `aa'=.
				gen `bb'=.
				foreach n of num 1/15 {
				replace `aa'=`edu`n'' if `head`n''==10
				replace `bb'=`edu0`n'' if `head`n''==10
				}  	
				
				gen ``i''=. if `aa'==1 
				replace ``i''=1 if `aa'==2
				replace ``i''=2 if `aa'==3 | `aa'==4
				replace ``i''=2 if `aa'==5 & `bb'!=1 
				replace ``i''=3 if `aa'==5 & `bb'==1 
				replace ``i''=3 if (`aa'==6 | `aa'==7) & `bb'!=1
				replace ``i''=4 if `aa'==6 & `bb'==1 
				replace ``i''=5 if `aa'==7 & `bb'==1 
				replace ``i''=5 if `aa'==8 | `aa'==9
				
				label var ``i'' "가구주 학력(1=무학. 2=고졸미만. 3=고졸, 4=전문대졸, 5=대졸이상)"			
			}
							
			* 6번 : 이전소득 
			else if "``i''"=="h_inc_1" {
			   gen ``i''=`inc1'	
			   recode ``i'' (0=.)
			   label var ``i'' "이전소득(단위: 만원)"				   
			 } 	
					
			* 7번 : 사회보험  
			else if "``i''"=="h_inc_2" {
			     gen ``i''=`inc2'
				 recode ``i'' (0=.)
				 label var ``i'' "사회보험 소득(단위: 만원)" 				 
 			  }
			   
		    * 8번 
			else if "``i''"=="h_inc_3" {			
			   gen ``i''=`inc3'
			   recode ``i'' (0=.)
			   label var ``i'' "기타 소득(단위: 만원) "				
 			  }
		
			* 9번 : 근로소득 
			
				else if "``i''"=="h_inc_4" {
						gen ``i''=`inc4'
						recode ``i'' (0=.)
						label var ``i'' "근로소득(단위: 만원)"  				
				}
			
			* 10번 : 금융소득 			
				else if "``i''"=="h_inc_5"  {				
				gen ``i''=`inc5'
				recode ``i'' (0=.)
				label var ``i'' "금융소득(단위: 만원)" 				
				}
				
				* 11번 : 부동산 소득  
				else if "``i''"=="h_inc_6" {				
				gen ``i''=`inc6'
				recode ``i'' (0=.)
				label var ``i'' "부동산소득(단위: 만원)" 				
				}
									
			* 12번 : 총 소득 
				else if "``i''"=="h_inc_total" {				    
					gen ``i''=`inc7'
					label var ``i'' "총소득(6개항목 소득 합계, 단위: 만원)" 
			    }
				
			* 13번 : 금융자산  
			    else if "``i''"=="h_asset_1" {
			     
				    if "`v'"=="01" {
							tempvar h`v'2562 h`v'2564 h`v'2566 h`v'2568 h`v'2570 h`v'2572
							gen `h`v'2562'=. 
							gen `h`v'2564'=. 
							gen `h`v'2566'=. 
							gen `h`v'2568'=. 
							gen `h`v'2570'=. 
							gen `h`v'2572'=. 	  
							mvdecode `h`v'2562' `h`v'2564' `h`v'2566' `h`v'2568' `h`v'2570' `h`v'2572', mv(-1 999999 99999 9999=.)
							egen   ``i''=rowtotal(`h`v'2562' `h`v'2564' `h`v'2566' `h`v'2568' `h`v'2570' `h`v'2572') , miss
			        }
					
					else {
							mvdecode h`v'2562 h`v'2564 h`v'2566 h`v'2568 h`v'2570 h`v'2572, mv(-1 999999 99999 9999=.)
							egen   ``i''=rowtotal(h`v'2562 h`v'2564 h`v'2566 h`v'2568 h`v'2570 h`v'2572) , miss
					}
					recode ``i'' (0=.)					
					label var ``i'' "금융자산(단위: 만원)" 
					
				}
				
				* 14번 : 거주주택 이외 부동산 자산 : 임대보증금은 부채로 계산한다.
				 // 1차년도는 해당변수가 없기 때문에 결측치로 모두 처리한다. 
				else if "``i''"=="h_asset_2_1" {
			        if "`v'"=="01"   {    
							gen ``i''=.
					}
					
					else if "`v'"=="02"  {					
							mvdecode h`v'2512, mv(-1 999999 99999 9999=.)
							replace h`v'2512=. if h`v'2501==2 // 아니오 라고 답한 사람은 모두 결측치로 처리함 
							tempvar real1 
							gen   `real1'=. 
							replace `real1'=h`v'2512
							gen ``i''=`real1'				
					}
					
					
		            else  {					
							mvdecode h`v'2512, mv(-1 999999 99999 9999=.)
							replace h`v'2512=. if h`v'2501==2 // 아니오 라고 답한 사람은 모두 결측치로 처리함 
							tempvar real1 
							gen   `real1'=. 
							replace `real1'=h`v'2512
							gen ``i''=`real1'				
					}
										
					label var ``i'' "부동산자산(거주주택 제외): 연속형 (단위: 만원) 1차년도는 모두 결측치 "
					recode ``i'' (0=.)
				}
				
				* 14_1번 : 거주주택 이외 부동산 자산 :범주형 
			      else if "``i''"=="h_asset_2_2"  {
			        if "`v'"=="01"   {    
						gen ``i''=.
					}
					
					else if "`v'"=="02"  {					
							mvdecode h`v'2513, mv(-1 999999 99999 9999=.)
							tempvar real1 
							gen `real1'=. 
							replace `real1'=1 if h`v'2513==1
							replace `real1'=2 if h`v'2513==2
							replace `real1'=3 if h`v'2513==4
							replace `real1'=4 if h`v'2513==6
							replace `real1'=5 if h`v'2513==10
							replace `real1'=6 if h`v'2513==11
							gen ``i''=`real1' 					
					}
					
					
		            else  {					
							mvdecode h`v'2513, mv(-1 999999 99999 9999=.)
							tempvar real1 
							gen   `real1'=. 
							replace `real1'=1 if h`v'2513==1
							replace `real1'=2 if h`v'2513>=2 & h`v'2513<=3 
							replace `real1'=3 if h`v'2513>=4 & h`v'2513<=5
							replace `real1'=4 if h`v'2513>=6 & h`v'2513<=9 
							replace `real1'=5 if h`v'2513==10
							replace `real1'=6 if h`v'2513==11
												
							gen ``i''=`real1' 			
					}
										
					label var ``i'' "부동산자산(거주주택 제외): 범주형, 1차년도는 모두 결측치, 1=1천만원미만 2=1천~5천만원미만, 3=5천~1억원미만 4=1억~5억원미만 5=5억~10억원미만, 6=10억이상" 
				}
				
				
				* 14번 : 임차보증금(연속형) 
				 // 1차년도는 해당변수가 없기 때문에 결측치로 모두 처리한다. 
				 else if "``i''"=="h_asset_3_1" {
			        if "`v'"=="01"   {    
					gen ``i''=.
					}
					
					else if "`v'"=="02"  {																			
							mvdecode h`v'2542, mv(-1 999999 99999 9999=.)
							replace h`v'2542=. if h`v'2531==2  
							tempvar real2 
							gen   `real2'=. 
							replace `real2'=h`v'2542
							gen ``i''=`real2'
					}
					
					
		            else  {															
							mvdecode h`v'2542, mv(-1 999999 99999 9999=.)
							replace h`v'2542=. if h`v'2531==2  
							tempvar real2 
							gen   `real2'=. 
							replace `real2'=h`v'2542																					
							gen ``i''=`real2'
					}
										
					label var ``i'' "임차보증금(연속형)" 
					recode ``i'' (0=.)
				}
				
				* 14_1번 :임차보증금 (범주형 ) 
				 else if "``i''"=="h_asset_3_2" {
			        if "`v'"=="01"   {    
						gen ``i''=.
					}
					
					else if "`v'"=="02"  {					
							mvdecode h`v'2543, mv(-1 999999 99999 9999=.)
							tempvar real1 
							gen `real1'=. 
							replace `real1'=1 if h`v'2543==1
							replace `real1'=2 if h`v'2543==2
							replace `real1'=3 if h`v'2543==4
							replace `real1'=4 if h`v'2543==6
							replace `real1'=5 if h`v'2543==10
							replace `real1'=6 if h`v'2543==11
							gen ``i''=`real1' 					
					}
					
					
		            else  {					
							mvdecode h`v'2543, mv(-1 999999 99999 9999=.)
							tempvar real1 
							gen  `real1'=. 
							replace `real1'=1 if h`v'2543==1
							replace `real1'=2 if h`v'2543>=2 & h`v'2543<=3 
							replace `real1'=3 if h`v'2543>=4 & h`v'2543<=5
							replace `real1'=4 if h`v'2543>=6 & h`v'2543<=9 
							replace `real1'=5 if h`v'2543==10
							replace `real1'=6 if h`v'2543==11												
							gen ``i''=`real1' 				
					}										
					label var ``i'' "임차보증금: 범주형, 1차년도 결측치, 1=1천만원미만 2=1천~5천만원미만, 3=5천~1억원미만 4=1억~5억원미만 5=5억~10억원미만, 6=10억이상" 
				}
			
			   * 16번 : 부채 총액 : 임대보증금 포함 
				else if "``i''"=="h_debt_total" {
						if "`v'"=="01" {	
						tempvar h`v'2605 h`v'2608 h`v'2611 h`v'2614 h`v'2617
						gen `h`v'2605'=. 
						gen `h`v'2608'=. 
						gen `h`v'2611'=. 
						gen `h`v'2614'=. 
						gen `h`v'2617'=. 					
						mvdecode h`v'2602 `h`v'2605' `h`v'2608' `h`v'2611' `h`v'2614' `h`v'2617' , mv(-1 999999 99999 9999=.)		
						egen   ``i''=rowtotal(h`v'2602 `h`v'2605' `h`v'2608' `h`v'2611' `h`v'2614' `h`v'2617') , miss	
				}
				
				else {
						mvdecode h`v'2602 h`v'2605 h`v'2608 h`v'2611 h`v'2614 h`v'2617 , mv(-1 999999 99999 9999=.)		
						egen   ``i''=rowtotal(h`v'2602 h`v'2605 h`v'2608 h`v'2611 h`v'2614 h`v'2617) , miss	
				}									
			label var ``i'' "부채 총액(임대보증금 포함), 단위: 만원 " 
			recode ``i'' (0=.)
			}
			
			
						
			* 17번 : 부채 상환액 
			else if "``i''"=="h_debt_pay" {
				if "`v'"=="01" {	
						tempvar h`v'2606 h`v'2609 h`v'2612 h`v'2615 h`v'2618
						gen `h`v'2606'=. 
						gen `h`v'2609'=. 
						gen `h`v'2612'=. 
						gen `h`v'2615'=. 
						gen `h`v'2618'=.  					
						mvdecode h`v'2603 `h`v'2606' `h`v'2609' `h`v'2612' `h`v'2615' `h`v'2618' , mv(-1 999999 99999 9999=.)		
						egen   ``i''=rowtotal(h`v'2603 `h`v'2606' `h`v'2609' `h`v'2612' `h`v'2615' `h`v'2618' ) , miss	
				}
				
				else {
						mvdecode h`v'2603 h`v'2606 h`v'2609 h`v'2612 h`v'2615 h`v'2618, mv(-1 999999 99999 9999=.)		
						egen   ``i''=rowtotal(h`v'2603 h`v'2606 h`v'2609 h`v'2612 h`v'2615 h`v'2618) , miss	
				}									
			label var ``i'' "부채 상환액(단위: 만원)  " 
			recode ``i'' (0=.)
			} 
			
			* 18번: 0세 ~ 고등학교 자녀수 : 
			else if "``i''"=="h_kid" {
			    if "`v'"~="02" {	
			    gen ``i''=h`v'1502 if h`v'1501==1 
				replace ``i''=0 if h`v'1501==2 
				recode ``i'' (99=.) 
				}
				
				else {
				gen ``i''=. 
				}
				label var ``i'' "0세 ~ 고등학교 자녀수"
			}	
			
			* 가중치 변수 (98표본) 
			else if "``i''"=="h_weight_1" {
				gen   ``i''=w`v'h
				label var ``i'' "98표본 가구가중치" 
			}
			
			* 가중치 변수 (통합표본) 
			else if "``i''"=="h_weight_2" {
			    if "`v'"=="12" |"`v'"=="13" | "`v'"=="13" | "`v'"=="14"| "`v'"=="15" | "`v'"=="16"| "`v'"=="17" | "`v'"=="18" | "`v'"=="19"| "`v'"=="20" | "`v'"=="21" {
				gen   ``i''=sw`v'h				
				}
				
				else {
				gen   ``i''=.
				}
				label var ``i'' "통합표본 가구가중치" 
			}	
			
			* 소득10분위 
			else if "``i''"=="h_incomeq" {
				gen ``i''=`inc8'
				label var ``i'' "소득10분위"  
			}		
			
			* equivalence scale 변수 : original
			else if "``i''"=="h_eqscale_ori" {
				gen ``i''=1+0.7*(`h_num_total'-`h_num_kid'-1)+0.5*`h_num_kid'
				label var ``i'' "OECD 가구균등화지수_orginal(1+0.7*(number of adults-1)+0.5*number of children under 14)"  
			}	
			
			* equivalence scale 변수 : modified 
			else if "``i''"=="h_eqscale_mod" {
				gen ``i''=1+0.5*(`h_num_total'-`h_num_kid'-1)+0.3*`h_num_kid'
				label var ``i'' "OECD 가구균등화지수_modified(1+0.5*(number of adults-1)+0.3*number of children under 14)" 
			}				
			
			* sample98			
			else if "``i''"=="h_sample98" {
				gen   ``i''=sample98				
				label var ``i'' "98원가구 여부(1=98원가구, 2=분가가구,3=조사대상아님) " 
			}
			
			* sample09
			else if "``i''"=="h_sample09" {
			    if "`v'"=="12" |"`v'"=="13" | "`v'"=="13" | "`v'"=="14"| "`v'"=="15"| "`v'"=="16"| "`v'"=="17" | "`v'"=="18" | "`v'"=="19" | "`v'"=="20" | "`v'"=="21" {
				gen   ``i''=sample09
				}
				
				else {
				gen   ``i''=.
				}
				label var ``i'' "통합표본 원가구여부(1=통합표본원가구, 2=분가가구, 3=조사대상아님)" 
			}				
					
			* error message 
		    else {
	     	di as err "``i'' is not supposed to be on the new variable list" 
			}
				
		}   // the end of "i" loop
			
			gen wave="`v'"
			gen wave1=real(wave)
			drop wave
			rename wave1 wave 
			label var wave "서베이차수" 
		    gen year=wave+1997
			label var year "조사년도"
			rename hhid`v' hhid 
			drop if hhid==. 
			label var hhid "가구id"  
			keep hhid wave year `varlist'
				        			
	tempfile klips`v'h_1 
	save "`klips`v'h_1'", replace 
	}	
	
	qui if r(NW)==1 {
		  foreach v of local v1   {
		  use "`klips`v'h_1'", clear
		  tsset hhid wave 
		  capture drop __*
		  compress
		  save klips_h_final, replace    
		 }
	}
	
	qui else {
			 local v2=substr("`v1'", 1,2) 
			 use "`klips`v2'h_1'", clear 
			 local v3=substr("`v1'",4, .)
				 
			 foreach v of local v3  {
			 append using "`klips`v'h_1'" 
			 }
			 aorder 
			 order hhid
			 order wave ,after(hhid) 
			 capture drop __*
			 order hhid wave year 
			 tsset hhid wave
			 compress
			 format hhid %15.0g
			 save klips_h_final, replace 	
			 
	}
		
	if "`wide'"=="wide" {
		capture drop year 
		reshape wide h_* , i(hhid) j(wave)
		aorder 
		order hhid 
		capture drop __*
		compress
		save klips_h_final_`wide', replace 
	}		 
	end 
	 
 