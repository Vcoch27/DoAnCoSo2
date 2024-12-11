<?php
// database/seeders/PremiumPlanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PremiumPlan;

class PremiumPlanSeeder extends Seeder
{
    public function run()
    {
        PremiumPlan::create([
            'name' => '1 Month',
            'price' => 50000, // Giá tiền (ví dụ là 50,000 VND)
            'duration' => 30, // Thời gian 1 tháng
        ]);

        PremiumPlan::create([
            'name' => '5 Months',
            'price' => 200000, // Giá tiền (ví dụ là 200,000 VND)
            'duration' => 150, // Thời gian 5 tháng
        ]);
    }
}
