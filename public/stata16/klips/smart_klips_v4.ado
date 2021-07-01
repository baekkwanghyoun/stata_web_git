cap program drop smart_klips_v4
program define smart_klips_v4
	syntax anything, [wd(string) website(string) save(string) add_h(string) add_p(string) add_a1(string) add_a2(string) add_a3(string) a1_wave(string) a2_wave(string) a3_wave(string) excel csv stata sas spss] wave(string)
	
	
	// cd "`wd'"
	use  klip_users, clear
	
	keep pid hhid wave year `anything'
	
	local i=1
	foreach l of local wave {
		if `i'==1 {
			local ifexp="wave==`l'"
		}
		if `i'!=1 {
			local ifexp="`ifexp' | wave==`l'"
		}
		local i=`i'+1
	}
	keep if `ifexp'
	
	
	if "`excel'"=="" & "`csv'"=="" {
		save `save', replace
		local flist="`save'.dta"
	}
	if "`excel'"!="" {
		export excel using "`save'.xlsx", firstrow(variables)
		local flist="`flist' `save'.xlsx"
	}
	if "`csv'"!="" {
		export delimited using `save', replace
		local flist="`flist' `save'.csv"
	}
	
	use code_book_all, clear
	gen mark=.
	replace mark=1 if vname=="pid"
	replace mark=1 if vname=="hhid"
	replace mark=1 if vname=="wave"
	replace mark=1 if vname=="year"
	foreach l of local anything {
		replace mark=1 if vname=="`l'"
	}
	keep if mark==1
	

	if "`save'"=="" {
		local fname="klips_final"
	}
	if "`save'"!="" {
		local fname="`save'"
	}
	drop mark
	export excel using "`fname'_codebook.xlsx", replace first(variable)
	export delimited using "klips_final_var.csv", replace
	unicode convertfile klips_final_var.csv `fname'_codebook.csv, dstencoding(cp949) replace
	

	zipfile `flist' `fname'_codebook.xlsx `fname'_codebook.csv, saving ("`fname'.zip", replace )
	
	foreach l of local flist {
		capture erase `l'
	}
	cap erase klips_final_var.xlsx
	cap erase `fname'_codebook.xlsx
	cap erase `fname'_codebook.csv
end
