@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-folder"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0">Number of Question Packages</p>
                        <h4 class="mb-0">{{$totalQuestionPackages}}</h4>
                        <p>Public Packages: <b>{{$totalPublicQuestionPackages}}</b></p>
                        <p>New Public Packages Last Week: <b>{{$lastWeekTotalPublicQuestionPackages}}</b></p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            @if($publicPackageGrowthRate > 0) +{{$publicPackageGrowthRate}}%
                            @elseif($publicPackageGrowthRate < 0) {{$publicPackageGrowthRate}}%
                                @else 0% @endif
                                </span> compared to last week</p>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0">Total Users</p>
                        <h4 class="mb-0">{{$totalUsers}}</h4>
                        <p>New Users Last Week: <b>{{$newUsersLastWeek}}</b></p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            @if($userGrowthRate > 0) +{{$userGrowthRate}}%
                            @elseif($userGrowthRate < 0) {{$userGrowthRate}}%
                                @else 0% @endif
                                </span> compared to last week</p>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-money-bill"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0">Total Revenue</p>
                        <h4 class="mb-0">{{$totalPremiumRevenue}} VND</h4>
                        <p>Premium Users: <b>{{$totalPremiumUser}}</b></p>
                        <p>Revenue Last Week: <b>{{$premiumRevenueLastWeek}} VND</b></p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                            {{$premiumRevenueGrowthRate}}%
                        </span> compared to last week</p>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-file"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0">Number of Executions Today</p>
                        <h4 class="mb-0">{{$userResultsToday}}</h4>
                        <p>Total Answers: <b>{{$totalUserResults}}</b></p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            {{$userResultsGrowthRate}}%
                        </span> compared to yesterday</p>
                </div>
            </div>

        </div>
    </div>

    <!-- <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 ">Website Views</h6>
                    <p class="text-sm ">Last Campaign Performance</p>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2  ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 "> Daily Sales </h6>
                    <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 ">Completed Tasks</h6>
                    <p class="text-sm ">Last Campaign Performance</p>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm">just updated</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-body">
                    <h6 class="mb-0">User Public Requests</h6>
                    <p class="text-sm">Pending requests: <b>{{ $pendingPublicRequests }}</b></p>
                    <hr class="dark horizontal">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.packages') }}">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection