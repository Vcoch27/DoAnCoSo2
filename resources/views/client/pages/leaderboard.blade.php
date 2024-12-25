@extends('client.layouts.app')
@push('styles')
<link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('client/assets/css/now-ui-kit.css') }}" rel="stylesheet" />
<!-- --------- -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<link
    href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap"
    rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endpush

@section('title','Leadboard')

@section('content')

<div class="leader-container">
    <main>
        <div id="header">
            <h1>Overall Ranking</h1>
            <!-- <button class="share">
                <i class="ph ph-share-network"></i>
            </button> -->
        </div>
        <div id="leaderboard">
            <div class="ribbon"></div>
            <table>
                @foreach ($topUsers as $index => $user)
                <tr>
                    <td class="number">{{ $index + 1 }}</td>
                    <td class="name">
                        <a href="{{ route('profile.show', ['id' => $user->id]) }}" class="text-decoration-none text-dark">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="points">
                        {{ number_format($user->cumulative) }}
                        @if ($index === 0)
                        <img class="gold-medal" src="https://github.com/malunaridev/Challenges-iCodeThis/blob/master/4-leaderboard/assets/gold-medal.png?raw=true" alt="gold medal" />
                        @endif
                    </td>
                </tr>
                @endforeach

            </table>

            <div class="your-ranking">
                Your Rank: {{ $currentUser->cumulative == 0 ? '-' : $currentUserRank }} | {{$currentUser->name}} | Points: {{$currentUser->cumulative}}
            </div>


        </div>
    </main>
</div>
@endsection