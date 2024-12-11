<hr class="hr-text" data-content="{{$packagesCount}} question packages found for tag: {{$tagName}}">

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
                    <span class="tag">{{ $tag->name }}</span>
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