<style>
  #notification-box {
    display: none;
    position: fixed;
    top: 62px;
    right: 75px;
    z-index: 1050;
    color: black;
    width: 400px;
  }

  .notification-item {
    padding: 10px;
    margin-bottom: 10px;
  }

  .notification-item .btn-link {
    font-size: 12px;
  }

  .notification-item .badge {
    margin-left: 10px;
  }
</style>
<nav class="navbar navbar-expand-lg  fixed-top navbar-transparentt " color-on-scroll="50" style="position: sticky;">
  <div class="container">
    <div class="navbar-translate">
      <a class="navbar-brand" href="/" rel="tooltip" title="Designed by Invision. Coded by Creative Tim" data-placement="bottom">
        PROGACCUM
      </a>

      <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar top-bar"></span>
        <span class="navbar-toggler-bar middle-bar"></span>
        <span class="navbar-toggler-bar bottom-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
      <ul class="navbar-nav">

        <li class="nav-item">

          <a class="nav-link" rel="tooltip" title=" Add packages" data-placement="bottom" href="{{'leaderboard'}}">
            <i class="fa-solid fa-ranking-star"></i>
            <span style="font-size: 13px;">Ranking</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title=" Add packages" data-placement="bottom" href="">
            <span style="font-size: 13px;"><b>{{Auth::user()->cumulative}}</b> Points</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('premium')}}" class="nav-link ">
            @if (Auth::user()->isPremium)
            <p>Premium</p>
            @else
            <p>Upgrade Premium</p>
            @endif
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title=" Add packages" data-placement="bottom" href="{{ route('packages.create')}}">
            <i class="fa-solid fa-folder-plus custom-icon"></i>
          </a>
        </li>

        <li class="nav-item">
          <div class="nav-link" rel="tooltip" -placement="bottom">
            @if (Auth::user()->isPremium)
            <i class="fa-solid fa-heart-circle-bolt custom-icon"></i>
            <div class="hover-content">
              <p>Unlimited Hearts</p> <br>

              <button class="trial-button">Manage subscription</button>
            </div>
            @else
            <i class="fa-solid fa-heart custom-icon ">
              @if (isset($new_daily_limit))
              {{$new_daily_limit}}
              @else
              {{Auth::user()->dailyLimit}}
              @endif

            </i>
            <div class="hover-content">
              <p>Hearts</p>
              <div class="hearts-icons">
                <div class="card-meta heart-limit" daily-limit={{Auth::user()->dailyLimit}}>

                </div>
              </div>
              <p>
                @if (Auth::user()->dailyLimit===4)
                You have full hearts!
                @else
              <p>Recovery limit after: <span id="countdown">00:00:00</span></p><br>

              @endif
              </p>
              <button class="trial-button">UNLIMITED HEARTS <span>NOW</span></button>
            </div>
            @endif


          </div>
        </li>

        @if (Route::has('login'))
        @auth

        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile.show', Auth::user()->id) }}">
            {{ Auth::user()->name }}
          </a>
        </li>
        <li class="nav-item">
          <span id="toggle-button" class="nav-link">
            <i class="fa-solid fa-bell"></i>
          </span>
        </li>
        <div id="notification-box" class="alert alert-info shadow-sm" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
          <h5 class="mb-3">Notifications</h5>
          <span>NEW</span>
          <ul id="notification-list" class="list-group">
            <!-- Các thông báo sẽ được thêm vào đây -->
          </ul>
          <button id="load-more-btn" class="btn btn-primary btn-sm" style="display: none;">Xem thêm</button>
        </div>






        <li class="nav-item">


          <a href="#" class="nav-link" rel="tooltip" title="Log out" data-placement="bottom" data-bs-toggle="modal" data-bs-target="#logoutDialog" onclick="event.preventDefault();">
            <i class="fa-solid fa-right-from-bracket"></i>
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

        <!-- Sử dụng Dialog Component cho xác nhận đăng xuất -->
        <x-dialog id="logoutDialog" title="Confirm Logout">
          <p class="mb-7"><img width="70px" height="70px" src="https://media2.giphy.com/media/EJu9ITqFQAK5wqhtwf/giphy.webp?cid=790b7611k4d9eh6d9kvfuznpswf4duchfeae65xoduug5zm9&ep=v1_gifs_search&rid=giphy.webp&ct=g"> </p>
          <br>
          <p>Are you sure you want to log out?</p>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('logout-form').submit();">Confirm</button>
          </div>
        </x-dialog>


        @else
        <li class="nav-item">
          <a
            href="{{ route('login') }}"
            class="nav-link rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Log in
          </a>
        </li>


        @if (Route::has('register'))
        <li class="nav-item">
          <a
            href="{{ route('register') }}"
            class="nav-link rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Register
          </a>
        </li>

        @endif
        @endauth
        <!-- </nav> -->
        @endif
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const starRatings = document.querySelectorAll('.heart-limit'); // Lấy tất cả heart-limit

    starRatings.forEach(starRating => {
      const rating = parseFloat(starRating.getAttribute('daily-limit')); // Lấy giá trị rating từ daily-limit
      const fullStars = Math.floor(rating); // Số sao đầy
      const halfStar = rating % 1 !== 0; // Kiểm tra có sao nữa không

      // Tạo các sao tương ứng
      for (let i = 0; i < 4; i++) {
        if (i < fullStars) {
          starRating.innerHTML += '<i class="fa-solid fa-heart fa-lg heart-icon"></i>'; // Sao đầy
        } else {
          starRating.innerHTML += '<i class="fa-regular fa-heart fa-lg heart-icon"></i>'; // Sao trống
        }
      }
    });
  });


  function updateCountdown() {
    const now = new Date();
    const nextDay = new Date();
    nextDay.setHours(24, 0, 0, 0); // Thiết lập thời gian vào 00:00 ngày kế tiếp

    const timeRemaining = nextDay - now; // Khoảng thời gian còn lại (milliseconds)

    // Chuyển đổi thành giờ, phút, giây
    const hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
    const minutes = Math.floor((timeRemaining / (1000 * 60)) % 60);
    const seconds = Math.floor((timeRemaining / 1000) % 60);

    // Cập nhật nội dung HTML
    document.getElementById("countdown").textContent =
      `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

    // Lặp lại mỗi giây
    if (timeRemaining > 0) {
      setTimeout(updateCountdown, 1000);
    }
  }

  // Bắt đầu đếm ngược
  updateCountdown();
</script>
<!-- Thêm jQuery từ CDN -->

<script>
  let offset = 0; // Biến để theo dõi số lượng thông báo đã tải
  const limit = 3; // Số thông báo mỗi lần tải

  document.getElementById("toggle-button").addEventListener("click", function() {
    const notificationBox = document.getElementById("notification-box");
    if (notificationBox.style.display === "none" || notificationBox.style.display === "") {
      notificationBox.style.display = "block";
      loadNotifications(); // Tải thông báo khi mở hộp thông báo
    } else {
      notificationBox.style.display = "none";
    }
  });

  function loadNotifications() {
    // Gửi AJAX request để lấy thông báo
    $.ajax({
      url: "{{ route('notifications.fetch') }}", // Đảm bảo URL này chính xác
      method: "GET",
      data: {
        offset: offset,
        limit: limit
      }, // Gửi offset và limit để giới hạn số thông báo
      dataType: "json",
      success: function(response) {
        const notificationList = document.getElementById("notification-list");
        if (response.status === 'success' && response.data.length > 0) {
          response.data.forEach(notification => {
            const notificationItem = `
            <li class="list-group-item notification-item" data-id="${notification.id}">
              <strong>${notification.title}</strong> <br>
              <p>${notification.message}</p>
              <small class="text-muted">Created at: ${moment(notification.created_at).fromNow()}</small>
              <br>
              ${notification.is_read ? '<span class="badge badge-success">Read</span>' : '<span class="badge badge-warning">Unread</span>'}
              <br>
            </li>
          `;
            notificationList.innerHTML += notificationItem;
          });

          // Tăng offset mỗi lần tải thêm
          offset += limit;

          // Hiển thị nút "Xem thêm" nếu còn thông báo để tải thêm
          if (response.data.length === limit) {
            document.getElementById("load-more-btn").style.display = "block";
          } else {
            document.getElementById("load-more-btn").style.display = "none";
          }
        } else {
          // Không còn thông báo nào để tải
          document.getElementById("load-more-btn").style.display = "none";
          notificationList.innerHTML = '<li class="list-group-item">No notifications available.</li>';
        }
      },
      error: function() {
        alert('Error fetching notifications.');
      }
    });
  }

  // Thêm sự kiện click cho nút "Xem thêm"
  document.getElementById("load-more-btn").addEventListener("click", function() {
    loadNotifications(); // Tải thêm thông báo khi nhấn nút
  });
</script>