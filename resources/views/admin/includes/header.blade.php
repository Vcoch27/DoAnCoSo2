<nav class="navbar mt-3 navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
          <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark {{ Request::routeIs('dashboard') ? 'active' : '' }}" aria-current="page">
          @if (Request::routeIs('dashboard'))
          Dashboard
          @elseif (Request::is('dashboard/packages*'))
          Question Packages
          @elseif (Request::is('dashboard/premium*'))
          Payment Management
          @elseif (Request::is('dashboard/public_requests*'))
          Public Request
          @elseif (Request::is('dashboard/tables*'))
          Users
          @else

          @endif
        </li>
      </ol>
      <h6 class="font-weight-bolder mb-0">
        @if (Request::routeIs('dashboard'))
        Dashboard
        @elseif (Request::routeIs('admin.packages'))
        Question Packages
        @elseif (Request::routeIs('admin.premium'))
        Payment Management
        @elseif (Request::routeIs('admin.public_requests'))
        Public Request
        @elseif (Request::routeIs('tables'))
        Users

        @else

        @endif
      </h6>
    </nav>

    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group input-group-outline">
          <label class="form-label">Type here...</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <ul class="navbar-nav  justify-content-end">

        <li class="nav-item d-flex align-items-center">
          <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            @if (Route::has('login'))
            <span class="d-sm-inline d-none">
              {{ Auth::user()->name }}
            </span>
            <span class="d-sm-inline d-none">
              <a href="#" class="nav-link" rel="tooltip" title="Log out" data-placement="bottom" data-bs-toggle="modal" data-bs-target="#logoutDialog" onclick="event.preventDefault();">
                <i class="fa-solid fa-right-from-bracket"></i>
              </a>
            </span>
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

            @endif
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>