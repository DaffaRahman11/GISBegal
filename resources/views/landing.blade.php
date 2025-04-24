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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/map/leaflet.ajax.js') }}" ></script>
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
    <style>
        #map {
          position: relative; /* bukan absolute atau fixed */
          z-index: 0; /* pastikan ini lebih rendah dari header atau layout */
        }

        .progressbar {
            text-align: center;
            margin: 20px; /* Tambahkan jarak antar progressbar */
        }

        .circle-outer {
          width: 150px;
          height: 150px;
          border-radius: 50%;
          background-color: #35e1a4;
          display: flex;
          justify-content: center;
          align-items: center;
          margin: 0 auto;
        }

        .circle-inner {
          width: 110px;
          height: 110px;
          border-radius: 50%;
          background-color: #2980b9;
          display: flex;
          justify-content: center;
          align-items: center;
          color: white;
          font-size: 32px;
          font-weight: bold;
        }
      
        .iq-progress-bar-text {
            margin-top: 15px;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .map-legend {
          position: absolute;
          background: rgba(255, 255, 255, 0.8);
          padding: 10px 15px;
          border-radius: 10px;
          box-shadow: 0 2px 5px rgba(0,0,0,0.2);
          z-index: 1000;
          max-width: 400px;
        }

        .top-right {
            top: 20px;
            right: 20px;
        }

        .top-left {
            bottom: 20px;
            left: 20px;
        }

        .legend-item {
          display: flex;
          align-items: left;

          margin-bottom: 5px;
        } 

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 10px;
            border: 1px solid #ccc;
        }

        .legend-label {
            font-size: 14px;
            color: #333;
        }
    </style>
  </head>
  <body>
    <!-- loading -->
    <div id="loading">
      <div id="loading-center">
        <img src="{{ asset('assets/assetLanding/images/loader.gif') }}" alt="loder" />
      </div>
    </div>
    <!-- loading End -->
    <!-- Header -->
    <header id="main-header" class="header-two">
      <!-- menu start -->
      <nav id="menu-1" class="mega-menu" data-color="">
        <!-- menu list items container -->
        <div class="menu-list-items">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <!-- menu logo -->
                <ul class="menu-logo">
                  <li>
                    <a href="/"
                      ><img
                        src="{{ asset('assets/assetLanding/images/logo.png') }}"
                        alt="logo"
                        class="img-fluid"
                    /></a>
                  </li>
                </ul>
                <!-- menu search bar -->
                <ul class="menu-search-bar pull-right">
                  <li>
                    <form method="post" action="#">
                      <label>
                        <input
                          name="menu_search_bar"
                          placeholder="Search"
                          type="search"
                        />
                        <i class="fas fa-search"></i>
                      </label>
                    </form>
                  </li>
                </ul>
                <!-- menu links -->
                <ul class="menu-links">
                  <!-- active class -->
                  <li>
                    <a href="#home" class="active">Home</a>
                  </li>
                  <li>
                    <a href="#sectionCurasCuranmor">Curas & Curanmor</a>
                    <!-- drop down full width -->
                  </li>
                  <li>
                    <a href="#sectionKmeans">Clustering</a>
                    <!-- drop down third level -->
                  </li>
                  <li>
                    <a href="#sectionMap">Map</a>
                  </li>
                  <li><a href="#sectionOurTeam">Our Teams</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <!-- menu end -->
    </header>
    <!-- Header END -->
    <!-- Banner -->
    <div class="iq-banner" id="home">
      <div
        id="rev_slider_12_1_wrapper"
        class="rev_slider_wrapper fullwidthbanner-container"
        data-alias="marketive-two"
        data-source="gallery"
        style="
          margin: 0px auto;
          background: transparent;
          padding: 0px;
          margin-top: 0px;
          margin-bottom: 0px;
        "
        >
        <!-- START REVOLUTION SLIDER 5.4.3.1 fullwidth mode -->
        <div
          id="rev_slider_12_1"
          class="rev_slider fullwidthabanner"
          style="display: none"
          data-version="5.4.3.1"
          >
          <ul>
            <!-- SLIDE  -->
            <li
              data-index="rs-42"
              data-transition="fade"
              data-slotamount="default"
              data-hideafterloop="0"
              data-hideslideonmobile="off"
              data-easein="default"
              data-easeout="default"
              data-masterspeed="300"
              data-rotate="0"
              data-saveperformance="off"
              data-title="Slide"
              data-param1=""
              data-param2=""
              data-param3=""
              data-param4=""
              data-param5=""
              data-param6=""
              data-param7=""
              data-param8=""
              data-param9=""
              data-param10=""
              data-description=""
              >
              <!-- MAIN IMAGE -->
              <img
                src="{{ asset('assets/assetLanding/revslider/assets/b5690-bg-2.jpg') }}"
                alt=""
                data-bgposition="center center"
                data-bgfit="cover"
                data-bgrepeat="no-repeat"
                data-bgparallax="off"
                class="rev-slidebg"
                data-no-retina
              />
              <!-- LAYERS -->
              <!-- LAYER NR. 12 -->
              <h1
                class="tp-caption tp-resizeme"
                id="slide-42-layer-1"
                data-x="56"
                data-y="center"
                data-voffset="-60"
                data-width="['auto']"
                data-height="['auto']"
                data-type="text"
                data-responsive_offset="on"
                data-frames='[{"delay":600,"speed":1020,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="
                  z-index: 5;
                  white-space: nowrap;
                  text-transform: capitalize;
                  font-size: 60px;
                  line-height: 70px;
                  font-weight: 700;
                  color: rgba(255, 255, 255, 1);
                  font-family: 'Nunito', sans-serif;
                "
              >
                <strong>KP</strong>rotect<br /> Probolinggo
              </h1> 
              <!-- LAYER NR. 13 -->
              <p
                class="tp-caption tp-resizeme"
                id="slide-42-layer-2"
                data-x="59"
                data-y="center"
                data-voffset="50"
                data-width="['auto']"
                data-height="['auto']"
                data-type="text"
                data-responsive_offset="on"
                data-frames='[{"delay":600,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="
                  z-index: 6;
                  white-space: nowrap;
                  font-size: 16px;
                  line-height: 30px;
                  font-weight: 400;
                  color: rgba(255, 255, 255, 1);
                  font-family: 'Poppins', sans-serif;
                "
              >
                Website Informasi Geografis yang dirancang untuk memetakan<br /> 
                kasus Curas dan Curanmor di Kabupaten Probolinggo
                
              </p>
              <!-- LAYER NR. 14 -->
              <div
                class="tp-caption rev-btn button button-sm rev-withicon tp-resizeme rs-hover-ready"
                id="slide-42-layer-3"
                data-x="60"
                data-y="center"
                data-voffset="130"
                data-width="['auto']"
                data-height="['auto']"
                data-type="button"
                data-responsive_offset="on"
                data-responsive="on"
                data-frames='[{"delay":600,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":""}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop=""
                data-paddingright="[35,35,35,35]"
                data-paddingbottom=""
                data-paddingleft="[35,35,35,35]"
                style="
                  z-index: 7;
                  white-space: nowrap;
                  font-size: 18px;
                  line-height: 50px;
                  height: auto;
                  font-weight: 300;
                  color: rgb(255, 255, 255);
                  font-family: Nunito;
                  padding: 0px 35px;
                  border-color: rgb(0, 0, 0);
                  border-radius: 30px;
                  outline: none;
                  box-shadow: rgb(153, 153, 153) 0px 0px 0px 0px;
                  box-sizing: border-box;
                  cursor: pointer;
                  visibility: inherit;
                  transition: none 0s ease 0s;
                  text-align: inherit;
                  margin: 0px;
                  letter-spacing: 1px;
                  min-height: 0px;
                  min-width: 0px;
                  max-height: none;
                  max-width: none;
                  opacity: 1;
                  transform: matrix3d(
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1
                  );
                  transform-origin: 50% 50% 0px;
                  border-width: 0px;
                "
               >
                <a href="#sectionMap">Cek Daerahmu </a>
              </div>
              <!-- LAYER NR. 15 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-42-layer-4"
                data-x="626"
                data-y="219"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":900,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 8"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/81a17-Untitled-57.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 16 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-42-layer-5"
                data-x="630"
                data-y="468"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":900,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 9"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/0d1ed-Untitled-58.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 17 -->
              
              <!-- LAYER NR. 18 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-42-layer-13"
                data-x="859"
                data-y="317"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1200,"speed":1500,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 11"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/desktop.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                  style="width: 300px; height: auto;"
                />
              </div>
             
              <!-- LAYER NR. 22 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-42-layer-18"
                data-x="690"
                data-y="342"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1800,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 15"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/bea0c-04.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 23 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-42-layer-19"
                data-x="1161"
                data-y="374"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1800,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 16"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/c18a0-05.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 24 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-42-layer-20"
                data-x="1222"
                data-y="283"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":2100,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 17"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/3b231-10.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              
            </li>
            <!-- SLIDE  -->
            <li
              data-index="rs-41"
              data-transition="fade"
              data-slotamount="default"
              data-hideafterloop="0"
              data-hideslideonmobile="off"
              data-easein="default"
              data-easeout="default"
              data-masterspeed="600"
              data-rotate="0"
              data-saveperformance="off"
              data-title="Slide"
              data-param1=""
              data-param2=""
              data-param3=""
              data-param4=""
              data-param5=""
              data-param6=""
              data-param7=""
              data-param8=""
              data-param9=""
              data-param10=""
              data-description=""
              >
              <!-- MAIN IMAGE -->
              <img
                src="{{ asset('assets/assetLanding/revslider/assets/b5690-bg-2.jpg') }}"
                alt=""
                data-bgposition="center center"
                data-bgfit="cover"
                data-bgrepeat="no-repeat"
                data-bgparallax="off"
                class="rev-slidebg"
                data-no-retina
              />
              <!-- LAYERS -->
              <!-- LAYER NR. 1 -->
              <h1
                class="tp-caption tp-resizeme"
                id="slide-41-layer-1"
                data-x="60"
                data-y="center"
                data-voffset="-60"
                data-width="['auto']"
                data-height="['auto']"
                data-type="text"
                data-responsive_offset="on"
                data-frames='[{"delay":600,"speed":1020,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="
                  z-index: 5;
                  text-transform: capitalize;
                  white-space: nowrap;
                  font-size: 60px;
                  line-height: 70px;
                  font-weight: 700;
                  color: rgba(255, 255, 255, 1);
                  font-family: 'Nunito', sans-serif;
                "
              >
                Curas & Curanmor
              </h1>
              <!-- LAYER NR. 2 -->
              <p
                class="tp-caption tp-resizeme"
                id="slide-41-layer-2"
                data-x="59"
                data-y="center"
                data-voffset="60"
                data-width="['auto']"
                data-height="['auto']"
                data-type="text"
                data-responsive_offset="on"
                data-frames='[{"delay":600,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="
                  z-index: 6;
                  white-space: nowrap;
                  font-size: 16px;
                  line-height: 30px;
                  font-weight: 400;
                  color: rgba(255, 255, 255, 1);
                  font-family: 'Poppins', sans-serif;
                "
              >
                Kasus Curas dan Curanmor yang semakin sering terjadi di Probolinggo
                <br />Menimbulkan banyak korban dan kerugian  
              </p>
              <!-- LAYER NR. 3 -->
              <div
                class="tp-caption rev-btn button button-sm rev-withicon tp-resizeme rs-hover-ready"
                id="slide-41-layer-3"
                data-x="60"
                data-y="center"
                data-voffset="140"
                data-width="['auto']"
                data-height="['auto']"
                data-type="button"
                data-responsive_offset="on"
                data-responsive="on"
                data-frames='[{"delay":600,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":""}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop=""
                data-paddingright="[35,35,35,35]"
                data-paddingbottom=""
                data-paddingleft="[35,35,35,35]"
                style="
                  z-index: 7;
                  white-space: nowrap;
                  font-size: 18px;
                  line-height: 50px;
                  height: auto;
                  font-weight: 300;
                  color: rgb(255, 255, 255);
                  font-family: Nunito;
                  padding: 0px 35px;
                  border-color: rgb(0, 0, 0);
                  border-radius: 30px;
                  outline: none;
                  box-shadow: rgb(153, 153, 153) 0px 0px 0px 0px;
                  box-sizing: border-box;
                  cursor: pointer;
                  visibility: inherit;
                  transition: none 0s ease 0s;
                  text-align: inherit;
                  margin: 0px;
                  letter-spacing: 1px;
                  min-height: 0px;
                  min-width: 0px;
                  max-height: none;
                  max-width: none;
                  opacity: 1;
                  transform: matrix3d(
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1
                  );
                  transform-origin: 50% 50% 0px;
                  border-width: 0px;
                "
               >
               <a href="#sectionMap">Cek Daerahmu </a>
              </div>
              <!-- LAYER NR. 4 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-41-layer-4"
                data-x="634"
                data-y="222"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":900,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 8"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/81a17-Untitled-57.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 5 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-41-layer-5"
                data-x="609"
                data-y="451"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":900,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 9"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/0d1ed-Untitled-58.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 6 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-41-layer-6"
                data-x="734"
                data-y="210"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1200,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 10"
                >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/a9361-09.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              
              <!-- LAYER NR. 10 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-41-layer-10"
                data-x="992"
                data-y="191"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":2100,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 14"
                >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/awan.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 11 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-41-layer-12"
                data-x="1189"
                data-y="130"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":2100,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 16"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/91840-08.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
            </li>
            <!-- SLIDE  -->
            <li
              data-index="rs-43"
              data-transition="fade"
              data-slotamount="default"
              data-hideafterloop="0"
              data-hideslideonmobile="off"
              data-easein="default"
              data-easeout="default"
              data-masterspeed="300"
              data-rotate="0"
              data-saveperformance="off"
              data-title="Slide"
              data-param1=""
              data-param2=""
              data-param3=""
              data-param4=""
              data-param5=""
              data-param6=""
              data-param7=""
              data-param8=""
              data-param9=""
              data-param10=""
              data-description=""
              >
              <!-- MAIN IMAGE -->
              <img
                src="{{ asset('assets/assetLanding/revslider/assets/b5690-bg-2.jpg') }}"
                alt=""
                data-bgposition="center center"
                data-bgfit="cover"
                data-bgrepeat="no-repeat"
                data-bgparallax="off"
                class="rev-slidebg"
                data-no-retina
              />
              <!-- LAYERS -->
              <!-- LAYER NR. 27 -->
              <h1
                class="tp-caption tp-resizeme"
                id="slide-43-layer-1"
                data-x="56"
                data-y="center"
                data-voffset="-70"
                data-width="['auto']"
                data-height="['auto']"
                data-type="text"
                data-responsive_offset="on"
                data-frames='[{"delay":600,"speed":1020,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="
                  z-index: 5;
                  white-space: nowrap;
                  text-transform: capitalize;
                  font-size: 60px;
                  line-height: 70px;
                  font-weight: 700;
                  color: rgba(255, 255, 255, 1);
                  font-family: 'Nunito', sans-serif;
                "
              >
                Algoritma<br />K - Means Clustering
              </h1>
              <!-- LAYER NR. 28 -->
              <p
                class="tp-caption tp-resizeme"
                id="slide-43-layer-2"
                data-x="58"
                data-y="center"
                data-voffset="50"
                data-width="['auto']"
                data-height="['auto']"
                data-type="text"
                data-responsive_offset="on"
                data-frames='[{"delay":600,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="
                  z-index: 6;
                  white-space: nowrap;
                  font-size: 16px;
                  line-height: 30px;
                  font-weight: 400;
                  color: rgba(255, 255, 255, 1);
                  font-family: 'Poppins', sans-serif;
                "
              >
                Dasar Pemetaan menggunakan data dari Polres Probolinggo
                <br /> Dan di olah menggunakan Algoritma K - Means Clustering
              </p>
              <!-- LAYER NR. 29 -->
              <div
                class="tp-caption rev-btn button button-sm rev-withicon tp-resizeme rs-hover-ready"
                id="slide-43-layer-3"
                data-x="60"
                data-y="center"
                data-voffset="130"
                data-width="['auto']"
                data-height="['auto']"
                data-type="button"
                data-responsive_offset="on"
                data-responsive="on"
                data-frames='[{"delay":600,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":""}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop=""
                data-paddingright="[35,35,35,35]"
                data-paddingbottom=""
                data-paddingleft="[35,35,35,35]"
                style="
                  z-index: 7;
                  white-space: nowrap;
                  font-size: 18px;
                  line-height: 50px;
                  height: auto;
                  font-weight: 300;
                  color: rgb(255, 255, 255);
                  font-family: Nunito;
                  padding: 0px 35px;
                  border-color: rgb(0, 0, 0);
                  border-radius: 30px;
                  outline: none;
                  box-shadow: rgb(153, 153, 153) 0px 0px 0px 0px;
                  box-sizing: border-box;
                  cursor: pointer;
                  visibility: inherit;
                  transition: none 0s ease 0s;
                  text-align: inherit;
                  margin: 0px;
                  letter-spacing: 1px;
                  min-height: 0px;
                  min-width: 0px;
                  max-height: none;
                  max-width: none;
                  opacity: 1;
                  transform: matrix3d(
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1
                  );
                  transform-origin: 50% 50% 0px;
                  border-width: 0px;
                "
               >
                <a href="#sectionMap">Cek Daerahmu </a>
              </div>
              <!-- LAYER NR. 30 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-43-layer-4"
                data-x="622"
                data-y="218"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":900,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 8"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/81a17-Untitled-57.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 31 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-43-layer-5"
                data-x="630"
                data-y="468"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":900,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 9"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/0d1ed-Untitled-58.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 32 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-43-layer-23"
                data-x="970"
                data-y="227"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1500,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 10"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/43474-07.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 33 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-43-layer-24"
                data-x="724"
                data-y="212"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1200,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 11"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/4d9ed-08.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 34 -->
              <div
                class="tp-caption tp-resizeme rs-parallaxlevel-1"
                id="slide-43-layer-25"
                data-x="866"
                data-y="415"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":1800,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 12"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/95fe8-05.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 35 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-43-layer-26"
                data-x="1173"
                data-y="441"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":2100,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 13"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/af220-05.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 36 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-43-layer-27"
                data-x="684"
                data-y="260"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":2100,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 14"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/af220-05.png') }}"
                  alt=""
                  data-ww="auto"
                  data-hh="auto"
                  data-no-retina
                />
              </div>
              <!-- LAYER NR. 37 -->
              <div
                class="tp-caption tp-resizeme"
                id="slide-43-layer-28"
                data-x="953"
                data-y="170"
                data-width="['none','none','none','none']"
                data-height="['none','none','none','none']"
                data-type="image"
                data-responsive_offset="on"
                data-frames='[{"delay":2100,"speed":1000,"text_c":"transparent","bg_c":"transparent","use_text_c":false,"use_bg_c":false,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"use_text_c":false,"use_bg_c":false,"text_c":"transparent","bg_c":"transparent","frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                data-textAlign="['left','left','left','left']"
                data-paddingtop="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                style="z-index: 15"
              >
                <img
                  src="{{ asset('assets/assetLanding/revslider/assets/9f862-06.png') }}"
                  alt=""
                  data-ww="59px"
                  data-hh="39px"
                  data-no-retina
                />
              </div>
            </li>
          </ul>
          <div
            class="tp-bannertimer tp-bottom"
            style="visibility: hidden !important"
          ></div>
        </div>
      </div>
    </div>
    <!-- Banner END -->
    <!-- Main Content -->
    <div class="main-content">
      <!-- Choose From  -->
      <section class="iq-choose-info position-relative iq-rmt-40" id="sectionCurasCuranmor">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <img
                src="{{ asset('assets/assetLanding/images/others/34.png') }}"
                class="img-fluid wow fadeInLeft"
                alt=""
              />
            </div>
            <div class="col-lg-6 wow fadeInRight">
              <h2 class="iq-fw-8 mb-2 iq-mt-40">Apa Sih Curas dan Curanmor Itu ?</h2>
              <p class="iq-font-18 mb-3">
                Ternyata banyak yang belum paham apa itu Curas dan Curanmor. Yuk Kita Bahas
              </p>
              <ul class="iq-project-info">
                <li>
                  <div class="media service-info mt-0 mb-0">
                    <div class="iq-feature-shap">
                      <i class="ion-ios-cloud-download-outline"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h5 class="mt-0 mb-2 iq-fw-8">
                        <a href="">Curas ( Pencurian Dengan Kekerasan )</a>
                      </h5>
                      <p class="mb-0">
                        Pencurian dengan Kekerasan atau yang sering disebut Curas, merupakan salah satu tindak pidana pencurian yang dalam prakteknya melakukan kekerasan secara fisik maupun ancaman kepada korbannya. Salah satu contoh Curas yaitu Begal
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="media service-info mt-0 mb-0">
                    <div class="iq-feature-shap">
                      <i class="ion-ios-pie-outline"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h5 class="mt-0 mb-2 iq-fw-8">
                        <a href="">Curanmor ( Pencurian Kendaraan Bermotor )</a>
                      </h5>
                      <p class="mb-0">
                        Pencurian Kendaraan Bermotor atau yang sering disebut Curanmor, merupakan salah satu tindak pidana pencurian yang sasaran utamanya yaitu kendaraan bermotor, seperti Motor dan Mobil
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="scrollme">
          <img
            src="{{ asset('assets/assetLanding/images/others/32.png') }}"
            class="img-fluid iqwork-right animateme"
            data-when="exit"
            data-from="0.5"
            data-to="0"
            data-translatey="100"
            alt="image"
          />
        </div>
      </section>
      <!-- Choose From End -->
      <!--Solutions From  -->
      <section class="iq-solutions position-relative" id="sectionKmeans">
        <div class="container">
          <div class="row no-gutters flex-row-reverse">
            <div class="col-lg-6">
              <img src="{{ asset('assets/assetLanding/images/others/1.png') }}" class="img-fluid" alt="" />
            </div>
            <div class="col-lg-6 align-self-center">
              <h2 class="iq-fw-8 mb-2 iq-mt-40">
                Apa Sih K - Means Clustering Itu ?
              </h2>
              <p class="mb-3 mt-5">
                K - Means Clustering merupakan salah satu algortitma machine learning 
                yang digunakan untuk memetakan data berdasarkan kemiripan dari masing - masing data.
                Terus bedanya K - Means dengan algoritma clustering yang lain apa ? Pada awal iterasi K - Means menggunakan nilai titik pusat klasternya secara acak.
              </p>
              
            </div>
          </div>
        </div>
      </section>
      <!-- Solutions END -->
  
      <!-- Team section -->
      <section class="iq-bestteam main-bg position-relative pt-0" id="sectionOurTeam">
        <div class="container mt-5">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="section-title">
                <p class="mt-5 text-uppercase text-white iq-fw-3 iq-ls-3">
                  Meet the team
                </p>
                <h2 class="title text-white iq-fw-8">Our Team Dev</h2>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
              <div class="team-box">
                <div class="team-img text-center">
                  <img
                    src="{{ asset('assets/assetLanding/images/team/admin-daffa.jpeg') }}"
                    class="img-fluid rounded-circle"
                    alt="image"
                  />
                </div>
                <div class="team-detail">
                  <a class="team-plus" href="#"><i class="fas fa-plus"></i></a>
                  <div class="team-info">
                    <h6 class="mb-0 text-white">
                      <a href="">Daffa Fauzi Rahman</a>
                    </h6>
                    <span class="mb-0 text-white text-gray iq-fw-4"
                      >WEB DEVELOPER</span
                    >
                  </div>
                </div>
                <div class="team-hover">
                  <p>
                    Mahasiswa Politeknik Negeri Jember Program Studi D4 Teknik Informatika. Berperan sebagai Web Developer pada Web SIG Pemetaan Daerah Rawan Curas dan Curanmor
                  </p>
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="https://www.facebook.com/share/16Z8J2DEYz/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a target="_blank" href="https://www.linkedin.com/in/daffa-fauzi-rahman?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a target="_blank" href="https://www.instagram.com/daff_rahman11?igsh=MWd2dG9jZ2ZpYm9rdQ=="><i class="fab fa-instagram"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="team-box">
                <div class="team-img text-center">
                  <img
                    src="{{ asset('assets/assetLanding/images/team/bety.png') }}"
                    class="img-fluid rounded-circle"
                    alt="image"
                  />
                </div>
                <div class="team-detail">
                  <a class="team-plus" href="#"><i class="fas fa-plus"></i></a>
                  <div class="team-info">
                    <h6 class="mb-0 text-white">
                      <a href="">Bety Etikasari</a>
                    </h6>
                    <span class="mb-0 text-white text-gray iq-fw-4"
                      >PEMBIMBING</span
                    >
                  </div>
                </div>
                <div class="team-hover">
                  <p>
                    Dosen Politeknik Negeri Jember Program Studi D4 Teknik Informatika. Berperan sebagai Pengarah dan Pembimbing pada Web SIG Pemetaan Daerah Rawan Curas dan Curanmor
                  </p>
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-instagram"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="team-box">
                <div class="team-img text-center">
                  <img
                    src="{{ asset('assets/assetLanding/images/team/bitari.png') }}"
                    class="img-fluid rounded-circle"
                    alt="image"
                  />
                </div>
                <div class="team-detail">
                  <a class="team-plus" href="#"><i class="fas fa-plus"></i></a>
                  <div class="team-info">
                    <h6 class="mb-0 text-white">
                      <a href="">Dia Bitari Mei Yuana</a>
                    </h6>
                    <span class="mb-0 text-white text-gray iq-fw-4"
                      >KETUA PENGUJI</span
                    >
                  </div>
                </div>
                <div class="team-hover">
                  <p>
                    Dosen Politeknik Negeri Jember Program Studi D4 Teknik Informatika. Berperan sebagai Ketua Penguji pada Web SIG Pemetaan Daerah Rawan Curas dan Curanmor
                  </p>
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#sectionOurTeam"><i class="fab fa-instagram"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- Team END -->

      <!--MAP -->
      <section class="iq-pricing-table pt-0 iq-rmt-40" id="sectionMap">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="section-title mt-5">
                <p class="mb-0 text-uppercase iq-fw-5 iq-ls-2 mt-3">Hasil Pemetaan</p>
                <h2 class="title iq-fw-8">Pemetaan Kasus Curas dan Curanmor <br> di Kabupaten Probolinggo</h2>
              </div>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-sm-12">
              <ul class="nav nav-pills iq-mt-40" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="btn-curas"
                    data-toggle="pill"
                    href="#monthly"
                    role="tab"
                    aria-controls="monthly"
                    aria-selected="true"
                    >Curas</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="btn-curanmor"
                    data-toggle="pill"
                    href="#yearly"
                    role="tab"
                    aria-controls="yearly"
                    aria-selected="false"
                    >Curanmor</a
                  >
                </li>
              </ul>
              
              <div class="tab-content iq-mt-80" id="pills-tabContent">
                <div
                  class="tab-pane show active"
                  id="monthly"
                  role="tabpanel"
                  aria-labelledby="monthly-tab"
                  >
                  <div class="row pricing1 text-center">
                    <div class="col-xl-12 col-sm-12">
                      <div class="iq-pricing active white-bg">
                        <div id="map" style="width: 100%; height: 500px; position: relative;">
  
                          {{-- Pojok Kanan Atas --}}
                          <div class="map-legend top-right">
                            @foreach ($klasters as $klaster)
                              <div class="legend-item">
                                <span class="legend-color" style="background-color: {{ $klaster->warna }};"></span>
                                <span class="legend-label">Daerah {{ $klaster->nama_klaster }}</span>
                              </div>
                            @endforeach
                          </div>
                        
                          {{-- Pojok Kiri Atas --}}
                          <div class="map-legend top-left">
                            <div class="legend-item">
                              <span class="legend-label">Menggunakan Data POLRES Kab. Probolinggo</span>
                            </div>
                            <div class="legend-item" id="update-curas">
                              <span class="legend-label">Update Terakhir Data Curas : {{ $tanggalCuras }}</span>
                            </div>
                            <div class="legend-item" id="update-curanmor" style="display: none;">
                              <span class="legend-label">Update Terakhir Data Curanmor : {{ $tanggalCuranmor }}</span>
                            </div>
                            
                          </div>
                        
                        </div>
                        
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Pricing END -->
      
      <!-- BERITA -->
      {{-- <section class="iq-blogs position-relative pb-xl-0 iq-rmt-40">
        <div class="container">
          <div class="col-sm-12 text-center">
            <div class="section-title">
              <p class="mb-0 text-uppercase iq-fw-5 iq-ls-2">Berita Terbaru</p>
              <h2 class="title iq-fw-8">Kasus Curas dan Curanmor di Kab. Probolinggo</h2>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div
                class="owl-carousel"
                data-autoplay="true"
                data-loop="true"
                data-nav="false"
                data-dots="false"
                data-items="3"
                data-items-laptop="3"
                data-items-tab="1"
                data-items-mobile="1"
                data-items-mobile-sm="1"
              >
                <div class="item">
                  <div class="main-blog">
                    <div class="blog-img">
                      <img
                        src="{{ asset('assets/assetLanding/images/blog/02.png') }}"
                        class="img-fluid"
                        alt="image"
                      />
                    </div>
                    <div class="blog-detail">
                      <a
                        class="main-color iq-fw-8"
                        href=""
                        >Kasus Curas</a
                      >
                      <a href="">
                        <h5 class="mt-1 iq-fw-8">Pegawai Garmen Terbegal Saat Pulang di Maron</h5>
                      </a>
                      <p class="mb-0">
                        {{ str(' Seorang Pegawai Garmen Terbegal Saat Pulang di Maron')->limit(40, '...') }}
                      </p>
                      <div class="blog-info">
                        <a href=""
                          ><img
                            src="{{ asset('assets/assetLanding/images/blog/clients/01.png') }}"
                            class="img-fluid rounded-circle mr-3 user-img"
                            alt="image"
                          /><span class="iq-fw-8 font-c iq-font-18"
                            >Humas Polres Probolinggo</span
                          ></a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="main-blog">
                    <div class="blog-img">
                      <img
                        src="{{ asset('assets/assetLanding/images/blog/02.png') }}"
                        class="img-fluid"
                        alt="image"
                      />
                    </div>
                    <div class="blog-detail">
                      <a
                        class="main-color iq-fw-8"
                        href=""
                        >Kasus Curas</a
                      >
                      <a href="">
                        <h5 class="mt-1 iq-fw-8">Pegawai Garmen Terbegal Saat Pulang di Maron</h5>
                      </a>
                      <p class="mb-0">
                        {{ str(' Seorang Pegawai Garmen Terbegal Saat Pulang di Maron')->limit(40, '...') }}
                      </p>
                      <div class="blog-info">
                        <a href=""
                          ><img
                            src="{{ asset('assets/assetLanding/images/blog/clients/01.png') }}"
                            class="img-fluid rounded-circle mr-3 user-img"
                            alt="image"
                          /><span class="iq-fw-8 font-c iq-font-18"
                            >Humas Polres Probolinggo</span
                          ></a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="main-blog">
                    <div class="blog-img">
                      <img
                        src="{{ asset('assets/assetLanding/images/blog/02.png') }}"
                        class="img-fluid"
                        alt="image"
                      />
                    </div>
                    <div class="blog-detail">
                      <a
                        class="main-color iq-fw-8"
                        href=""
                        >Kasus Curas</a
                      >
                      <a href="">
                        <h5 class="mt-1 iq-fw-8">Pegawai Garmen Terbegal Saat Pulang di Maron</h5>
                      </a>
                      <p class="mb-0">
                        {{ str(' Seorang Pegawai Garmen Terbegal Saat Pulang di Maron')->limit(40, '...') }}
                      </p>
                      <div class="blog-info">
                        <a href=""
                          ><img
                            src="{{ asset('assets/assetLanding/images/blog/clients/01.png') }}"
                            class="img-fluid rounded-circle mr-3 user-img"
                            alt="image"
                          /><span class="iq-fw-8 font-c iq-font-18"
                            >Humas Polres Probolinggo</span
                          ></a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="main-blog">
                    <div class="blog-img">
                      <img
                        src="{{ asset('assets/assetLanding/images/blog/02.png') }}"
                        class="img-fluid"
                        alt="image"
                      />
                    </div>
                    <div class="blog-detail">
                      <a
                        class="main-color iq-fw-8"
                        href=""
                        >Kasus Curas</a
                      >
                      <a href="">
                        <h5 class="mt-1 iq-fw-8">Pegawai Garmen Terbegal Saat Pulang di Maron</h5>
                      </a>
                      <p class="mb-0">
                        {{ str(' Seorang Pegawai Garmen Terbegal Saat Pulang di Maron')->limit(40, '...') }}
                      </p>
                      <div class="blog-info">
                        <a href=""
                          ><img
                            src="{{ asset('assets/assetLanding/images/blog/clients/01.png') }}"
                            class="img-fluid rounded-circle mr-3 user-img"
                            alt="image"
                          /><span class="iq-fw-8 font-c iq-font-18"
                            >Humas Polres Probolinggo</span
                          ></a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="main-blog">
                    <div class="blog-img">
                      <img
                        src="{{ asset('assets/assetLanding/images/blog/02.png') }}"
                        class="img-fluid"
                        alt="image"
                      />
                    </div>
                    <div class="blog-detail">
                      <a
                        class="main-color iq-fw-8"
                        href=""
                        >Kasus Curas</a
                      >
                      <a href="">
                        <h5 class="mt-1 iq-fw-8">Pegawai Garmen Terbegal Saat Pulang di Maron</h5>
                      </a>
                      <p class="mb-0">
                        {{ str(' Seorang Pegawai Garmen Terbegal Saat Pulang di Maron')->limit(40, '...') }}
                      </p>
                      <div class="blog-info">
                        <a href=""
                          ><img
                            src="{{ asset('assets/assetLanding/images/blog/clients/01.png') }}"
                            class="img-fluid rounded-circle mr-3 user-img"
                            alt="image"
                          /><span class="iq-fw-8 font-c iq-font-18"
                            >Humas Polres Probolinggo</span
                          ></a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> --}}
      <!-- BERITA END -->
    </div>
    <footer class="footer-two">
      <img src="{{ asset('assets/assetLanding/images/footer/1.jpg') }}" class="img-fluid footer-one" alt="image" />
      <div class="footer-top main-bg">
        <div class="container">
          <div class="row no-gutters">
            <div class="col-lg-4 col-md-5">
              <div class="iq-footer-logo">
                <a href="/"
                  >
                  <img
                   src="{{ asset('assets/assetLanding/images/logo.png') }}"
                    class="img-fluid mb-2"
                    alt="image"
                    
                  />
                </a>
                <p class="footer-info text-white mt-0">
                  Cek Tingkat Curas dan Curanmor di daerahmu
                </p>
                <a class="slide-button button" href="">
                  <div class="first">
                    Hubungi Kami<i class="fas fa-angle-right"></i>
                  </div>
                  <div class="second">
                    Hubungi Kami<i class="fas fa-angle-right"></i>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-lg-5 col-md-7">
              <h5 class="text-white">Ikuti Informasi Terbaru Kami</h5>
              <form class="position-relative subscribe-form">
                <div class="form-group mb-0">
                  <input
                    type="email"
                    class="form-control position-relative subscription-email"
                    placeholder="Masukkan Email"
                  />
                </div>
                <a href="#" class="button bt-subscribe subscription-button"
                  ><i class="fas fa-angle-right"></i
                ></a>
              </form>
              <div class="social-media d-inline-block mb-4">
                <ul class="social">
                  <li>
                    <a href="#" class="text-uppercase"
                      ><i class="fab fa-facebook-f iq-fw-6 pr-3"></i>facebook</a
                    >
                  </li>
                  <li>
                    <a href="#" class="text-uppercase"
                      ><i class="fab fa-twitter iq-fw-6 pr-3"></i>twitter</a
                    >
                  </li>
                  <li>
                    <a href="https://www.linkedin.com/in/daffa-fauzi-rahman?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="blank" class="text-uppercase"
                      ><i class="fab fa-linkedin iq-fw-6 pr-3"></i>linkedin</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-12">
              <div class="footer-link">
                <h5 class="text-white">Navigasi </h5>
                <ul class="list-inline">
                  <li class="list-item">
                    <a href="#home">Home</a>
                  </li>
                  <li class="list-item"><a href="#sectionCurasCuranmor">Curas</a></li>
                  <li class="list-item"><a href="#sectionKmeans">Clustering</a></li>
                  <li class="list-item"><a href="#sectionMap">Map</a></li>
                  <li class="list-item"><a href="#sectionOurTeam">Our Team</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="footer-copyright text-center iq-fw-3">
                Develop By : <a target="blank" href="https://www.linkedin.com/in/daffa-fauzi-rahman?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Daffa Rahman</a> | Designed By : <a target="blank" href="https://markethon.co/" >Markethon</a> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom-wave wave-animation">
        <div class="main-wave waveone">
          <div class="wave-effect wave-top"></div>
        </div>
        <div class="main-wave wavetwo">
          <div class="wave-effect wave-middle"></div>
        </div>
        <div class="main-wave wavethree">
          <div class="wave-effect wave-bottom"></div>
        </div>
      </div>
      <!-- back-to-top -->
      <div id="back-to-top">
        <a class="top" id="top" href="#top"
          ><i class="ion-ios-arrow-thin-up"></i
        ></a>
      </div>
      <!-- back-to-top End -->
    </footer>
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
    <!-- REVOLUTION JS FILES -->
    <script src="{{ asset('assets/assetLanding/revslider/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/jquery.themepunch.revolution.min.js') }}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('assets/assetLanding/revslider/js/extensions/revolution.extension.video.min.js') }}"></script>
    <!-- Retina JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/retina.min.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/assetLanding/js/custom.js') }}"></script>
    {{-- Script Untuk Progress Circle Bar (Menampilkan Jumlah Kasus) --}}
    <script>
      function animatePercentage(id, end, duration) {
        let start = 0;
        let range = end - start;
        let current = start;
        let increment = end > start ? 1 : -1;
        let stepTime = Math.abs(Math.floor(duration / range));
        const element = document.getElementById(id);
  
        const timer = setInterval(function () {
          current += increment;
          element.textContent = current;
          if (current === end) {
            clearInterval(timer);
          }
        }, stepTime);
      }
  
      // Jalankan animasi untuk masing-masing circle
      document.querySelectorAll('.circle-inner').forEach((circle, index) => {
        const target = parseInt(circle.getAttribute('data-percent'));
        animatePercentage(`percentage${index + 1}`, target, 5000);
      });
    </script>
  
    
    

    {{-- Script Bawaan --}}
    <script>
      var revapi12,
        tpj = jQuery;
      tpj(document).ready(function () {
        if (tpj("#rev_slider_12_1").revolution == undefined) {
          revslider_showDoubleJqueryError("#rev_slider_12_1");
        } else {
          revapi12 = tpj("#rev_slider_12_1")
            .show()
            .revolution({
              sliderType: "standard",
              jsFileLocation:
                "//localhost/revslider-standalone/revslider-standalone/revslider/public/revslider/assets/js",
              sliderLayout: "fullwidth",
              dottedOverlay: "none",
              delay: 9000,
              navigation: {
                onHoverStop: "off",
              },
              visibilityLevels: [1240, 1024, 778, 480],
              gridwidth: 1400,
              gridheight: 868,
              lazyType: "none",
              parallax: {
                type: "mouse",
                origo: "enterpoint",
                speed: 400,
                levels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 55],
              },
              shadow: 0,
              spinner: "spinner0",
              stopLoop: "off",
              stopAfterLoops: -1,
              stopAtSlide: -1,
              shuffle: "off",
              autoHeight: "off",
              disableProgressBar: "on",
              hideThumbsOnMobile: "off",
              hideSliderAtLimit: 0,
              hideCaptionAtLimit: 0,
              hideAllCaptionAtLilmit: 0,
              debugMode: false,
              fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false,
              },
            });
        }
      }); /*ready*/
    </script>

    <script>
      let map;
      let geoLayer;
      let curasData = {};
      let apiUrl = "{{ url('/api/map/curas') }}"; // default

      function fetchAndLoadMap(url, titleText) {
          fetch(url)
              .then(res => res.json())
              .then(data => {
                  // reset data
                  curasData = {};
                  data.forEach(item => {
                      curasData[item.kecamatan.toLowerCase().trim()] = item;
                  });

                  // hapus layer lama
                  if (geoLayer) {
                      geoLayer.remove();
                  }

                  // buat layer baru
                  geoLayer = new L.GeoJSON.AJAX(["{{ asset('assets/map/gisProbolinggo.geojson') }}"], {
                      style: styleFeature,
                      onEachFeature: popUp
                  });

                  geoLayer.addTo(map);

                  // ubah judul jika ada
                  const mapTitle = document.querySelector('.card-title');
                  if (mapTitle) mapTitle.textContent = titleText;
              });
      }

      function getColor(warna) {
          return warna || '#cccccc';
      }

      function styleFeature(feature) {
          let namaKecamatan = feature.properties.WADMKC.toLowerCase().trim();
          let data = curasData[namaKecamatan];
          return {
              fillColor: data ? getColor(data.warna) : '#cccccc',
              weight: 1,
              opacity: 1,
              color: 'white',
              fillOpacity: 0.7
          };
      }

      function popUp(feature, layer) {
          let namaKecamatan = feature.properties.WADMKC.toLowerCase().trim();
          let data = curasData[namaKecamatan];

          let content = `<strong>Kecamatan ${feature.properties.WADMKC}</strong><br/><br/>`;
          if (data) {
              if ('jumlah_curas' in data) {
                  content += `Jumlah Curas : ${data.jumlah_curas}<br/>Kategori : ${data.klaster}`;
              } else if ('jumlah_curanmor' in data) {
                  content += `Jumlah Curanmor : ${data.jumlah_curanmor}<br/>Kategori : ${data.klaster}`;
              }
          } else {
              content += `Data tidak tersedia`;
          }

          layer.bindPopup(content);
      }

      function loadInitialMap() {
          map = L.map('map').setView([-7.843271790154591, 113.2990930356143], 10);
          L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
              maxZoom: 19,
              attribution: '&copy; OpenStreetMap'
          }).addTo(map);

          // Load default
          fetchAndLoadMap(apiUrl, 'Pemetaan Curas Kab Probolinggo');
      }

      document.addEventListener('DOMContentLoaded', () => {
          loadInitialMap();

          document.getElementById('btn-curas').addEventListener('click', (e) => {
              e.preventDefault();
              fetchAndLoadMap("{{ url('/api/map/curas') }}", "Pemetaan Curas Kab Probolinggo");
          });

          document.getElementById('btn-curanmor').addEventListener('click', (e) => {
              e.preventDefault();
              fetchAndLoadMap("{{ url('/api/map/curanmor') }}", "Pemetaan Curanmor Kab Probolinggo");
          });
      });
    </script>

    <script>
      document.getElementById('btn-curas').addEventListener('click', (e) => {
          e.preventDefault();
          fetchAndLoadMap("{{ url('/api/map/curas') }}", "Pemetaan Curas Kab Probolinggo");

          // Tampilkan info update curas, sembunyikan curanmor
          document.getElementById('update-curas').style.display = 'block';
          document.getElementById('update-curanmor').style.display = 'none';
      });

      document.getElementById('btn-curanmor').addEventListener('click', (e) => {
          e.preventDefault();
          fetchAndLoadMap("{{ url('/api/map/curanmor') }}", "Pemetaan Curanmor Kab Probolinggo");

          // Tampilkan info update curanmor, sembunyikan curas
          document.getElementById('update-curas').style.display = 'none';
          document.getElementById('update-curanmor').style.display = 'block';
      });
    </script>


  </body>
</html>
