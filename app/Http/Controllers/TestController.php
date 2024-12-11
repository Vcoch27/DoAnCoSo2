<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateExpiredSubscriptions;
use App\Models\UserPremiumSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        UpdateExpiredSubscriptions::dispatch();

        // return view('admin/pages/dashboard');
        return view('client/test');
    }
}
