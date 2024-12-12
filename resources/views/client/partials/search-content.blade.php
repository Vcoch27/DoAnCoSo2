@if(isset($tagName))
<hr class="hr-text" data-content="{{$packagesCount}} question packages found for tag: {{$tagName}}">
@elseif(isset($query))
<hr class="hr-text" data-content="{{$packagesCount}} question packages found for query: {{$query}}">
@endif

@php
function highlight($text, $query, $highlightAll = true) {
if (!$query || ($highlightAll === false)) {
return e($text);
}
return preg_replace('/(' . preg_quote($query, '/') . ')/i', '<span class="highlight">$1</span>', e($text));
}

@endphp

@if (isset($query))
@php
$highlightAll = isset($query); // Highlight toàn bộ khi có $query
@endphp
<section class="hero-section">
    <div class="card-grid" id="popular-packages-content">
        @forelse($packages as $package)
        <a class="card" href="#">
            <div class="card__background" style="background-image: url('{{ asset("img/img_bg_pq/progaccumBg.png") }}')"></div>
            <div class="card__content">
                <div class="premium-div">
                    <i class="premium-logo fa-solid fa-frog"></i>
                </div>
                <div class="tags">
                    {{-- Highlight tags chỉ khi có $tagName --}}
                    @foreach($package->tags as $tag)
                    <span class="tag">
                        {!! highlight($tag->name, $tagName ?? $query, isset($tagName)) !!}
                    </span>
                    @endforeach
                </div>
                {{-- Highlight toàn bộ khi tìm kiếm --}}
                <p class="card__category">{!! highlight($package->category, $query, $highlightAll) !!}</p>
                <h3 class="card__heading">{!! highlight($package->title, $query, $highlightAll) !!}</h3>
                <div>
                    <h3>Author: <span>{!! highlight($package->author->name ?? 'Unknown', $query, $highlightAll) !!}</span></h3>
                    <h3>Sentence count: <span>{{ $package->question_count }}</span></h3>
                    <h4>Participants: <span>{{ $package->attempt_count }} <i class="fa-solid fa-eye"></i></span></h4>
                </div>
                <button class="try-btn" value="{{ $package->id }}" onclick="checkCondition(this)">Start</button>
            </div>
        </a>
        @empty
        <p>No packages available at the moment.</p>
        @endforelse
    </div>
</section>
@else
<section class="hero-section">
    <div class="card-grid" id="popular-packages-content">
        @forelse($packages as $package)
        <a class="card" href="#">
            <div class="card__background" style="background-image: url('{{ asset("img/img_bg_pq/progaccumBg.png") }}')"></div>
            <div class="card__content">
                <div class="premium-div">
                    <i class="premium-logo fa-solid fa-frog"></i>
                </div>
                <div class="tags">
                    @foreach($package->tags as $tag)
                    <span class="tag"> {!! highlight($tag->name , $tagName, $tagName) !!}</span>
                    @endforeach
                </div>
                <p class="card__category">{{ $package->category }}</p>
                <h3 class="card__heading">{{ $package->title }}</h3>
                <div>
                    <h3>Author: <span>{{ $package->author->name }}</span></h3>
                    <h3>Sentence count: <span>{{ $package->question_count }}</span></h3>
                    <h4>Participants: <span>{{ $package->attempt_count }} <i class="fa-solid fa-eye"></i></span></h4>
                </div>
                <button class="try-btn" value="{{ $package->id }}" onclick="checkCondition(this)">Start</button>
            </div>
        </a>

        @empty
        <p>No packages available at the moment.</p>
        @endforelse
    </div>
</section>
@endif