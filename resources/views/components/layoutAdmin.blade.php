<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>POS Dash | Responsive Bootstrap 4 Admin Dashboard Template</title>
      
      <!-- Favicon -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
      <script src="{{ asset('assets/map/leaflet.ajax.js') }}" ></script>
      <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
      <link rel="stylesheet" href="{{ asset('/assets/css/backend-plugin.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/backend.css?v=1.0.0') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}/">
      <link rel="stylesheet" href="{{ asset('/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendor/remixicon/fonts/remixicon.css') }}">  
      
      
  </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="/dashboard" class="header-logo">
                  <img src="{{ asset('/assets/images/logo.png') }}" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo ml-3">POSDash</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                          <a href="/dashboard" class="svg-icon">                        
                              <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Dashboard</span>
                          </a>
                    </li>
                    <li class=" {{ Request::is('dashboard/kecamatan')||Request::is('dashboard/kecamatan/create') ? 'active' : '' }}">
                          <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.875 12.5729C5.30847 11.2498 5 9.84107 5 8.51463C5 4.9167 8.13401 2 12 2C15.866 2 19 4.9167 19 8.51463C19 12.0844 16.7658 16.2499 13.2801 17.7396C12.4675 18.0868 11.5325 18.0868 10.7199 17.7396C9.60664 17.2638 8.62102 16.5151 7.79508 15.6" stroke="#676e8a" stroke-width="1.9200000000000004" stroke-linecap="round"></path> <path d="M14 9C14 10.1046 13.1046 11 12 11C10.8954 11 10 10.1046 10 9C10 7.89543 10.8954 7 12 7C13.1046 7 14 7.89543 14 9Z" stroke="#676e8a" stroke-width="1.9200000000000004"></path> <path d="M20.9605 15.5C21.6259 16.1025 22 16.7816 22 17.5C22 18.4251 21.3797 19.285 20.3161 20M3.03947 15.5C2.37412 16.1025 2 16.7816 2 17.5C2 19.9853 6.47715 22 12 22C13.6529 22 15.2122 21.8195 16.5858 21.5" stroke="#676e8a" stroke-width="1.9200000000000004" stroke-linecap="round"></path> </g></svg>
                              <span class="ml-4">Kecamatan</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                              <li class="">
                                  <a href="/dashboard/kecamatan">
                                      <i class="las la-minus"></i><span>Daftar Kecamatan</span>
                                  </a>
                              </li>
                              <li class="">
                                  <a href="/dashboard/kecamatan/create">
                                      <i class="las la-minus"></i><span>Tambah Data Kecamatan</span>
                                  </a>
                              </li>
                          </ul>
                    </li>
                   <li class="{{ Request::is('dashboard/klaster') || Request::is('dashboard/klaster/create') ? 'active' : '' }}">
                        <a href="#sale" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash4" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                            </svg>
                            <span class="ml-4">Klaster</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="sale" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="">
                                        <a href="/dashboard/klaster">
                                            <i class="las la-minus"></i><span>Daftar Klaster</span>
                                        </a>
                                </li>
                                <li class="">
                                        <a href="/dashboard/klaster/create">
                                            <i class="las la-minus"></i><span>Tambah Klaster</span>
                                        </a>
                                </li>
                        </ul>
                    </li>
                    <li class=" {{ Request::is('dashboard/curas')||Request::is('dashboard/curas/create') ||Request::is('dashboard/curanmor/create') ||Request::is('dashboard/curanmor/create') ? 'active' : '' }}">
                        <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="ml-4">Curas & Curanmor</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="people" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="">
                                        <a href="/dashboard/curas">
                                            <i class="las la-minus"></i><span>Kasus Curas</span>
                                        </a>
                                </li>
                                <li class="">
                                        <a href="/dashboard/curas/create">
                                            <i class="las la-minus"></i><span>Tambah Kasus Curas</span>
                                        </a>
                                </li>
                                
                                <li class="">
                                        <a href="/dashboard/curanmor">
                                            <i class="las la-minus"></i><span>Kasus Curanmor</span>
                                        </a>
                                </li>
                                <li class="">
                                        <a href="/dashboard/curanmor/create">
                                            <i class="las la-minus"></i><span>Tambah Kasus Curanmor</span>
                                        </a>
                                </li>
                                
                        </ul>
                    </li>
                    <li class=" {{ Request::is('dashboard/mapcuras')||Request::is('dashboard/mapcuranmor') ? 'active' : '' }}">
                        <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#676e8a"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 7.16229C21 6.11871 21 5.59692 20.7169 5.20409C20.4337 4.81126 19.9387 4.64625 18.9487 4.31624L17.7839 3.92799C16.4168 3.47229 15.7333 3.24444 15.0451 3.3366C14.3569 3.42876 13.7574 3.82843 12.5583 4.62778L11.176 5.54937C10.2399 6.1734 9.77191 6.48541 9.24685 6.60952C9.05401 6.65511 8.85714 6.68147 8.6591 6.68823C8.11989 6.70665 7.58626 6.52877 6.51901 6.17302C5.12109 5.70705 4.42213 5.47406 3.89029 5.71066C3.70147 5.79466 3.53204 5.91678 3.39264 6.06935C3 6.49907 3 7.23584 3 8.70938V12.7736M21 11V15.2907C21 16.7642 21 17.501 20.6074 17.9307C20.468 18.0833 20.2985 18.2054 20.1097 18.2894C19.5779 18.526 18.8789 18.293 17.481 17.827C16.4137 17.4713 15.8801 17.2934 15.3409 17.3118C15.1429 17.3186 14.946 17.3449 14.7532 17.3905C14.2281 17.5146 13.7601 17.8266 12.824 18.4507L11.4417 19.3722C10.2426 20.1716 9.64311 20.5713 8.95493 20.6634C8.26674 20.7556 7.58319 20.5277 6.21609 20.072L5.05132 19.6838C4.06129 19.3538 3.56627 19.1888 3.28314 18.7959C3.01507 18.424 3.0008 17.9365 3.00004 17" stroke="#676e8a" stroke-width="1.9200000000000004" stroke-linecap="round"></path> <path d="M15 3.5V7M15 17V11" stroke="#676e8a" stroke-width="1.9200000000000004" stroke-linecap="round"></path> <path d="M9 20.5V17M9 7V13" stroke="#676e8a" stroke-width="1.9200000000000004" stroke-linecap="round"></path> </g></svg>
                            <span class="ml-4">Hasil Pemetaan</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="/dashboard/mapcuras">
                                    <i class="las la-minus"></i><span>Pemetaan Kasus Curas</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="/dashboard/mapcuranmor">
                                    <i class="las la-minus"></i><span>Pemetaan Kasus Curanmor</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    

                  </ul>
              </nav>
              <div class="p-3"></div>
          </div>
          </div>      <div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                      <a href="../backend/index.html" class="header-logo">
                          <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal" alt="logo">
                          <h5 class="logo-title ml-3">POSDash</h5>
      
                      </a>
                  </div>
                  <div class="iq-search-bar device-search">
                      <form action="#" class="searchbox">
                          <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                          <input type="text" class="text search-input" placeholder="Search here...">
                      </form>
                  </div>
                  <div class="d-flex align-items-center">
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle btn border add-btn"
                                      id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true"
                                      aria-expanded="false">
                                      <img src="{{ asset('assets/images/small/flag-01.png') }}" alt="img-flag"
                                          class="img-fluid image-flag mr-2">En
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-3">
                                              <a class="iq-sub-card" href="#"><img
                                                      src="{{ asset('assets/images/small/flag-02.png') }}" alt="img-flag"
                                                      class="img-fluid mr-2">French</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="{{ asset('assets/images/small/flag-03.png') }}" alt="img-flag"
                                                      class="img-fluid mr-2">Spanish</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="{{ asset('assets/images/small/flag-04.png') }}" alt="img-flag"
                                                      class="img-fluid mr-2">Italian</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="{{ asset('assets/images/small/flag-05.png') }}" alt="img-flag"
                                                      class="img-fluid mr-2">German</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="{{ asset('assets/images/small/flag-06.png') }}" alt="img-flag"
                                                      class="img-fluid mr-2">Japanese</a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block"
                                      data-toggle="modal" data-target="#new-order"><i class="las la-plus mr-2"></i>New
                                      Order</a>
                              </li>
                              <li class="nav-item nav-icon search-content">
                                  <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="ri-search-line"></i>
                                  </a>
                                  <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                      <form action="#" class="searchbox p-2">
                                          <div class="form-group mb-0 position-relative">
                                              <input type="text" class="text search-input font-size-12"
                                                  placeholder="type here to search...">
                                              <a href="#" class="search-link"><i class="las la-search"></i></a>
                                          </div>
                                      </form>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-mail">
                                          <path
                                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                          </path>
                                          <polyline points="22,6 12,13 2,6"></polyline>
                                      </svg>
                                      <span class="bg-primary"></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">All Messages</h5>
                                                      <a class="badge badge-primary badge-card" href="#">3</a>
                                                  </div>
                                              </div>
                                              <div class="px-3 pt-0 pb-0 sub-card">
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="{{ asset('assets/images/user/01.jpg') }}" alt="01">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Emma Watson</h6>
                                                                  <small class="text-dark"><b>12 : 47 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="{{ asset('assets/images/user/02.jpg') }}" alt="02">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Ashlynn Franci</h6>
                                                                  <small class="text-dark"><b>11 : 30 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="{{ asset('assets/images/user/03.jpg') }}" alt="03">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Kianna Carder</h6>
                                                                  <small class="text-dark"><b>11 : 21 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </div>
                                              <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                                  role="button">
                                                  View All
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-bell">
                                          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                      </svg>
                                      <span class="bg-primary "></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">Notifications</h5>
                                                      <a class="badge badge-primary badge-card" href="#">3</a>
                                                  </div>
                                              </div>
                                              <div class="px-3 pt-0 pb-0 sub-card">
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="{{ asset('assets/images/user/01.jpg') }}" alt="01">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Emma Watson</h6>
                                                                  <small class="text-dark"><b>12 : 47 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="{{ asset('assets/images/user/02.jpg') }}" alt="02">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Ashlynn Franci</h6>
                                                                  <small class="text-dark"><b>11 : 30 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="{{ asset('assets/images/user/03.jpg') }}" alt="03">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Kianna Carder</h6>
                                                                  <small class="text-dark"><b>11 : 21 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </div>
                                              <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                                  role="button">
                                                  View All
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown caption-content">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="{{ asset('assets/images/user/1.png') }}" class="img-fluid rounded" alt="user">
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="{{ asset('assets/images/page-img/profile-bg.jpg') }}" alt="profile-bg"
                                                      class="rounded-top img-fluid mb-4">
                                                  <img src="{{ asset('assets/images/user/1.png') }}" alt="profile-img"
                                                      class="rounded profile-img img-fluid avatar-70">
                                              </div>
                                              <div class="p-3">
                                                  <h5 class="mb-1">JoanDuo@property.com</h5>
                                                  <p class="mb-0">Since 10 march, 2020</p>
                                                  <div class="d-flex align-items-center justify-content-center mt-3">
                                                      <a href="../app/user-profile.html" class="btn border mr-2">Profile</a>
                                                      <a href="auth-sign-in.html" class="btn border">Sign Out</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </div>
      <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                      <div class="popup text-left">
                          <h4 class="mb-3">New Order</h4>
                          <div class="content create-workform bg-body">
                              <div class="pb-3">
                                  <label class="mb-2">Email</label>
                                  <input type="text" class="form-control" placeholder="Enter Name or Email">
                              </div>
                              <div class="col-lg-12 mt-4">
                                  <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                      <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                      <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      {{ $slot }}


    </div>
</div>
<!-- Wrapper End-->
<footer class="iq-footer">
        <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Backend Bundle JavaScript -->
<script src="{{ asset('/assets/js/backend-bundle.min.js') }}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{ asset('/assets/js/table-treeview.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('/assets/js/customizer.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script async src="{{ asset('/assets/js/chart-custom.js') }}"></script>

<!-- app JavaScript -->
<script src="{{ asset('/assets/js/app.js') }}"></script>
</body>
</html>