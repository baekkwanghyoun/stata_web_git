<?php

namespace Database\Seeders;

use App\Models\Analysis;
use Illuminate\Database\Seeder;

class analysisSeeder extends Seeder
{
    public function run()
    {
        for($i = 0; $i < 1000; $i++)
        {
            Analysis::create([
                'type'=> fake()->randomElement(['wave']),
                'value'=>fake()->numberBetween(1, 23),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
                //'type'=> fake()->randomElement(['wave', 'h', 'p', 'h_src', 'p_src','wave_a', 'var_a', 'file', 's_wave', 's_type', 's_word']),
            ]);

            Analysis::create([
                'type'=> fake()->randomElement(['h']),
                'value'=> fake()->randomElement(["h_region","h_num","h_resid_type","h_hprice","h_hsex","h_hage","h_kidage06","h_kidage712","h_kidage1315","h_kid",
                    "h_hmarital","h_hedu","h_inc_1","h_inc_2","h_inc_3","h_inc_4","h_inc_5","h_inc_6","h_inc_total","h_asset_1","h_asset_2_1","h_asset_2_2",
                    "h_asset_3_1","h_asset_3_2","h_incomeq","h_debt_total","h_debt_pay","h_eqscale_ori","h_eqscale_mod","h_weight98","h_weight09","h_weight18",
                    "h_sample98","h_sample09","h_sample18"]),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            Analysis::create([
                'type'=> fake()->randomElement(['p']),
                'value'=> fake()->randomElement(["p_sex","p_age","p_rel","p_edu","p_religion","p_married","p_region",
                    "p_econstat","p_jobtype","p_wage","p_hours","p_employ_type","p_job_status","p_ind2000","p_ind2007","p_ind2017",
                    "p_jobfam2000","p_jobfam2007","p_jobfam2017","p_firm_size","p_job_begin","p_weight98_l","p_weight98_c","p_weight09_l",
                    "p_weight09_c","p_weight18_l","p_weight18_c","p_sample98","p_sample09","p_sample18"]),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);


            // 원자료 변수 추가 : 가구
            Analysis::create([
                'type'=> fake()->randomElement(['h_src']),
                'value'=> fake()->randomElement(["h_region","h_num","h_resid_type","h_hprice","h_hsex","h_hage","h_kidage06","h_kidage712","h_kidage1315","h_kid",
                    "h_hmarital","h_hedu","h_inc_1","h_inc_2","h_inc_3","h_inc_4","h_inc_5","h_inc_6","h_inc_total","h_asset_1","h_asset_2_1","h_asset_2_2",
                    "h_asset_3_1","h_asset_3_2","h_incomeq","h_debt_total","h_debt_pay","h_eqscale_ori","h_eqscale_mod","h_weight98","h_weight09","h_weight18",
                    "h_sample98","h_sample09","h_sample18"]),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            // 원자료 변수 추가 : 개인
            Analysis::create([
                'type'=> fake()->randomElement(['p_src']),
                'value'=> fake()->randomElement(["p_sex","p_age","p_rel","p_edu","p_religion","p_married","p_region",
                    "p_econstat","p_jobtype","p_wage","p_hours","p_employ_type","p_job_status","p_ind2000","p_ind2007","p_ind2017",
                    "p_jobfam2000","p_jobfam2007","p_jobfam2017","p_firm_size","p_job_begin","p_weight98_l","p_weight98_c","p_weight09_l",
                    "p_weight09_c","p_weight18_l","p_weight18_c","p_sample98","p_sample09","p_sample18"]),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            // 부가조사 차수
            Analysis::create([
                'type'=> fake()->randomElement(['wave_a']),
                'value'=>fake()->numberBetween(3, 8),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            // 부가 조사 차수 변수
            Analysis::create([
                'type'=> fake()->randomElement(['var_a']),
                'value'=> fake()->randomElement(["h_region","h_num","h_resid_type","h_hprice","h_hsex","h_hage","h_kidage06","h_kidage712","h_kidage1315","h_kid",
                    "h_hmarital","h_hedu","h_inc_1","h_inc_2","h_inc_3","h_inc_4","h_inc_5","h_inc_6","h_inc_total","h_asset_1","h_asset_2_1","h_asset_2_2",
                    "h_asset_3_1","h_asset_3_2","h_incomeq","h_debt_total","h_debt_pay","h_eqscale_ori","h_eqscale_mod","h_weight98","h_weight09","h_weight18",
                    "h_sample98","h_sample09","h_sample18"]),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            // 파일 저장 타입
            Analysis::create([
                'type'=> fake()->randomElement(['file']),
                'value'=> fake()->randomElement(["Stata", "Csv"]),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            /* 두번째 탭 */

            // 원자료 변수 검새 차수
            Analysis::create([
                'type'=> fake()->randomElement(['s_wave']),
                'value'=>fake()->numberBetween(1, 23),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            // 가구용 변수 타입
            Analysis::create([
                'type'=> fake()->randomElement(['s_type']),
                'value'=>fake()->numberBetween('h', 'p'),
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);

            // 가구용 변수 워드
            Analysis::create([
                'type'=> fake()->randomElement(['s_word']),
                'value'=>fake()->word,
                'created_at'=>fake()->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);



        }

    }
}
