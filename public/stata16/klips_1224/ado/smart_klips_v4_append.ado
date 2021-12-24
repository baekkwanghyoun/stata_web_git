/*
smart_klips_v4_append , wave(3) stata excel csv wd("/users/seti/desktop/")
smart_klips_v4_append a030111 a030122 a030125 a030133, wave(3) stata excel csv wd("/users/seti/desktop/")
smart_klips_v4_append a030111 a030122 a030125 a030133, wave(3) excel csv wd("/users/seti/desktop/")
smart_klips_v4_append a030111 a030122 a030125 a030133, wave(3) excel wd("/users/seti/desktop/")
smart_klips_v4_append a030111 a030122 a030125 a030133, wave(3) csv wd("/users/seti/desktop/")
*/

cap program drop smart_klips_v4_append
program define smart_klips_v4_append
	syntax [anything] , wave(string) [save(string) excel csv stata wd(string)] 
		
	if "`save'"=="" {
		local fname="klips_a_final"
	}
	if "`save'"!="" {
		local fname="`save'"
	}
	
	timer clear
	timer on 1
	
	if "`anything'"!="" {
		local vlist="pid wave `anything'"
	}
	
	use `vlist' using klips_a_all`wave', clear
	if "`stata'"!="" {
		save `fname'`wave', replace
		copy klips_a_codebook18.dta `fname'_codebook`wave'.dta
		local ziplist="`fname'`wave'.dta `fname'_codebook`wave'.dta"
	}
	if "`excel'"!="" {
		export excel using `fname'`wave'.xlsx, replace first(variable)
		copy klips_a_codebook18.xlsx `fname'_codebook`wave'.xlsx
		local ziplist="`ziplist' `fname'`wave'.xlsx `fname'_codebook`wave'.xlsx"
	}
	if "`csv'"!="" {
		export delimited using `fname'`wave'.csv, replace
		copy klips_a_codebook18.csv `fname'_codebook`wave'.csv
		local ziplist="`ziplist' `fname'`wave'.csv `fname'_codebook`wave'.csv"
	}
	
	
	zipfile `ziplist', saving ("`wd'`fname'`wave'.zip", replace )
	
	
	foreach l of local ziplist {
		erase `l'
	}
	timer off 1
	timer list
end

