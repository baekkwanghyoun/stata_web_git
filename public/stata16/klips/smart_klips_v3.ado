/*=============================================
가구패널과 개인패널 합치기
2014-01-17
smart_klips 명령어

2015-09-03 작업
2017-06-30: 19차 업데이트
2018-06-29: 20차 업데이트
2019-10-15: 21차 업데이터
2019-11-09: Version 3 (21차 까지 사용)
2020-11-06: Web버전을 위한 수정
2020-11-09: 22차 까지 업데이트
2021-02-01: KLI 요청사항 업데이트
2021-04-09: 제이슨티지 인찬호 codebook zip 파일처리 변경
2021-05-17: 제이슨티지 인찬호 소스 줄 맞춤(tab ==> space(4) 변경 
                       zip파일 처리 수정
==============================================*/
	program define smart_klips_v3, rclass
	version 14.0
	clear
	set more off
    syntax newvarlist(min=1 max=200 numeric generate) , [wd(string) website(string) save(string) add_h(string) add_p(string) add_a1(string) add_a2(string) add_a3(string) a1_wave(string) a2_wave(string) a3_wave(string) excel csv ] wave(string)

	/*================================================================*/
	* error message displayed
	if  "`add_a1'"==""&   "`add_a2'"~=""& "`add_a3'"=="" {
        di as err "부가조사 변수를 선택하는 경우 반드시 [첫 번째 부가조사 메뉴](add_a1 & a1_wave 옵션)부터 사용해야 합니다"
        exit _rc
	}

	else if  "`add_a1'"==""&   "`add_a2'"==""& "`add_a3'"~="" {
        di as err "부가조사 변수를 선택하는 경우 반드시 [첫 번째 부가조사 메뉴](add_a1 & a1_wave 옵션)부터 사용해야 합니다"
        exit _rc
	}

	else if  "`add_a1'"==""&   "`add_a2'"~=""& "`add_a3'"~="" {
        di as err "부가조사 변수를 선택하는 경우 반드시 [첫 번째 부가조사 메뉴](add_a1 & a1_wave 옵션)부터 사용해야 합니다"
        exit _rc
	}

	/*================================================================*/
     /* local wlist ""
   foreach www in `wave' {
       if regexm("`www'","-") {
          local first=real(ustrleft("`www'",2))
          local last=real(ustrright("`www'",2))
          local list0 ""
          forvalues zz=`first'/`last' {
              local zz1=string(`zz', "%02.0f")
              local list0 `list0' `zz1'
          }  // forvalues
          local wlist `wlist' `list0'
       }  // hyphen

       else {
          local wlist `wlist' `www'
       }

   }  // foreach

    local wave "`wlist'" */

    * 새로운 코드 : 2020-12-17
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

	/*=====================================================================*/

	*global StatTransfer_path `"C:\Program Files\StatTransfer13-64\st64w.exe"'
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

	/*=================================================================================*/
	* add_h와 add_p에 변수가 있는 경우
	if "`add_h'"~="" {
	    if "`website'"=="" {
			smart_klips_add_h_v3 `add_h' , wd(`wd') wave(`wave')
	    }
		else {
			smart_klips_add_h_v3 `add_h' , wd(`wd') wave(`wave')  website(`website')
		}
	}

	if "`add_p'"~="" {
		if "`website'"=="" {
			smart_klips_add_p_v3 `add_p' , wd(`wd') wave(`wave')
	    }
		else {
			smart_klips_add_p_v3 `add_p' , wd(`wd') wave(`wave')  website(`website')
		}

	}

	/*========================================
	2020-11-05 수정
	==========================================*/

	if "`add_a1'"~="" {
		if "`website'"=="" {
			smart_klips_add_a`a1_wave'_v3 `add_a1' , wd(`wd')
			smart_klips_p_v3 p_sex ,  wd(`wd') wave(`a1_wave')
	    }
		else {
			smart_klips_add_a`a1_wave'_v3 `add_a1' , wd(`wd') website(`website')
			smart_klips_p_v3 p_sex ,  wd(`wd') wave(`a1_wave')	 website(`website')
		}

			use klips_add_a`a1_wave', clear
			merge 1:1 pid wave using klips_p_final
			drop if _m==2
			drop _m
			drop p_sex
			save klips_add_a`a1_wave', replace

	}


	if "`add_a2'"~="" {
		if "`website'"=="" {
			smart_klips_add_a`a2_wave'_v3 `add_a2' , wd(`wd')
			smart_klips_p_v3 p_sex ,  wd(`wd') wave(`a2_wave')
	    }
		else {
			smart_klips_add_a`a2_wave'_v3 `add_a2' , wd(`wd') website(`website')
			smart_klips_p_v3 p_sex ,  wd(`wd') wave(`a2_wave')	website(`website')
		}

		use klips_add_a`a2_wave', clear
			merge 1:1 pid wave using klips_p_final
			drop if _m==2
			drop _m
			drop p_sex
			save klips_add_a`a2_wave', replace

	}

	if "`add_a3'"~="" {
		if "`website'"=="" {
			smart_klips_add_a`a3_wave'_v3 `add_a3' , wd(`wd')
			smart_klips_p_v3 p_sex ,  wd(`wd') wave(`a3_wave')

	    }
		else {
			smart_klips_add_a`a3_wave'_v3 `add_a3' , wd(`wd') website(`website')
			smart_klips_p_v3 p_sex ,  wd(`wd') wave(`a3_wave') website(`website')
		}

		use klips_add_a`a3_wave', clear
        merge 1:1 pid wave using klips_p_final
        drop if _m==2
        drop _m
        drop p_sex
        save klips_add_a`a3_wave', replace
	}



    if  "`add_a1'"~=""&   "`add_a2'"==""& "`add_a3'"=="" {
		use klips_add_a`a1_wave', clear
		save klips_add_a, replace

	}
	else if  "`add_a1'"~=""&   "`add_a2'"~=""& "`add_a3'"=="" {
		use klips_add_a`a1_wave', clear
		append using klips_add_a`a2_wave', force
		save klips_add_a, replace

	}
	else if  "`add_a1'"~=""&   "`add_a2'"~=""& "`add_a3'"~="" {
		use klips_add_a`a1_wave', clear
		append using klips_add_a`a2_wave', force
		append using klips_add_a`a3_wave', force
		save klips_add_a, replace

	}

	/*=================================================================================*/
	* Case 1  : p만 있는 경우
	if `Nhlist'==0 & `Nplist'~=0 {

        if "`website'"=="" {
            smart_klips_p_v3 `plist' , wd(`wd') wave(`wave')
        }
        else {
            smart_klips_p_v3 `plist' , wd(`wd') wave(`wave') website(`website')
        }
        order pid
        save klips_final, replace

		/*
       if "`wide'"=="wide" {
          if "`website'"=="" {
              smart_klips_p_v3 `plist' , wd(`wd') wave(`wave') wide
          }
          else {
              smart_klips_p_v3 `plist' , wd(`wd') wave(`wave') wide website(`website')
          }
          save klips_final_`wide', replace
		}
       */

    }

    * Case 2 : h만 있는 경우
    else if `Nplist'==0 & `Nhlist'~=0 {

        if "`website'"=="" {
            smart_klips_h_v3 `hlist' , wd(`wd') wave(`wave')
        }

        else {
            smart_klips_h_v3 `hlist' , wd(`wd') wave(`wave') website(`website')
        }
        save klips_final, replace

        /*
       if "`wide'"=="wide" {
          if "`website'"=="" {
              smart_klips_h_v3 `hlist' , wd(`wd') wave(`wave') wide
          }
          else {
              smart_klips_h_v3 `hlist' , wd(`wd') wave(`wave') wide  website(`website')
          }
          save klips_final_wide, replace
       }
       */
    }
    * Case 3 : h와 p가 모두 있는 경우
    else if  `Nhlist'~=0 & `Nplist'~=0  {

        if "`website'"=="" {
            smart_klips_h_v3 `hlist' , wd(`wd') wave(`wave')
            smart_klips_p_v3 `plist' , wd(`wd') wave(`wave')
        }
        else {
            smart_klips_h_v3 `hlist' , wd(`wd') wave(`wave') website(`website')
            smart_klips_p_v3 `plist' , wd(`wd') wave(`wave') website(`website')
        }

        use klips_h_final,clear
        merge 1:m hhid wave using klips_p_final, nogen
        aorder
        order pid hhid wave year
        sort  pid hhid wave
        save klips_final, replace
        /*
       if "`wide'"=="wide" {
            capture drop year
            drop if pid==.
            reshape wide hhid h_* p_*, i(pid) j(wave)
            aorder
            order pid hhid*

            save klips_final_`wide', replace
       }
       */
    }

    /*=============================================================================*/
    * 기본 파일과 add 파일의 merge

    use klips_final, clear
    qui ds
    local aaa1=regexm(r(varlist), "hhid")
    local aaa2=regexm(r(varlist), "pid")
    local aaa3=`aaa1'+`aaa2'
    if `aaa3'==1 {
        local mastertype "h"
    }
    else if `aaa3'==2 {
        local mastertype "p"
    }

    * case 1: 기본 파일에 h만 있는 경우
    if "`mastertype'"=="h" {
        * case 1-1 : add_h만 있는 경우 (1 0 0)
        if "`add_h'"~=""& "`add_p'"=="" & "`add_a1'"==""  {
                merge 1:1 hhid wave using klips_add_h, nogen
                order hhid wave
                sort hhid wave
                drop if hhid==.
                *save klips_final_add, replace
        }

        * case 1-2: add_p만 있는 경우 (0 1 0)
        if "`add_h'"==""& "`add_p'"~=""& "`add_a1'"==""  {
                merge 1:m hhid wave using klips_add_p, nogen
                order hhid pid wave
                sort pid wave
                drop if pid==.
                *save klips_final_add, replace
        }

        * case 1-2-1: add_p & add_a1 있는 경우 (0 1 1)
        if "`add_h'"==""& "`add_p'"~=""& "`add_a1'"~=""  {
                merge 1:m hhid wave using klips_add_p, nogen
                merge 1:1 pid wave using klips_add_a, nogen
                order hhid pid wave
                sort pid wave
                drop if pid==.
                *save klips_final_add, replace
        }


        * case 1-3 : add-h, add-p가 모두 있는 경우
        if "`add_h'"~=""& "`add_p'"~="" & "`add_a1'"==""  {
                merge 1:1 hhid wave using klips_add_h, nogen
                merge 1:m hhid wave using klips_add_p, nogen
                order hhid pid wave
                sort pid wave
                drop if pid==.
                *save klips_final_add, replace
        }

        * case 1-3-1 : add-h, add-p, add-a가 모두 있는 경우
        if "`add_h'"~=""& "`add_p'"~="" & "`add_a1'"~=""  {
                merge 1:1 hhid wave using klips_add_h, nogen
                merge 1:m hhid wave using klips_add_p, nogen
                merge 1:1 pid wave using klips_add_a, nogen
                order hhid pid wave
                sort pid wave
                drop if pid==.
                *save klips_final_add, replace
        }

        /*====================
        * 2020-11-06 수정사항
        ======================*/
        *case 1-4 : add-h와 add_a만 있는 경우
        * 순서가 매우 중요하다.
        if "`add_h'"~=""& "`add_p'"==""& "`add_a1'"~="" {
                merge 1:1 hhid wave using klips_add_h, nogen
                merge 1:m hhid wave using klips_add_a, nogen
                order hhid pid wave
                sort hhid pid wave
                *drop if pid==.
                *save klips_final_add, replace
        }

        *case 1-4-1 : add_a만 있는 경우
        if "`add_h'"==""& "`add_p'"==""& "`add_a1'"~="" {
                merge 1:m hhid wave using klips_add_a, nogen
                order hhid pid wave
                sort hhid pid wave
                *drop if pid==.
                *save klips_final_add, replace
        }
        /*============================================================*/

            * case 1-5 :add-a, add-h, add-p 모두 없는 경우
            if "`add_h'"==""& "`add_p'"=="" & "`add_a1'"=="" {
                *save klips_final_add , replace
            }

    }  // case 1

    /*=======================================================================*/
    * case 2: 기본파일에 p(또는 h and p)만 있는 경우
    if "`mastertype'"=="p" {
        * case 1-1 : add_h만 있는 경우
        if "`add_h'"~=""& "`add_p'"==""& "`add_a1'"==""  {
            drop if pid==.
            merge m:1 hhid wave using klips_add_h, nogen
            order hhid pid wave
            sort  pid wave
            drop if hhid==.
            *save klips_final_add, replace
        }

        * case 1-1-1: h와 a1이 있는 경우
        if "`add_h'"~=""& "`add_p'"==""& "`add_a1'"~=""  {
            drop if pid==.
            merge m:1 hhid wave using klips_add_h, nogen
            merge 1:1 pid wave using klips_add_a, nogen
            order hhid pid wave
            sort  pid wave
            drop if hhid==.
            *save klips_final_add, replace
        }


        * case 1-2: add_p만 있는 경우
        if "`add_h'"==""& "`add_p'"~=""& "`add_a1'"=="" {
            drop if pid==.
            merge 1:1 pid wave using klips_add_p, nogen
            order hhid pid wave
            sort pid wave
            drop if pid==.
            *save klips_final_add, replace
        }

        * case 1-2-1: add_p and add_a가 있는 경우
        if "`add_h'"==""& "`add_p'"~=""& "`add_a1'"~="" {
            drop if pid==.
            merge 1:1 pid wave using klips_add_p, nogen
            merge 1:1 pid wave using klips_add_a, nogen
            order hhid pid wave
            sort pid wave
            drop if pid==.
            *save klips_final_add, replace
        }


        * case 1-3: add_p와 add_h가 모두 있는 경우
        if "`add_h'"~=""& "`add_p'"~=""& "`add_a1'"==""  {
            drop if pid==.
            merge 1:1 pid wave using klips_add_p, nogen
            merge m:1 hhid wave using klips_add_h, nogen

            order hhid pid wave
            sort pid wave
            drop if pid==.
            *save klips_final_add, replace
        }

        * case 1-3-1 : add_p, add_h, add_a가 모두 있는 경우
        if "`add_h'"~=""& "`add_p'"~=""& "`add_a1'"~=""  {
            drop if pid==.
            merge 1:1 pid wave using klips_add_p, nogen
            merge m:1 hhid wave using klips_add_h, nogen
            merge 1:1 pid wave using klips_add_a, nogen

            order hhid pid wave
            sort pid wave
            drop if pid==.
            *save klips_final_add, replace
        }

        * case 1-4:add_a만 있는 경우
        if "`add_h'"==""& "`add_p'"==""& "`add_a1'"~="" {
            drop if pid==.
            merge 1:1 pid wave using klips_add_a, nogen

            order hhid pid wave
            sort pid wave
            drop if pid==.
            *save klips_final_add, replace
        }

        *case 1-5: add*가 모두 없는 경우
        if "`add_h'"==""& "`add_p'"==""& "`add_a1'"=="" {
            *save klips_final_add , replace
        }

    }  // case 2


    capture label var h0141 "현주소(광역시/도)"
    capture label var h0142 "현주소(시/군/구)"

    snapshot save
    local snum=r(snapshot)
    qui ds, has(varlabel "")
    local m=wordcount("`wave'")
    local mm=word("`wave'",`m')

    foreach v22 in `r(varlist)' {

        if ustrleft("`v22'",1)=="p" {
            if "`website'"=="" {
                qui cd "`wd'"
                use klips`mm'p, clear
            }
            else if "`website'"~="" {
                use `website'/klips`mm'p, clear
            }
            local a1=substr("`v22'",1,1)
            local a2=substr("`v22'",2,.)
            local ccc=substr("`v22'",1,2)
            local a3="`a1'"+"`mm'"+"`a2'"
            if "`ccc'"=="pa" {
                local a1=substr("`v22'",1,2)  // 시작이 pa인 경우
                local a2=substr("`v22'",3,.)
                local a3="`a1'"+"`mm'"+"`a2'"
            }
            capture {
                local v33_p: variable label `a3'
            }
            snapshot restore `snum'
            label variable `v22' "`v33_p'"
            snapshot save
            local snum=r(snapshot)
        }  // p 변수

        else if ustrleft("`v22'",1)=="h" {
            if "`website'"=="" {
                qui cd "`wd'"
                use klips`mm'h, clear
            }
            else if "`website'"~="" {
                use `website'/klips`mm'h, clear
            }
            local a1=substr("`v22'",1,1)
            local a2=substr("`v22'",2,.)
            local a3="`a1'"+"`mm'"+"`a2'"

            capture {
                local v33: variable label `a3'
            }
            snapshot restore `snum'
            label variable `v22' "`v33'"
            snapshot save
            local snum=r(snapshot)
        }

    }    // h 변수

    save klips_final_add , replace

    /*=============================================================================*/
    if "`save'"==""  & "`excel'"=="excel" {
        export excel using "klips_final_add.xlsx", replace first(variable)
    }
    if "`save'"==""  &  "`csv'"=="csv" {
        export delimited using "klips_final_add.csv", replace
    }


    if "`save'"~=""  {
        save `save', replace
        capture erase klips_final_add.dta
        if "`excel'"=="excel" {
            export excel using "`save'.xlsx", replace first(variable)
        }
        if "`csv'"=="csv" {
            export delimited using "`save'.csv", replace
        }

    }
/*==========================================================*/
    snapshot save
    local snum300=r(snapshot)

    qui ds
    local varlist2 `r(varlist)'
    local nn=wordcount("`varlist2'")

    capture drop vname
    capture drop lname
    gen vname=""
    gen str50 lname=""

    forvalues i=1(1)`nn'  {
        local Y: word `i' of `varlist2'
        local Z: variable label `Y'
        replace vname="`Y'" in `i'
        replace lname="`Z'" in `i'
    }

    keep vname lname
    drop if vname==""
  /* ==================================================================================
   * 2021-04-09  제이슨티지 인찬호 codebook zip 파일처리 변경 시작
   * ================================================================================== */
    quietly {
        if "`save'"=="" {
             export excel using "klips_final_codebook.xlsx", replace first(variable)
             export delimited using "klips_final_var.csv", replace
             unicode convertfile klips_final_var.csv klips_final_codebook.csv, dstencoding(cp949) replace
             capture erase klips_final_var.csv
        }
        if "`save'" ~= "" {
             export excel using "`save'_codebook.xlsx", replace first(variable)
             export delimited using "`save'_var.csv", replace
             unicode convertfile "`save'_var.csv" "`save'_codebook.csv", dstencoding(cp949) replace
             capture erase "`save'_var.csv"
        }
    }
   /* ==================================================================================
   * 2021-04-09  제이슨티지 인찬호 codebook zip 파일처리 변경 종료
   * ================================================================================== */
   snapshot restore `snum300'
   /*=====================================================================*/

    capture    erase klips_h_final.dta
    capture    erase klips_p_final.dta
    capture    erase klips_add_h.dta
    capture    erase klips_add_p.dta
    capture    erase klips_add_a.dta
    // capture    erase klips_final.dta
    capture    erase klips_add_a03.dta
    capture    erase klips_add_a04.dta
    capture    erase klips_add_a06.dta
    capture    erase klips_add_a07.dta
    capture    erase klips_add_a08.dta
    capture    erase klips_add_a09.dta
    capture    erase klips_add_a10.dta
    capture    erase klips_add_a11.dta
    capture    erase klips_add_a17.dta
    capture    erase klips_add_a18.dta
    capture    erase klips_add_a19.dta
    capture    erase klips_add_a20.dta
    capture    erase klips_add_a21.dta
    capture    erase klips_add_a22.dta

    /* ==================================================================================
    * 2021-05-17 제이슨티지 인찬호 zip처리 로직 변경 시작 
    *                       dta 파일과 codebook파일(xlsx, csv파일이 항상 저장 가능하게 수정
    * ================================================================================== */
    quietly {
        if "`save'" ~= "" {
            if "`csv'"=="" {
                
            }
            zipfile    "`save'.dta" "`save'.xlsx" "`save'.csv" "`save'_codebook.xlsx" "`save'_codebook.csv", saving ("`save'.zip", replace )
            capture    erase "`save'.dta"
            capture    erase "`save'.xlsx"
            capture    erase "`save'_codebook.xlsx"
            capture    erase "`save'.csv"
            capture    erase "`save'_codebook.csv"
            capture    erase klips_final.dta
        }
        if "`save'" == "" {
            capture    erase "klips_final_add.dta"
            zipfile    "klips_final.dta" "klips_final.xlsx" "klips_final.csv" "klips_final_codebook.xlsx" "klips_final_codebook.csv", saving ("klips_final.zip", replace )
            capture    erase "klips_final.dta"
            capture    erase "klips_final.xlsx"
            capture    erase "klips_final_add.xlsx"
            capture    erase "klips_final_codebook.xlsx"
            capture    erase "klips_final.csv"
            capture    erase "klips_final_add.csv"
            capture    erase "klips_final_codebook.csv"
        }
        /* =============================================================================
        * 2021-04-09  제이슨티지 인찬호 codebook zip 파일처리 추가 시작
        * =============================================================================
        * if "`save'" ~= "" {
        *     if "`csv'"==""  &  "`excel'"=="" {
        *          zipfile    "`save'*.*", saving ("`save'.zip", replace )
        *          capture    erase "`save'.dta"
        *     } 
        *     if "`csv'"~=""  ||  "`excel'"~="" {
        *          capture    erase "`save'.dta"
        *          zipfile    "`save'*.*", saving ("`save'.zip", replace )
        *     }
        *     capture    erase "`save'.xlsx"
        *     capture    erase "`save'_codebook.xlsx"
        *     capture    erase "`save'.csv"
        *     capture    erase "`save'_codebook.csv"
        *     capture    erase klips_final.dta
        * } 
        * 
        * if "`save'" == "" {
        *     capture    erase "klips_final_add.dta"
        *     if "`csv'"==""  &  "`excel'"=="" {
        *          zipfile    "klips_final*.*", saving ("klips_final.zip", replace )
        *          capture    erase "klips_final.dta"
        *     }
        *     if "`csv'"~=""  ||  "`excel'"~="" {
        *          capture    erase "klips_final.dta"
        *          zipfile    "klips_final*.*", saving ("klips_final.zip", replace )
        *     }
        *     capture    erase "klips_final.xlsx"
        *     capture    erase "klips_final_add.xlsx"
        *     capture    erase "klips_final_codebook.xlsx"
        *     capture    erase "klips_final.csv"
        *     capture    erase "klips_final_add.csv"
        *     capture    erase "klips_final_codebook.csv"
        * } 
        * =============================================================================
        * 2021-04-09  제이슨티지 인찬호 codebook zip 파일처리 추가 종료
   * ==================================================================================
   * 2021-05-17 제이슨티지 인찬호 zip처리 로직 변경 종료
   * ================================================================================== */
   }
end