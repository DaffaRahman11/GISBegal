<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>
      KPROTECT | Probolinggo Threat & Crime Tracker
    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/assetLanding/images/favicon2.png') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assetLanding/css/bootstrap.min.css') }}" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assetLanding/css/typography.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assetLanding/css/style.css') }}" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assetLanding/css/responsive.css') }}" />
  </head>
  <body>
    <!-- loading -->
    <div id="loading">
      <div id="loading-center">
        <img src="{{ asset('assets/assetLanding/images/loader.gif') }}" alt="loder" />
      </div>
    </div>
    <!-- loading End -->
    <div class="login-from header-navbar light-gray-bg position-relative">
      <div class="row no-gutters">
        <div class="col-lg-6 align-items-stretch position-relative white-bg">
          <nav class="navbar navbar-expand-lg navbar-light">
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Privacy</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Terms</a>
                </li>
              </ul>
            </div>
          </nav>
          <div class="login-info">
            <h2 class="iq-fw-9 mb-3">Login</h2>
            <h6>
              Selamat Datang Di <span class="main-color">PROTECT</span> Silakan Masuk Ke Akun Anda
            </h6>

                @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                </div>
            @endif

            <form action="/login" method="POST">
              @csrf
              <div class="form-group">
               <label>Masukkan Email</label>
                <input
                  id="email"
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="Email"
                  autocomplete="email"
                  autofocus
                  required @error('email') is-invalid
                  @enderror value="{{ old('email') }}"
                />
              </div>
              <div class="form-group">
               <label>Masukkan Password</label>
                <input
                  id="password"
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="Password"
                  required
                />
              </div>
              
              <button type="submit" class="slide-button button mr-3 w-100">
               <div class="first">Login</div>
               <div class="second">Login</div>
             </button>

            </form>
          </div>
          <ul class="social-list">
            <li>
              <a href="#"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-google-plus-g"></i></a>
            </li>
          </ul>
        </div>
        <div class="col-lg-6 align-self-center position-relative">
          <div class="login-right-bar h-100 text-center">
            <img src="{{ asset('assets/assetLanding/images/login/login.png') }}" class="img-fluid" alt="" />
          </div>
        </div>
      </div>
      <img src="{{ asset('assets/assetLanding/images/login/2.png') }}" class="img-fluid login-footer-one" alt="" />
      <img src="{{ asset('assets/assetLanding/images/login/3.png') }}" class="img-fluid login-footer-two" alt="" />
      <img
        src="{{ asset('assets/assetLanding/images/login/1.png') }}"
        class="img-fluid login-footer-three"
        alt=""
      />
      <!-- back-to-top -->
      <div id="back-to-top">
        <a class="top" id="top" href="#top"
          ><i class="ion-ios-arrow-thin-up"></i
        ></a>
      </div>
      <!-- back-to-top End -->
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/assetLanding/js/jquery-min.js') }}"></script>
    <!-- popper  -->
    <script src="{{ asset('assets/assetLanding/js/popper.min.js') }}"></script>
    <!--  bootstrap -->
    <script src="{{ asset('assets/assetLanding/js/bootstrap.min.js') }}"></script>
    <!-- Modernizr JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/modernizr.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/appear.min.js') }}"></script>
    <!-- Megamenu  -->
    <script src="{{ asset('assets/assetLanding/js/mega_menu.min.js') }}"></script>
    <!-- Timeline JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/timeline.js') }}"></script>
    <!-- Wow -->
    <script src="{{ asset('assets/assetLanding/js/wow.min.js') }}"></script>
    <!-- scrollme -->
    <script src="{{ asset('assets/assetLanding/js/jquery.scrollme.min.js') }}"></script>
    <!-- countdown JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/countdown.js') }}"></script>
    <!-- waypoints JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/waypoints.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/jquery.counterup.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Isotope JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/isotope.pkgd.min.js') }}"></script>
    <!-- Progressbar JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/circle-progress.min.js') }}"></script>
    <!-- Canvas JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/canvasjs.min.js') }}"></script>
    <!-- Retina JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/retina.min.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/custom.js') }}"></script>
  </body>
</html>
