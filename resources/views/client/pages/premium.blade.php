@extends('client.layouts.app')
@push('styles')
<link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('client/assets/css/now-ui-kit.css') }}" rel="stylesheet" />
<!-- --------- -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .card {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        height: 550px;
    }

    .premium-badge {
        color: #198754;
        font-weight: bold;
    }

    .price {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .benefit-update-list {
        margin: 0 auto;
    }
</style>
@endpush

@section('title','Upgrade to Premium')

@section('content')

<!-- <pre>{{ json_encode($options, JSON_PRETTY_PRINT) }}</pre> -->
<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Free Plan Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Free</h5>
                    <p class="text-muted">Experience diverse question packs and build personal achievements at no cost</p>
                    <p class="price"> 0 <span class="small">VND</span> <br> <span class="text-muted">Per month</span></p>
                    @if (!Auth::check())
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Sign up</a>
                    @else
                    <span class="btn btn-outline-success"><i class="fa-solid fa-check"></i></span>

                    @endif
                    <p class="text-muted mt-2">No credit card required</p>
                    <hr>
                    <div class="benefit-update-list">
                        <h6>Features you’ll love:</h6>
                        <ul class="list-unstyled mt-3">
                            <li class="d-flex align-items-start">
                                <span class="me-2">✔</span> Access tech question packs
                            </li>
                            <li class="d-flex align-items-start">
                                <span class="me-2">✔</span> Track achievements
                            </li>
                            <li class="d-flex align-items-start">
                                <span class="me-2">✔</span> Daily play limit: 3 packs
                            </li>
                            <li class="d-flex align-items-start">
                                <span class="me-2">✔</span> View top scores
                            </li>
                            <li class="d-flex align-items-start">
                                <span class="me-2">✔</span> Build a profile
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- Premium Plan Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h5 class="card-title premium-badge">Premium</h5>
                    <p class="text-muted">Feel confident your writing is clear, impactful, and flawless</p>
                    <p class="price">{{ $options[0]->price }}<span class="small"> VND</span> <br> <span class="text-muted">Per month, with 30 days</span></p>
                    <form action="{{ route('premium.pay') }}" method="post">
                        @csrf
                        <input type="hidden" name="option" value="{{ $options[0] }}">

                        @if (!Auth::user()->isPremium)
                        <button type="submit" class="btn btn-success">
                            Upgrade
                        </button>
                        @else
                        <span class="btn btn-outline-success"><i class="fa-solid fa-check"></i></span>
                        @endif
                    </form>

                    <hr>
                    <div class="benefit-update-list">
                        <h6>Everything in Free, plus:</h6>
                        <ul class="list-unstyled mt-3">
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Unlimited access to question packs</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> AI-powered insights for better learning</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Advanced progress tracking</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Early access to new question packs</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Personalized learning recommendations</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Ad-free browsing experience</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Exclusive badges for achievements</li>
                        </ul>
                    </div>




                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h5 class="card-title premium-badge">Premium</h5>
                    <p class="text-muted">Feel confident your writing is clear, impactful, and flawless</p>
                    <p class="price">{{ $options[1]->price }} <span class="small"> VND</span> <br> <span class="text-muted">Per year, with 365 days</span></p>
                    <form action="{{ route('premium.pay') }}" method="post">
                        @csrf
                        <input type="hidden" name="option" value="{{ $options[1] }}">

                        @if (!Auth::user()->isPremium)
                        <button type="submit" class="btn btn-success">
                            Upgrade
                        </button>
                        @else
                        <span class="btn btn-outline-success"><i class="fa-solid fa-check"></i></span>
                        @endif
                    </form>
                    <hr>
                    <div class="benefit-update-list">
                        <h6>Everything in Monthly Premium, plus:</h6>
                        <ul class="list-unstyled mt-3">
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Discounted yearly pricing (save more)</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Priority customer support</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Exclusive yearly performance report</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Access to special events and webinars</li>
                            <li class="d-flex align-items-start"><span class="me-2">✔</span> Extra storage for saved progress</li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection