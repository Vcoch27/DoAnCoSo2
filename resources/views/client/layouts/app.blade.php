<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title> <!-- Yield cho title -->

    <link rel="icon" type="image/x-icon" href="{{'img/logo/navican.png'}}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="{{ asset('css/components/notifications.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/header.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/pagination.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Thêm Moment.js CDN vào trang -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

    <!-- Nhận các styles được đẩy vào -->
    @stack('styles')
    @stack('scripts')


</head>

<body>

    <!-- Kiểm tra các loại thông báo trong session và hiển thị chúng -->
    <div class="div-noti" id="notification">
        @if (session()->has('notifications'))
        @foreach (session('notifications') as $notification)
        <div class="card-noti {{ $notification['type'] }}">
            <svg class="wave" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z"
                    fill-opacity="1"></path>
            </svg>

            <div class="icon-container">
                @switch($notification['type'])
                @case('success')
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    stroke-width="0"
                    fill="currentColor"
                    stroke="currentColor"
                    class="icon">
                    <path
                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"></path>
                </svg>
                @break

                @case('error')
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
                @break

                @case('warning')
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    stroke-width="0"
                    fill="currentColor"
                    stroke="currentColor"
                    class="icon">
                    <path
                        d="M13 7.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-3 3.75a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 .75.75v4.25h.75a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1 0-1.5h.75V12h-.75a.75.75 0 0 1-.75-.75Z"></path>
                    <path
                        d="M12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1ZM2.5 12a9.5 9.5 0 0 0 9.5 9.5 9.5 9.5 0 0 0 9.5-9.5A9.5 9.5 0 0 0 12 2.5 9.5 9.5 0 0 0 2.5 12Z"></path>
                </svg>
                @break

                @case('info')
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    stroke-width="0"
                    fill="currentColor"
                    stroke="currentColor"
                    class="icon">
                    <path
                        d="M13 7.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-3 3.75a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 .75.75v4.25h.75a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1 0-1.5h.75V12h-.75a.75.75 0 0 1-.75-.75Z"></path>
                    <path
                        d="M12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1ZM2.5 12a9.5 9.5 0 0 0 9.5 9.5 9.5 9.5 0 0 0 9.5-9.5A9.5 9.5 0 0 0 12 2.5 9.5 9.5 0 0 0 2.5 12Z"></path>
                </svg>
                @break

                @default
                <!-- Nội dung mặc định (nếu cần) -->
                @endswitch



            </div>
            <div class="message-text-container">
                <p class="message-text">{{ $notification['message'] }}</p>
                <p class="sub-text">{{ $notification['subtext'] }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" stroke-width="0" fill="none" stroke="currentColor" class="cross-icon">
                <path fill="currentColor" d="M11.7816 4.03157C12.0062 3.80702 12.0062 3.44295 11.7816 3.2184C11.5571 2.99385 11.193 2.99385 10.9685 3.2184L7.50005 6.68682L4.03164 3.2184C3.80708 2.99385 3.44301 2.99385 3.21846 3.2184C2.99391 3.44295 2.99391 3.80702 3.21846 4.03157L6.68688 7.49999L3.21846 10.9684C2.99391 11.193 2.99391 11.557 3.21846 11.7816C3.44301 12.0061 3.80708 12.0061 4.03164 11.7816L7.50005 8.31316L10.9685 11.7816C11.193 12.0061 11.5571 12.0061 11.7816 11.7816C12.0062 11.557 12.0062 11.193 11.7816 10.9684L8.31322 7.49999L11.7816 4.03157Z"
                    clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
            <div class="countdown">5s</div> <!-- Hiển thị đếm ngược -->

        </div>
        @endforeach
        @endif
    </div>

    <!-- <div class="container"> -->
    @include('client.includes.header')
    <!-- @include('client.includes.sidebar')  -->
    <main>

        @yield('content') <!-- Yield cho nội dung chính -->

    </main>

    @include('client.includes.footer') <!-- Bao gồm footer -->
    <!-- </div> -->
    <!-- Preloader -->
    <div id="preloader"></div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
    /**
     * Preloader
     */
    const preloader = document.querySelector('#preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.remove();
        });
    }
</script>

</html>