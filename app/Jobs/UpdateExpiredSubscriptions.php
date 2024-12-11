<?php

namespace App\Jobs;

use App\Models\UserPremiumSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class UpdateExpiredSubscriptions implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Lấy tất cả các gói premium có end_date <= hiện tại và status là 'active'
        $subscriptions = UserPremiumSubscription::where('end_date', '<=', now())
            ->where('status', 'active')
            ->get();

        // Cập nhật trạng thái thành 'expired' cho các bản ghi có status là 'active'
        foreach ($subscriptions as $subscription) {
            $subscription->update([
                'status' => 'expired',
            ]);
        }
    }
}
