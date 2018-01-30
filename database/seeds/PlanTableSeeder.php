<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
        	[
		        'name' => 'Monthly',
		        'slug' => 'monthly',
		        'gateway_id' => 'month_10',
		        'price' => '10.00',
		        'active' => 'true',
		        'teams_enabled' => 'false',
		        'teams_limit' => null,
	        ],
	        [
		        'name' => 'Yearly',
		        'slug' => 'yearly',
		        'gateway_id' => 'year_100',
		        'price' => '100.00',
		        'active' => 'true',
		        'teams_enabled' => 'false',
		        'teams_limit' => null,
	        ],
	        [
		        'name' => 'Monthly for 10 users',
		        'slug' => 'monthly-for-10-users',
		        'gateway_id' => 'team_month_50',
		        'price' => '50.00',
		        'active' => 'true',
		        'teams_enabled' => 'true',
		        'teams_limit' => '10',
	        ]
        ];

        Plan::insert($plans);
    }
}
