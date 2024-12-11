<!-- resources/views/client/pages/homepage.blade.php -->
<!-- Kế thừa layout -->
@extends('client.layouts.app')

<!-- push styles và script vào layout -->
@push('styles')
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./assets/img/favicon.png">
<title>
  @yield('title','Welcome')
</title>
<style>
  body {
    background-color: black;
  }
</style>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
@endpush
<!-- ------------ -->
@push('scripts')
<!--   Core JS Files   -->
<script src="{{ asset('client/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('client/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('client/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('client/assets/js/plugins/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ asset('client/assets/js/plugins/nouislider.js') }}" type="text/javascript"></script>
<script src="{{ asset('client/assets/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('client/assets/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>

<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script>
  $(document).ready(function() {
    // the body of this function is in assets/js/now-ui-kit.js
    nowuiKit.initSliders();
  });

  function scrollToDownload() {
    if ($('.section-download').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-download').offset().top
      }, 1000);
    }
  }
</script>
@endpush

<!-- content of page -->
@section('title', 'Homepage')

@section('content')
<div class="wrapper">
  <div class="page-header clear-filter" filter-color="orange">
    <!-- <div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/header.jpg');"> -->
    <div class="page-header-image" data-parallax="true" style="background-image:url('{{ asset('client/assets/img/header.jpg') }}');">
    </div>
    <div>
      <div class="content-center brand">
        <img class="n-logo" src="./assets/img/now-logo.png" alt="">
        <h1 class="h1-seo">ProgAccum</h1>
        <h3>Master whatever you’re learning with ProgAccum interactive flashcards, practice tests, and study activities.</h3>
        <a href="nucleo-icons.html" class="btn btn-primary btn-round btn-lg" target="_blank">GET STARTED</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-round btn-lg" target="_blank">I ALREADY HAVE A ACCOUNT</a>

      </div>

    </div>
  </div>
  <div class="main">
    <div class="section section-images">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="hero-images-container">
              <img src="assets/img/hero-image-1.png" alt="">
            </div>
            <div class="hero-images-container-1">
              <img src="assets/img/hero-image-2.png" alt="">
            </div>
            <div class="hero-images-container-2">
              <img src="assets/img/hero-image-3.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- End .section-navbars  -->
    <div class="section section-tabs">
      <div class="container">
        <div class="row">
          <div class="col-md-10 ml-auto col-xl-6 mr-auto">
            <p class="category">Tabs with Icons on Card</p>
            <!-- Nav tabs -->
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                      <i class="now-ui-icons objects_umbrella-13"></i> Home
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                      <i class="now-ui-icons shopping_cart-simple"></i> Profile
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                      <i class="now-ui-icons shopping_shop"></i> Messages
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                      <i class="now-ui-icons ui-2_settings-90"></i> Settings
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="home" role="tabpanel">
                    <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
                  </div>
                  <div class="tab-pane" id="profile" role="tabpanel">
                    <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
                  </div>
                  <div class="tab-pane" id="messages" role="tabpanel">
                    <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
                  </div>
                  <div class="tab-pane" id="settings" role="tabpanel">
                    <p>
                      "I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-10 ml-auto col-xl-6 mr-auto">
            <p class="category">Tabs with Background on Card</p>
            <!-- Tabs with Background on Card -->
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile1" role="tab">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages1" role="tab">Messages</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#settings1" role="tab">Settings</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="home1" role="tabpanel">
                    <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
                  </div>
                  <div class="tab-pane" id="profile1" role="tabpanel">
                    <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
                  </div>
                  <div class="tab-pane" id="messages1" role="tabpanel">
                    <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
                  </div>
                  <div class="tab-pane" id="settings1" role="tabpanel">
                    <p>
                      "I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs on plain Card -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Section Tabs -->
    <div class="section section-pagination">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h4>Progress Bars</h4>
            <div class="progress-container">
              <span class="progress-badge">Default</span>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                  <span class="progress-value">25%</span>
                </div>
              </div>
            </div>
            <div class="progress-container progress-primary">
              <span class="progress-badge">Primary</span>
              <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                  <span class="progress-value">60%</span>
                </div>
              </div>
            </div>
            <br>
            <h4>Navigation Pills</h4>
            <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#active" role="tablist">
                  <i class="far fa-gem"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#link" role="tablist">
                  <i class="fa fa-thermometer-full"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link" role="tablist">
                  <i class="fa fa-suitcase"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" data-toggle="tab" href="#disabled" role="tablist">
                  <i class="fa fa-exclamation"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-sm-6">
            <h4>Pagination</h4>
            <ul class="pagination pagination-primary">
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link">5</a>
              </li>
            </ul>
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#link" aria-label="Previous">
                  <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link">1</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#link">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#link" aria-label="Next">
                  <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                </a>
              </li>
            </ul>
            <br>
            <h4>Labels</h4>
            <span class="badge badge-default">Default</span>
            <span class="badge badge-primary">Primary</span>
            <span class="badge badge-success">Success</span>
            <span class="badge badge-info">Info</span>
            <span class="badge badge-warning">Warning</span>
            <span class="badge badge-danger">Danger</span>
            <span class="badge badge-neutral">Neutral</span>
          </div>
        </div>
        <br>
        <div class="space"></div>
        <h4>Notifications</h4>
      </div>
    </div>

    <!-- Typography -->

    <div class="section section-javascript" id="javascriptComponents">
      <div class="container">
        <h3 class="title">Javascript components</h3>
        <div class="row" id="modals">
          <div class="col-md-6">
            <h4>Modal</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Launch Modal
            </button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#myModal1">
              Launch Modal Mini
            </button>
          </div>
          <div class="col-md-6">
            <h4>Popovers</h4>
            <button type="button" class="btn btn-default" data-container="body" data-original-title="Popover On Left" data-toggle="popover" data-placement="left" data-content="Here will be some very useful information about his popover." data-color="primary">
              On left
            </button>
            <button type="button" class="btn btn-default" data-container="body" data-original-title="Popover on Top" data-toggle="popover" data-placement="top" data-content="Here will be some very useful information about his popover.">
              On top
            </button>
            <button type="button" class="btn btn-default" data-container="body" data-original-title="Popover on Right" data-toggle="popover" data-placement="right" data-content="Here will be some very useful information about his popover.<br> Here will be some very useful information about his popover.">
              On right
            </button>
            <button type="button" class="btn btn-default" data-container="body" data-original-title="Popover on Bottom" data-toggle="popover" data-placement="bottom" data-content="Here will be some very useful information about his popover.">
              On bottom
            </button>
          </div>
          <br />
          <br />
          <div class="col-md-6">
            <h4>Datepicker</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="datepicker-container">
                  <div class="form-group">
                    <input type="text" class="form-control date-picker" value="10/05/2016" data-datepicker-color="primary">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h4>Tooltips</h4>
            <button type="button" class="btn btn-default btn-tooltip" data-toggle="tooltip" data-placement="left" title="Tooltip on left" data-container="body" data-animation="true" data-delay="100">On left</button>
            <button type="button" class="btn btn-default btn-tooltip" data-toggle="tooltip" data-placement="top" title="Tooltip on top" data-container="body" data-animation="true">On top</button>
            <button type="button" class="btn btn-default btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" data-container="body" data-animation="true">On bottom</button>
            <button type="button" class="btn btn-default btn-tooltip" data-toggle="tooltip" data-placement="right" title="Tooltip on right" data-container="body" data-animation="true">On right</button>
            <div class="clearfix"></div>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
    <div class="section" id="carousel">
      <div class="container">
        <div class="title">
          <h4>Carousel</h4>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block" src="assets/img/bg1.jpg" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Nature, United States</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="assets/img/bg3.jpg" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Somewhere Beyond, United States</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="assets/img/bg4.jpg" alt="Third slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Yellowstone National Park, United States</h5>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-nucleo-icons">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <h2 class="title">Nucleo Icons</h2>
            <h5 class="description">
              Now UI Kit PRO comes with 100 custom icons made by our friends from NucleoApp. The official package contains over 2.100 thin icons which are looking great in combination with Now UI Kit PRO Make sure you check all of them and use those that you like the most.
            </h5>
            <!-- <div class="nucleo-container">
              <img src="assets/img/nucleo.svg" alt="">
            </div> -->
            <a href="nucleo-icons.html" class="btn btn-primary btn-round btn-lg" target="_blank">View Demo Icons</a>
            <a href="https://nucleoapp.com/?ref=1712" class="btn btn-outline-primary btn-round btn-lg" target="_blank">View All Icons</a>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="icons-container">
              <i class="now-ui-icons ui-1_send"></i>
              <i class="now-ui-icons ui-2_like"></i>
              <i class="now-ui-icons transportation_air-baloon"></i>
              <i class="now-ui-icons text_bold"></i>
              <i class="now-ui-icons tech_headphones"></i>
              <i class="now-ui-icons emoticons_satisfied"></i>
              <i class="now-ui-icons shopping_cart-simple"></i>
              <i class="now-ui-icons objects_spaceship"></i>
              <i class="now-ui-icons media-2_note-03"></i>
              <i class="now-ui-icons ui-2_favourite-28"></i>
              <i class="now-ui-icons design_palette"></i>
              <i class="now-ui-icons clothes_tie-bow"></i>
              <i class="now-ui-icons location_pin"></i>
              <i class="now-ui-icons objects_key-25"></i>
              <i class="now-ui-icons travel_istanbul"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container text-center">
        <div class="row justify-content-md-center">
          <div class="col-md-12 col-lg-8">
            <h2 class="title">Completed with examples</h2>
            <h5 class="description">The kit comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go. More importantly, looking at them will give you a picture of what you can built with this powerful Bootstrap 4 ui kit.</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-signup" style="background-image: url('assets/img/bg11.jpg'); background-size: cover; background-position: top center; min-height: 700px;">
      <div class="container">
        <div class="row">
          <div class="card card-signup" data-background-color="orange">
            <form class="form" method="" action="">
              <div class="card-header text-center">
                <h3 class="card-title title-up">Sign Up</h3>
                <div class="social-line">
                  <a href="#pablo" class="btn btn-neutral btn-facebook btn-icon btn-round">
                    <i class="fab fa-facebook-square"></i>
                  </a>
                  <a href="#pablo" class="btn btn-neutral btn-twitter btn-icon btn-lg btn-round">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#pablo" class="btn btn-neutral btn-google btn-icon btn-round">
                    <i class="fab fa-google-plus"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="input-group no-border">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="First Name...">
                </div>
                <div class="input-group no-border">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons text_caps-small"></i>
                    </span>
                  </div>
                  <input type="text" placeholder="Last Name..." class="form-control" />
                </div>
                <div class="input-group no-border">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons ui-1_email-85"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Email...">
                </div>
                <!-- If you want to add a checkbox to this form, uncomment this code -->
                <!-- <div class="checkbox">
                <input id="checkboxSignup" type="checkbox">
                  <label for="checkboxSignup">
                  Unchecked
                  </label>
                </div> -->
              </div>
              <div class="card-footer text-center">
                <a href="#pablo" class="btn btn-neutral btn-round btn-lg">Get Started</a>
              </div>
            </form>
          </div>
        </div>
        <div class="col text-center">
          <a href="examples/login-page.html" class="btn btn-outline-default btn-round btn-white btn-lg" target="_blank">View Login Page</a>
        </div>
      </div>
    </div>
    <div class="section section-examples" data-background-color="black">
      <div class="space-50"></div>
      <div class="container text-center">
        <div class="row">
          <div class="col">
            <a href="examples/landing-page.html" target="_blank">
              <img src="assets/img/landing.jpg" alt="Image" class="img-raised">
            </a>
            <a href="examples/landing-page.html" class="btn btn-outline-default btn-primary btn-round">View Landing Page</a>
          </div>
          <div class="col">
            <a href="examples/profile-page.html" target="_blank">
              <img src="assets/img/profile.jpg" alt="Image" class="img-raised">
            </a>
            <a href="examples/profile-page.html" class="btn btn-outline-default btn-primary btn-round">View Profile Page</a>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-download" id="#download-section" data-background-color="black">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="text-center col-md-12 col-lg-8">
            <h3 class="title">Do you love this Bootstrap 4 UI Kit?</h3>
            <h5 class="description">Cause if you do, it can be yours for FREE. Hit the button below to navigate to Creative Tim or Invision where you can find the kit in HTML or Sketch/PSD format. Start a new project or give an old Bootstrap project a new look!</h5>
          </div>
          <div class="text-center col-md-12 col-lg-8">
            <a href="https://www.creative-tim.com/product/now-ui-kit" class="btn btn-primary btn-lg btn-round" role="button">
              Download HTML
            </a>
            <a href="https://www.invisionapp.com/now" target="_blank" class="btn btn-lg btn-outline-primary btn-round" role="button">
              Download PSD/Sketch
            </a>
          </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row text-center mt-5">
          <div class="col-md-8 ml-auto mr-auto">
            <h2>Want more?</h2>
            <h5 class="description">We've just launched
              <a href="http://demos.creative-tim.com/now-ui-kit-pro/presentation.html" target="_blank">Now UI Kit PRO</a>. It has a huge number of components, sections and example pages. Start Your Development With A Badass Bootstrap 4 UI Kit.
            </h5>
          </div>
          <div class="col-md-12">
            <a href="http://demos.creative-tim.com/now-ui-kit-pro/presentation.html" class="btn btn-neutral btn-round btn-lg" target="_blank">
              <i class="now-ui-icons arrows-1_share-66"></i> Upgrade to PRO
            </a>
          </div>
        </div>
        <br>
        <br>
        <div class="row justify-content-md-center sharing-area text-center">
          <div class="text-center col-md-12 col-lg-8">
            <h3>Thank you for supporting us!</h3>
          </div>
          <div class="text-center col-md-12 col-lg-8">
            <a target="_blank" href="https://www.twitter.com/creativetim" class="btn btn-neutral btn-icon btn-twitter btn-round btn-lg" rel="tooltip" title="Follow us">
              <i class="fab fa-twitter"></i>
            </a>
            <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-neutral btn-icon btn-facebook btn-round btn-lg" rel="tooltip" title="Like us">
              <i class="fab fa-facebook-square"></i>
            </a>
            <a target="_blank" href="https://www.linkedin.com/company-beta/9430489/" class="btn btn-neutral btn-icon btn-linkedin btn-lg btn-round" rel="tooltip" title="Follow us">
              <i class="fab fa-linkedin"></i>
            </a>
            <a target="_blank" href="https://github.com/creativetimofficial/now-ui-kit" class="btn btn-neutral btn-icon btn-github btn-round btn-lg" rel="tooltip" title="Star on Github">
              <i class="fab fa-github"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Sart Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>
          <h4 class="title title-up">Modal title</h4>
        </div>
        <div class="modal-body">
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default">Nice Button</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--  End Modal -->
  <!-- Mini Modal -->
  <div class="modal fade modal-mini modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="modal-profile">
            <i class="now-ui-icons users_circle-08"></i>
          </div>
        </div>
        <div class="modal-body">
          <p>Always have an access to your profile</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link btn-neutral">Back</button>
          <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection