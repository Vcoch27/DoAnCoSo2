<nav class="navbar navbar-expand-lg  fixed-top navbar-transparentt " color-on-scroll="50">

  <div class="navbar-translate">
    <a class="navbar-brand logo-header" href="/" rel="tooltip" title="Designed by Invision. Coded by Creative Tim" data-placement="bottom" target="_blank">
      PROGACCUM
    </a>
    <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar top-bar"></span>
      <span class="navbar-toggler-bar middle-bar"></span>
      <span class="navbar-toggler-bar bottom-bar"></span>
    </button>
  </div>
  <div class="navbar-collapse justify-content-end" id="navigation">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="#" class="nav-link " id="navbarDropdownMenuLink1" data-toggle="dropdown">
          <p>Upgrade Premium</p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
          <i class="fab fa-twitter"></i>
          <p class="d-lg-none d-xl-none">Twitter</p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
          <i class="fab fa-facebook-square"></i>
          <p class="d-lg-none d-xl-none">Facebook</p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
          <i class="fab fa-instagram"></i>
          <p class="d-lg-none d-xl-none">Instagram</p>
        </a>
      </li>

      @if (Route::has('login'))
      @auth

      <li class="nav-item">
        <a class="nav-link" href="">
          {{ Auth::user()->name }}
        </a>
      </li>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var navbar = document.querySelector('nav.navbar');
      var colorOnScroll = 50; // Scroll threshold

      window.addEventListener('scroll', function() {
        if (window.scrollY > colorOnScroll) {
          navbar.classList.remove('navbar-transparentt');
          navbar.classList.add('navbar-solid');
        } else {
          navbar.classList.remove('navbar-solid');
          navbar.classList.add('navbar-transparentt');
        }
      });
    });
    $(document).ready(function() {
      var trigger = $('.hamburger'),
        overlay = $('.overlay'),
        isClosed = false;

      trigger.click(function() {
        hamburger_cross();
      });

      function hamburger_cross() {
        if (isClosed) {
          overlay.hide();
          trigger.removeClass('is-open');
          trigger.addClass('is-closed');
          isClosed = false;
        } else {
          overlay.show();
          trigger.removeClass('is-closed');
          trigger.addClass('is-open');
          isClosed = true;
        }
      }

      $('[data-toggle="offcanvas"]').click(function() {
        $('#wrapper').toggleClass('toggled');
      });
    });
  </script>