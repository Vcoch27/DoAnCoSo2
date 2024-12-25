<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <span class="ms-1 font-weight-bold text-white">ProgAccuum</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::routeIs('dashboard') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/tables*')? 'active bg-gradient-primary' : '' }}" href="{{ route('tables') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-regular fa-user opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/packages*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.packages') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-folder"></i>
                    </div>
                    <span class="nav-link-text ms-1">Question Packages</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/premium*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.premium') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-money-bill"></i>

                    </div>
                    <span class="nav-link-text ms-1">Payment </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/public_requests*')  ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.public_requests') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-frog"></i>
                    </div>
                    <span class="nav-link-text ms-1">Public Request </span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('profile.show', ['id' => Auth::id()]) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a class="nav-link text-white" href="#" onclick="confirmLogout(event)">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>

                <script>
                    function confirmLogout(event) {
                        event.preventDefault(); // Ngăn hành động mặc định của thẻ <a>
                        if (confirm('Are you sure you want to log out?')) {
                            // Nếu người dùng nhấn "OK", gửi form logout
                            document.getElementById('logout-form').submit();
                        }
                    }
                </script>

            </li>

        </ul>
    </div>

</aside>