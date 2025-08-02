<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name'=>'Basic Plan',
                'stripe_plan'=>'prod_SibbwrY40bfSHo',
                'description'=>'description',
                'price'=>'0.00',
            ],
            [
                'name'=>'Premium Plan',
                'stripe_plan'=>'prod_Sibbs7fwxneBtc',
                'description'=>'description',
                'price'=>'10.00',
            ],

            ];

            foreach($plans as $plan)
            {
                Plan::create([
                    'name'=>$plan['name'],
                    'stripe_plan'=>$plan['stripe_plan'],
                    'description'=>$plan['description'],
                    'price'=>$plan['price'],
                ]);
            }
    }
}
