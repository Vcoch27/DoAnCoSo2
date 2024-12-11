@extends('admin.layouts.app')
@section('title','Packages Management')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">User Premium Subcriptions Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="table-responsive p-0" id="packages-table">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            ID <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        <a href="#">
                                            User <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Premium Plan <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Status <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Time Period <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $subscription->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $subscription->user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">ID_User: {{ $subscription->user_id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm text-center"> {{ $subscription->premiumPlan->name}}</h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ ucfirst($subscription->status) }}</span>

                                    </td>

                                    <td class="align-middle text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">End Date: {{ $subscription->end_date->format('d/m/Y') }}</h6>
                                            <p class="text-xs text-secondary mb-0">Start Date: {{ $subscription->start_date->format('d/m/Y') }}</p>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <a href="" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <a href=""
                                            onclick="return confirm('Are you sure?')"
                                            class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Delete user">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="pagination-container m-2 mt-4">
                            {{ $subscriptions->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection