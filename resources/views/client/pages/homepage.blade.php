<!-- resources/views/client/pages/homepage.blade.php -->

<!-- Kế thừa layout  -->
@extends('client.layouts.app')

@push('styles')
<!-- link với Vite -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<link href="{{ asset('client/assets/css/now-ui-kit.css') }}" rel="stylesheet" />
<link href="{{ asset('css/homepage.css') }}" rel="stylesheet" />
<link href="{{ asset('css/components/cardQP.css') }}" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    .select {
        width: fit-content;
        cursor: pointer;
        transition: 300ms;
        color: white;
        overflow: hidden;
    }

    .selected {
        background-color: #2a2f3b;
        padding: 5px;
        margin-bottom: 3px;
        border-radius: 5px;
        position: relative;
        z-index: 100000;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .arrow {
        position: relative;
        right: 0px;
        height: 10px;
        transform: rotate(-90deg);
        width: 25px;
        fill: white;
        z-index: 100000;
        transition: 300ms;
    }

    .options {
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        padding: 5px;
        background-color: #2a2f3b;
        position: absolute;
        top: -100px;
        opacity: 0;
        transition: 300ms;
        z-index: 9999;
    }

    .select:hover>.options {
        opacity: 1;
        top: 0;
    }

    .select:hover>.selected .arrow {
        transform: rotate(0deg);
    }

    .option {
        border-radius: 5px;
        padding: 5px;
        transition: 300ms;
        background-color: #2a2f3b;
        width: 150px;
        font-size: 15px;
    }

    .option:hover {
        background-color: #323741;
    }

    .options input[type="radio"] {
        display: none;
    }

    .options label {
        display: inline-block;
    }

    .options label::before {
        content: attr(data-txt);
    }

    .options input[type="radio"]:checked+label {
        display: none;
    }

    .options input[type="radio"]#all:checked+label {
        display: none;
    }

    .select:has(.options input[type="radio"]#all:checked) .selected::before {
        content: attr(data-default);
    }
</style>

@endpush
@section('title', 'Homepage')
@section('content')
<?php

use Illuminate\Support\Facades\Auth;

$daily_limit = Auth::user()->dailyLimit;
$isPremium = Auth::user()->isPremium;
$logoPath = asset('img/logo/logoProgacuum.png');
?>


<?php
$styles = '';
foreach ($tags as $tag) {
    $styles .= "
        .select:has(.options input[type='radio']#option-" . $tag->id . ":checked) .selected::before {
            content: attr(data-" . $tag->id . ");
        }
    ";
}
?>
<style>
    <?php echo $styles; ?>
</style>

<section id="home" class="f z gd xe ye ze jg kg" style="background-image: url('./images/hero/common-bg.jpg');">
    <div class="e h g _ ib pb" style="
            background: linear-gradient(
                180deg,
                rgba(20, 20, 32, 0.65) 0%,
                #141420 100%
            );
            "></div>
    <div class="a">
        <div class="ea za xc yc">
            <div class="pb nf _k/2">
                <div class="ra gc tk">
                    <h1 class="ia lh ph qh vh lk tl om 2xl:ud-text-[50px] sm:text-[46px]">
                        Build and Accumulate Your Programming Skills
                    </h1>
                    <p class="qa hh oh rh uh kk">
                        A platform for programmers to practice and accumulate coding skills. Featuring interactive learning modules,
                        personalized study plans, and real-time coding challenges to help you grow your knowledge and improve your skills.
                    </p>

                </div>
            </div>
            <div class="pb nf _k/2">
                <div class="ch">
                    <img src="{{ $logoPath }}" alt="hero image" class="da bc" />
                </div>
            </div>
        </div>

    </div>

    <div>
        <span class="e s t _">
            <svg width="111" height="115" viewBox="0 0 111 115" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_f_21_53)">
                    <g filter="url(#filter1_i_21_53)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M73.287 91.7144C92.1417 80.8286 98.5953 56.729 87.7122 37.8789C76.8291 19.0288 52.7314 12.568 33.8767 23.4537C15.0312 34.3342 8.56843 58.4391 19.4515 77.2892C30.3346 96.1393 54.4415 102.595 73.287 91.7144Z"
                            fill="url(#paint0_linear_21_53)" />
                    </g>
                    <path opacity="0.7" fill-rule="evenodd" clip-rule="evenodd"
                        d="M69.4961 86.3067C86.2379 76.6408 91.9683 55.2418 82.3048 38.5041C72.6412 21.7663 51.244 16.0295 34.5021 25.6954C17.7685 35.3566 12.0299 56.7603 21.6934 73.498C31.357 90.2358 52.7625 95.9679 69.4961 86.3067Z"
                        fill="url(#paint1_radial_21_53)" />
                </g>
                <defs>
                    <filter id="filter0_f_21_53" x="-3.83423" y="0.165771" width="114.834" height="114.834"
                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                        <feGaussianBlur stdDeviation="9" result="effect1_foregroundBlur_21_53" />
                    </filter>
                    <filter id="filter1_i_21_53" x="14.1658" y="10.1658" width="86.8342" height="86.8342"
                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                        <feColorMatrix in="SourceAlpha" type="matrix"
                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dx="8" dy="-8" />
                        <feGaussianBlur stdDeviation="10" />
                        <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
                        <feColorMatrix type="matrix"
                            values="0 0 0 0 0.168627 0 0 0 0 0.168627 0 0 0 0 0.321569 0 0 0 0.25 0" />
                        <feBlend mode="normal" in2="shape" result="effect1_innerShadow_21_53" />
                    </filter>
                    <linearGradient id="paint0_linear_21_53" x1="31.6878" y1="19.1263" x2="63.3007" y2="99.1224"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#EBC77A" />
                        <stop offset="0.541667" stop-color="#CA3F8D" />
                        <stop offset="1" stop-color="#5142FC" />
                    </linearGradient>
                    <radialGradient id="paint1_radial_21_53" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                        gradientTransform="translate(56.6039 36.9093) rotate(63.4349) scale(29.0091)">
                        <stop stop-color="white" />
                        <stop offset="1" stop-color="white" stop-opacity="0" />
                    </radialGradient>
                </defs>
            </svg>
        </span>
        <div class="e h g _ za ib pb bd ai">
            <span class="ib wb ue ve we ab wk">
            </span>
            <span class="ib wb ue ve we ab wk">
            </span>
            <span class="ib wb ue ve we ab wk">
            </span>
            <span class="ib wb ue ve we ab gk">
            </span>
            <span class="ib wb ue ve we ab gk">
            </span>
            <span class="ib wb ue ve we ab gk">
            </span>
            <span class="ib wb ue ve we">
            </span>
            <span class="ib wb ue ve we">
            </span>
            <span class="ib wb ue ve we">
            </span>
            <span class="ib wb ue ve we">
            </span>
            <span class="ib wb ue ve we">
            </span>
            <span class="ib wb ue ve we">
            </span>
        </div>
    </div>
</section>

<section class="hero-section">
    @if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
    @endif
</section>
<div>
    <div style="width: 80%; margin: 0 auto;">
        <div class="row g-3 mt-2">
            <div class="col-md-3 " style="position: relative; margin-top:10px;">
                <div class="select" style="width:100%" style="position: absolute; ">
                    <div class="selected" data-default="Tag"
                        <?php foreach ($tags as $tag) echo 'data-' . $tag->id . '="' . $tag->name . '" '; ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                        </svg>
                    </div>
                    <div class="options" style="width: 93%; top:30px;">
                        <div title="all" style="width: 100%;">
                            <input id="all" name="option" type="radio" checked="" />
                            <label class="option" for="all" data-txt="All"></label>
                        </div>
                        @foreach ($tags as $tag)
                        <div title="option-{{$tag->id}}">
                            <input id="option-{{$tag->id}}" name="option" type="radio" />
                            <label class="option" for="option-{{$tag->id}}" data-txt="{{ $tag->name }}"></label>
                        </div>
                        @endforeach
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <input style="height: 70%;  " type="text" class="form-control mt-2" placeholder="Search for packages by title, category, or tag">
            </div>
            <div class="col-md-3">
                <button style="background-color: #f9f9f9; color: #141420;" class="btn btn-secondary btn-block">Search Results</button>
            </div>
        </div>

    </div>

</div>

<div id="search-content">
    <hr class="hr-text" data-content="New Question Packages">
    <section class="hero-section">
        <div class="card-grid" id="new-packages-content">
            @include('client.partials.package_cards1')
        </div>
    </section>
    <div class="new-package-pagination">
        <div class="pagination-links" id="new-packages-pagination">
            {!! $packages->links() !!}
        </div>
    </div>
</div>
<hr class="hr-text" data-content="Popular Question Packages">
<section class="hero-section">
    <div class="card-grid" id="popular-packages-content">
        @forelse($packagesPopular as $package)
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const starRatings = document.querySelectorAll('.star-rating'); // Lấy tất cả star-rating

        starRatings.forEach(starRating => {
            const rating = parseFloat(starRating.getAttribute('data-rating')); // Lấy giá trị rating từ data-rating
            const fullStars = Math.floor(rating); // Số sao đầy
            const halfStar = rating % 1 !== 0; // Kiểm tra có sao nữa không

            // Tạo các sao tương ứng
            for (let i = 0; i < 5; i++) {
                if (i < fullStars) {
                    starRating.innerHTML += '<i class="fa-solid fa-star"></i>'; // Sao đầy
                } else if (i === fullStars && halfStar) {
                    starRating.innerHTML += '<i class="fa-regular fa-star-half-stroke"></i>'; // Sao nữa
                } else {
                    starRating.innerHTML += '<i class="fa-regular fa-star"></i>'; // Sao trống
                }
            }
        });
    });
</script>
<script>
    function checkCondition(button) {
        // Lấy id package từ value của button
        var packageId = button.value;

        // Pass PHP values into JavaScript
        var dailyLimit = <?php echo $daily_limit; ?>;
        var isPremium = <?php echo $isPremium ? 'true' : 'false'; ?>;

        if (!(dailyLimit > 0 || isPremium)) {
            var notificationHTML = `
              
 <div class="card-noti error">
        <svg class="wave" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z"
                fill-opacity="1"></path>
        </svg>

        <div class="icon-container">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                stroke-width="0"
                fill="currentColor"
                stroke="currentColor"
                class="icon">
                <path
                    d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"></path>
            </svg>

                    </div>
        <div class="message-text-container">
            <p class="message-text">You have no heart to continue</p>
            <p class="sub-text">Upgrade premium now</p>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" stroke-width="0" fill="none" stroke="currentColor" class="cross-icon">
            <path fill="currentColor" d="M11.7816 4.03157C12.0062 3.80702 12.0062 3.44295 11.7816 3.2184C11.5571 2.99385 11.193 2.99385 10.9685 3.2184L7.50005 6.68682L4.03164 3.2184C3.80708 2.99385 3.44301 2.99385 3.21846 3.2184C2.99391 3.44295 2.99391 3.80702 3.21846 4.03157L6.68688 7.49999L3.21846 10.9684C2.99391 11.193 2.99391 11.557 3.21846 11.7816C3.44301 12.0061 3.80708 12.0061 4.03164 11.7816L7.50005 8.31316L10.9685 11.7816C11.193 12.0061 11.5571 12.0061 11.7816 11.7816C12.0062 11.557 12.0062 11.193 11.7816 10.9684L8.31322 7.49999L11.7816 4.03157Z"
                clip-rule="evenodd" fill-rule="evenodd"></path>
        </svg>
        <div class="countdown">5s</div> <!-- Hiển thị đếm ngược -->

    </div>
            `;

            document.getElementById('notification').innerHTML = notificationHTML;
        } else {
            window.location.href = "{{ route('packages.show', ['id' => '__PACKAGE_ID__']) }}".replace('__PACKAGE_ID__', packageId);
        }
        // hiệu ứng cho thông báo 
        const notifications = document.querySelectorAll('.card-noti');
        let initialTop = 70; // Vị trí bắt đầu của thông báo đầu tiên
        const notificationHeight = 90; // Chiều cao thông báo

        notifications.forEach((notification, index) => {
            // Đặt vị trí `top` cho mỗi thông báo
            notification.style.top = `${initialTop + index * notificationHeight}px`;

            // Hiệu ứng trượt vào từ phải
            notification.classList.add('show');
            // Xử lý đóng thông báo
            notification.querySelector('.cross-icon').addEventListener('click', function() {
                notification.classList.add('hide');
                notification.style.display = 'none';
            });
            const countdownElement = notification.querySelector('.countdown');
            let timeLeft = 5;
            countdownElement.textContent = `${timeLeft}s`;

            // Cập nhật đồng hồ đếm ngược mỗi giây
            const countdownInterval = setInterval(() => {
                timeLeft -= 1;
                countdownElement.textContent = `${timeLeft}s`;

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    notification.classList.add('hide');
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 500);
                }
            }, 1000);
        });
    }
</script>
<script>
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getData(page);
            }
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            event.preventDefault();

            var myurl = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];

            getData(page);
        });
    });

    function getData(page) {
        $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html",
            })
            .done(function(data) {
                $("#new-packages-content").empty().html(data); // Cập nhật đúng ID của phần nội dung
                location.hash = page;
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allRadioButton = document.getElementById('all');

        // Lắng nghe sự kiện thay đổi (change) của radio "all"
        allRadioButton.addEventListener('change', function() {
            if (this.checked) {
                // Khi "all" được chọn, reload lại trang
                window.location.reload();
            }
        });
        const radioButtons = document.querySelectorAll('input[name="option"]');

        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                if (this.checked) {
                    // Lấy ID của tag từ radio button
                    const tagId = this.id.replace('option-', '');
                    console.log(tagId)
                    // Gửi AJAX request
                    $.ajax({
                        url: '/get-packages/' + tagId, // URL của route trong Laravel
                        type: 'GET', // Phương thức HTTP (GET để lấy dữ liệu)
                        data: {
                            tag_id: tagId // Dữ liệu sẽ được gửi đến server
                        },
                        success: function(response) {
                            // Cập nhật nội dung của div #search-content với HTML trả về từ server
                            $('#search-content').html(response.html);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection