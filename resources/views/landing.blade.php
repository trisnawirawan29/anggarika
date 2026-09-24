<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="themepresss">

    <!-- Page Title -->
    <title>{{ $landing['landing_page_title'] }}</title>

    <!-- Icon fonts -->
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Plugins for this template -->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="home">

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- prealoader area start -->
        <div id="preloader">
            <div class="spiner"></div>
        </div>
        <!-- prealoader area end -->


        <!-- Start header -->
        <header class="site-header header-style-1">
            <nav class="navigation navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h1 class="site-logo">
                            <a class="navbar-brand" href="{{ route('landing') }}">{{ $landing['landing_page_title'] }}</a>
                        </h1>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navbar-right navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
                            <li class="current-menu-item"><a href="#home">Home</a></li>
                            @if ($landing['landing_section_couple'])
                            <li><a href="#couple">Couple</a></li>
                            @endif
                            @if ($landing['landing_section_story'])
                            <li><a href="#story">Story</a></li>
                            @endif
                            @if ($landing['landing_section_event'])
                            <li><a href="#event">Events</a></li>
                            @endif
                            @if ($landing['landing_section_people'])
                            <li><a href="#people">People</a></li>
                            @endif
                            @if ($landing['landing_section_gallery'])
                            <li><a href="#gallery">Gallery</a></li>
                            @endif
                            @if ($landing['landing_section_rsvp'])
                            <li><a href="#rsvp">RSVP</a></li>
                            @endif
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0);">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-width-sidebar.html">Blog With Sidebar</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#Level3">Blog Details</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-single.html">Blog Details</a></li>
                                            <li><a href="blog-single-sidebar.html">Blog Details Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- end of nav-collapse -->
                    <div class="bottom-border"></div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->         
        @if ($landing['landing_section_hero'])
        <!-- start of hero -->
        <section class="hero-slider hero-style-3">
            <div class="slide-wrapper">
                <div id="spirit-header" class="spirit-header">
                    <canvas id="spirit-canvas"></canvas>
                </div>
                <div class="slide">
                <div class="slide-inner slide-inner-3" style="background-image: url('{{ $landing['landing_hero_background'] }}');">
                        <div class="container">
                            <div class="slide-content">
                                <div data-swiper-parallax="200" class="slide-subtitle">
                                    <h4>{{ $landing['landing_hero_subtitle'] }}</h4>
                                </div>
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>{{ $landing['landing_hero_title'] }}</h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text">
                                    <p>{{ $landing['landing_hero_date'] }}</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div> <!-- end slide-inner --> 
                </div> <!-- end swiper-slide -->
            </div>
            <!-- end swiper-wrapper -->
        </section>
        <!-- end of hero slider -->       
        @endif

        @if ($landing['landing_section_couple'])
        <style>
            .couple-area .couple-socials {
                display: block !important;
                width: 100%;
                margin-top: 24px;
            }

            .couple-area .couple-social-list {
                all: unset;
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                justify-content: center;
                gap: 10px;
                width: 100%;
                max-width: 340px;
                margin: 0 auto;
                padding: 0;
                list-style: none;
            }

            .couple-area .couple-social-item {
                all: unset;
                display: block;
                min-width: 0;
                margin: 0 !important;
                padding: 0;
                list-style: none;
            }

            .couple-area .couple-social-link {
                all: unset;
                position: relative;
                isolation: isolate;
                overflow: hidden;
                display: flex !important;
                align-items: center;
                gap: 8px;
                width: 100% !important;
                min-height: 42px;
                box-sizing: border-box;
                padding: 6px 10px;
                border: 0 !important;
                border-radius: 14px;
                background: linear-gradient(135deg, #85aaba, #557f91);
                box-shadow: 0 8px 18px rgba(56, 92, 105, .2);
                color: #fff !important;
                cursor: pointer;
                text-decoration: none !important;
                transform: none !important;
                clip-path: none !important;
                transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
            }

            .couple-area .couple-social-link::before {
                position: absolute;
                top: 0;
                bottom: 0;
                left: -70%;
                z-index: -1;
                width: 45%;
                content: '';
                background: rgba(255, 255, 255, .25);
                transform: skewX(-20deg);
                transition: left .5s ease;
            }

            .couple-area .couple-social-link i {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex: 0 0 28px;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .2);
                color: #fff;
                font-size: 14px;
                line-height: 1;
                transform: none !important;
                clip-path: none !important;
                transition: transform .25s ease, background .25s ease;
            }

            .couple-area .couple-social-link:hover {
                background: linear-gradient(135deg, #6f9bad, #3f697c);
                box-shadow: 0 12px 24px rgba(56, 92, 105, .3);
                transform: translateY(-4px) !important;
            }

            .couple-area .couple-social-link:hover::before {
                left: 125%;
            }

            .couple-area .couple-social-link:hover i {
                background: rgba(255, 255, 255, .35);
                transform: rotate(12deg) scale(1.08);
            }

            .couple-area .couple-social-username {
                display: block !important;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                min-width: 0;
                max-width: 100%;
                color: #fff !important;
                font-size: 11px;
                font-weight: 700;
                line-height: 1.2;
                opacity: 1 !important;
            }

            @media (max-width: 575px) {
                .couple-area .couple-social-list {
                    max-width: 300px;
                    gap: 8px;
                }

                .couple-area .couple-social-link {
                    min-height: 40px;
                    padding: 5px 7px;
                    gap: 6px;
                }

                .couple-area .couple-social-link i {
                    flex-basis: 25px;
                    width: 25px;
                    height: 25px;
                    font-size: 12px;
                }

                .couple-area .couple-social-username {
                    font-size: 10px;
                }
            }
        </style>
        <!-- couple-area start -->
        <div id="couple" class="couple-area section-padding">
            <div class="container">
                <div class="col-l2">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_couple_title'] }}</h2>
                    </div>
                </div>
                <div class="couple-wrap">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 grid couple-single">
                            <div class="couple-wrap">
                                <div class="couple-img">
                                    <img src="{{ $landing['landing_groom_photo'] }}" alt="">
                                </div>
                                <div class="couple-text">
                                    <div class="couple-content">
                                        <h4 style="font-size: {{ (int) $landing['landing_groom_name_font_size'] }}px;{{ $landing['landing_groom_name_font_family'] !== 'inherit' ? ' font-family: '.$landing['landing_groom_name_font_family'].';' : '' }}">{{ $landing['landing_groom_name'] }}</h4>
                                        <p style="white-space: pre-line;">{{ $landing['landing_groom_bio'] }}</p>
                                    </div>
                                    <div class="couple-socials">
                                        <ul class="couple-social-list">
                                            @foreach (['facebook', 'twitter', 'instagram', 'linkedin'] as $network)
                                                @if ($landing['landing_groom_'.$network.'_enabled'])
                                                <li class="couple-social-item"><a class="couple-social-link" href="{{ $landing['landing_groom_'.$network.'_url'] }}" target="_blank" rel="noopener"><i class="fa fa-{{ $network }}" aria-hidden="true"></i><span class="couple-social-username">{{ $landing['landing_groom_'.$network.'_username'] ?: '@'.$network }}</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 couple-single md-0 grid">
                            <div class="couple-wrap">
                                <div class="couple-img couple-img-2">
                                    <img src="{{ $landing['landing_bride_photo'] }}" alt="">
                                </div>
                                <div class="couple-text">
                                    <div class="couple-content">
                                        <h4 style="font-size: {{ (int) $landing['landing_bride_name_font_size'] }}px;{{ $landing['landing_bride_name_font_family'] !== 'inherit' ? ' font-family: '.$landing['landing_bride_name_font_family'].';' : '' }}">{{ $landing['landing_bride_name'] }}</h4>
                                        <p style="white-space: pre-line;">{{ $landing['landing_bride_bio'] }}</p>
                                    </div>
                                    <div class="couple-socials">
                                        <ul class="couple-social-list">
                                            @foreach (['facebook', 'twitter', 'instagram', 'linkedin'] as $network)
                                                @if ($landing['landing_bride_'.$network.'_enabled'])
                                                <li class="couple-social-item"><a class="couple-social-link" href="{{ $landing['landing_bride_'.$network.'_url'] }}" target="_blank" rel="noopener"><i class="fa fa-{{ $network }}" aria-hidden="true"></i><span class="couple-social-username">{{ $landing['landing_bride_'.$network.'_username'] ?: '@'.$network }}</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- couple-area end -->
        @endif
        @if ($landing['landing_section_countdown'])
        <!-- start count-down-section -->
        <div class="count-down-area count-down-area-sub" style="background-image: url('{{ $landing['landing_countdown_background'] }}');">
            <section class="count-down-section section-padding parallax" data-speed="7">
                <div class="container">
                    <div class="col-12 text-center">
                        <h2 class="big"><span>We Are Waiting For.....</span> The Big Day</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="count-down-clock">
                                <div id="clock" data-target="{{ date('Y/m/d H:i:s', strtotime($landing['landing_countdown_date'])) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </section>
        </div>
        <!-- end count-down-section --> 
        @endif
        @if ($landing['landing_section_story'])
        <!-- start story-section -->
        <section class="story-section section-padding" id="story">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="section-title">
                            <h2>{{ $landing['landing_story_title'] }}</h2>
                        </div>
                    </div>
                </div> <!-- end section-title -->

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="story-timeline">
                            @if ($landing['landing_story_1_enabled'])
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="story-text right-align-text">
                                        <h3>{{ $landing['landing_story_1_title'] }}</h3>
                                        <span class="date">{{ $landing['landing_story_1_date'] }}</span>
                                        <p>{{ $landing['landing_story_1_text'] }}</p>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="img-holder">
                                        <img src="{{ $landing['landing_story_photo_1'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($landing['landing_story_2_enabled'])
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="img-holder right-align-text story-slider">
                                        <img src="{{ $landing['landing_story_photo_2'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                                <div class="col col-md-6 text-holder">
                                    <span class="heart">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </span>
                                    <div class="story-text">
                                        <h3>{{ $landing['landing_story_2_title'] }}</h3>
                                        <span class="date">{{ $landing['landing_story_2_date'] }}</span>
                                        <p>{{ $landing['landing_story_2_text'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($landing['landing_story_3_enabled'])
                            <div class="row">
                                <div class="col col-md-6 text-holder right-heart">
                                    <span class="heart">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </span>
                                    <div class="story-text right-align-text">
                                        <h3>{{ $landing['landing_story_3_title'] }}</h3>
                                        <span class="date">{{ $landing['landing_story_3_date'] }}</span>
                                        <p>{{ $landing['landing_story_3_text'] }}</p>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="img-holder right-align-text story-slider">
                                        <img src="{{ $landing['landing_story_photo_3'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($landing['landing_story_4_enabled'])
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="img-holder video-holder">
                                        <img src="{{ $landing['landing_story_photo_4'] }}" alt class="img img-responsive">
                                        <div class="video-btn">
                                            <ul>
                                                <li><a href="https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1" class="video-btn" data-type="iframe">
                                                <i class="fi flaticon-play-button"></i>
                                                </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-6 text-holder">
                                    <span class="heart">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </span>
                                    <div class="story-text">
                                        <h3>{{ $landing['landing_story_4_title'] }}</h3>
                                        <span class="date">{{ $landing['landing_story_4_date'] }}</span>
                                        <p>{{ $landing['landing_story_4_text'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end story-section -->
        @endif
        @if ($landing['landing_section_cta'])
        <!-- cta area start-->
        <div class="cta-area" style="background-image: url('{{ $landing['landing_cta_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cta-content">
                            <h2>{{ $landing['landing_cta_title'] }}</h2>
                            <p style="white-space: pre-line;">{{ $landing['landing_cta_text'] }}</p>
                            @if ($landing['landing_cta_rsvp_enabled'])
                            <div class="btn btn-3"><a href="{{ $landing['landing_cta_rsvp_url'] }}" class="go-rsvp-area">{{ $landing['landing_cta_rsvp_label'] }}</a></div>
                            @endif
                            @if ($landing['landing_cta_location_enabled'])
                            <div class="btn btn-2"><a class="popup-gmaps" href="{{ $landing['landing_cta_location_url'] }}">{{ $landing['landing_cta_location_label'] }}</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cta area end-->         
        @endif
        @if ($landing['landing_section_event'])
        <!-- event-area -->
        <div id="event" class="event-section">
            <div class="container">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_event_title'] }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tabs-site-button">
                            <div class="event-tabs">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3 col-sm-11 col-sm-offset-1 col-xs-10 col-xs-offset-2">
                                        <ul class="nav nav-tabs">
                                            <li class="event-content"><a data-toggle="tab" href="#turbo">Ceremony</a></li>
                                            <li class="event-content"><a data-toggle="tab" href="#tyre">Party</a></li>
                                            <li class="event-content"><a data-toggle="tab" href="#car-1">Dinner</a></li>
                                            <li class="event-content"><a data-toggle="tab" href="#repair">Reception</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="tab-content">
                                        <div id="turbo" class="tab-pane active">
                                             <div class="event-wrap">
                                                <div class="row">
                                                    <div class="col-md-5 col-12">
                                                        <div class="event-img">
                                                            <img src="{{ $landing['landing_event_photo_1'] }}" alt>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-12">
                                                        <div class="event-text">
                                                            <h3>Wedding Ceremony</h3>
                                                            <span>Sunday, 25 July 18, 9.00 AM-5.00 PM</span>
                                                            <span>256 Apay Road,Califonia Bong, London</span>
                                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal </p>
                                                            <div class="btn"><a class="popup-gmaps" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881">Location</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tyre" class="tab-pane">
                                            <div class="row">
                                                 <div class="event-wrap">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="event-text event-text-2">
                                                                <h3>Wedding Party</h3>
                                                                <span>Sunday, 25 July 18, 9.00 AM-5.00 PM</span>
                                                                <span>256 Apay Road,Califonia Bong, London</span>
                                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal </p>
                                                                <div class="btn"><a class="popup-gmaps" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881">Location</a></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="event-img">
                                                                <img src="{{ $landing['landing_event_photo_2'] }}" alt>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div id="car-1" class="tab-pane">
                                            <div class="row">
                                                 <div class="event-wrap">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="event-img">
                                                                <img src="{{ $landing['landing_event_photo_3'] }}" alt>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="event-text">
                                                                <h3>Wedding Dinner</h3>
                                                                <span>Sunday, 25 July 18, 9.00 AM-5.00 PM</span>
                                                                <span>256 Apay Road,Califonia Bong, London</span>
                                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal </p>
                                                                <div class="btn"><a class="popup-gmaps" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881">Location</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div id="repair" class="tab-pane">
                                            <div class="row">
                                                 <div class="event-wrap">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="event-text event-text-2">
                                                                <h3>Reception Party</h3>
                                                                <span>Sunday, 25 July 18, 9.00 AM-5.00 PM</span>
                                                                <span>256 Apay Road,Califonia Bong, London</span>
                                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal </p>
                                                                <div class="btn"><a class="popup-gmaps" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881">Location</a></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="event-img">
                                                                <img src="{{ $landing['landing_event_photo_4'] }}" alt>
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
                </div>
            </div>
        </div>
        <!-- event-area end -->
        @endif
        @if ($landing['landing_section_people'])
        <!-- groomsmen-bridesmaid-area start -->
        <div id="people" class="groomsmen-bridesmaid-area pt--150 pb--70">
            <div class="container">
                <div class="col-l2">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_people_title'] }}</h2>
                    </div>
                </div>
                <div class="groomsmen-bridesmaid-area-menu">
                    <div class="Groomsman-wrap">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/1.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Lily Jameson</h3>
                                        <span>Sister</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap groomsmen-bridesmaid-wrap-2">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/2.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Lily Taylor</h3>
                                        <span>Best Friend</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/3.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Ema Aliana</h3>
                                        <span>Friend</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap groomsmen-bridesmaid-wrap-2">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/4.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Joey Famira</h3>
                                        <span>Friend</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap groomsmen-bridesmaid-wrap-2">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/5.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Criys stone</h3>
                                        <span>Made Of Honor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/6.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Watson Lyn</h3>
                                        <span>best-friend</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap groomsmen-bridesmaid-wrap-2">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/7.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>Chris Fletcher</h3>
                                        <span>Friend</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 grid">
                                <div class="groomsmen-bridesmaid-wrap mb-0">
                                    <div class="groomsmen-bridesmaid-img">
                                        <img src="{{ asset('assets/images/groomsmen-bridesmaid/8.jpg') }}" alt="">
                                        <div class="social-list">
                                            <ul class="d-flex">
                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                                <li><a href="#"><span class="ti-linkedin"></span></a></li>
                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="groomsmen-bridesmaid-content">
                                        <h3>John Clyne</h3>
                                        <span>Friend</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- groomsmen-bridesmaid-area start -->
        @endif
        @if ($landing['landing_section_cta_gallery'])
        <div class="cta-area" style="background-image: url('{{ $landing['landing_cta_gallery_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cta-content">
                            <h2>{{ $landing['landing_cta_gallery_title'] }}</h2>
                            <p style="white-space: pre-line;">{{ $landing['landing_cta_gallery_text'] }}</p>
                            @if ($landing['landing_cta_gallery_rsvp_enabled'])
                            <div class="btn btn-3"><a href="{{ $landing['landing_cta_gallery_rsvp_url'] }}" class="go-rsvp-area">{{ $landing['landing_cta_gallery_rsvp_label'] }}</a></div>
                            @endif
                            @if ($landing['landing_cta_gallery_location_enabled'])
                            <div class="btn btn-2"><a class="popup-gmaps" href="{{ $landing['landing_cta_gallery_location_url'] }}">{{ $landing['landing_cta_gallery_location_label'] }}</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if ($landing['landing_section_gallery'])
        <!--Start project area-->  
        <section id="gallery" class="gallery-section section-padding">
            <div class="container">
                <div class="col-l2">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_gallery_title'] }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12 sortable-gallery">
                        <div class="gallery-filters">
                            <ul>
                                <li><a data-filter="*" href="#" class="current">All</a></li>
                                <li><a data-filter=".Pre-Wedding" href="#">Pre Wedding</a></li>
                                <li><a data-filter=".EnagagEment" href="#">EnagagEment</a></li>
                                <li><a data-filter=".PartIes" href="#">Parties</a></li>         
                            </ul>
                        </div>
                        <div class="gallery-container gallery-fancybox masonry-gallery">
                            <div class="grid EnagagEment PartIes">
                                <a href="{{ $landing['landing_gallery_photo_1'] }}" class="fancybox" data-fancybox-group="gall-1">
                                    <img src="{{ $landing['landing_gallery_photo_1'] }}" alt class="img img-responsive">
                                    <div class="icon">
                                        <i class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="grid Pre-Wedding EnagagEment PartIes">
                                <a href="{{ $landing['landing_gallery_photo_2'] }}" class="fancybox" data-fancybox-group="gall-1">
                                    <img src="{{ $landing['landing_gallery_photo_2'] }}" alt class="img img-responsive">
                                    <div class="icon">
                                        <i class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="grid EnagagEment">
                                <a href="{{ $landing['landing_gallery_photo_3'] }}" class="fancybox" data-fancybox-group="gall-1">
                                    <img src="{{ $landing['landing_gallery_photo_3'] }}" alt class="img img-responsive">
                                    <div class="icon">
                                        <i class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="grid Pre-Wedding PartIes">
                                <a href="{{ $landing['landing_gallery_photo_4'] }}" class="fancybox" data-fancybox-group="gall-1">
                                    <img src="{{ $landing['landing_gallery_photo_4'] }}" alt class="img img-responsive">
                                    <div class="icon">
                                        <i class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="grid EnagagEment">
                                <a href="{{ $landing['landing_gallery_photo_5'] }}" class="fancybox" data-fancybox-group="gall-1">
                                    <img src="{{ $landing['landing_gallery_photo_5'] }}" alt class="img img-responsive">
                                    <div class="icon">
                                        <i class="ti-plus"></i>
                                    </div>
                                </a>
                                
                            </div>
                            <div class="grid Pre-Wedding EnagagEment PartIes">
                                <img src="{{ $landing['landing_gallery_photo_6'] }}" alt class="img img-responsive">
                                <div class="icon">
                                    <div class="video-btn">
                                        <ul>
                                            <li><a href="https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1" class="video-btn" data-type="iframe">
                                            <i class="fi flaticon-play-button"></i>
                                            </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </section>
        <!--End project area--> 
        @endif

        @if ($landing['landing_section_rsvp'])
        <!-- rsvp-area strat -->
        <div id="rsvp" class="rsvp-area go-rsvp-area" style="background-image: url('{{ $landing['landing_rsvp_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="rsvp-wrap">
                            <div class="col-12">
                                <div class="section-title section-title-2 text-center">
                                    <h2>{{ $landing['landing_rsvp_title'] }}</h2>
                                </div>
                            </div>
                            <div class="contact-form form-style">
                                <form id="rsvp-form" action="mail.php" class="validate-rsvp-form" method="post">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <input type="text" placeholder="Your Name*" id="fname" name="name">
                                        </div>
                                        <div class="col-12  col-sm-6">
                                            <input type="text" placeholder="Your Email*" id="email" name="email">
                                        </div>
                                        <div class="col col-sm-6">
                                            <select class="form-control" name="rsvp">
                                                <option disabled selected>Number Of rsvp*</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col col-sm-6">
                                            <select class="form-control" name="events">
                                                <option disabled selected>I Am Attending*</option>
                                                <option>Al events</option>
                                                <option>Wedding ceremony</option>
                                                <option>Reception party</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <textarea class="contact-textarea" placeholder="Message" name="notes"></textarea>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button id="submit" class="submit">Send Invitation</button>
                                            <span id="loader"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></span>
                                        </div>
                                         <div class="col col-md-12 success-error-message">
                                            <div id="success">Thank you</div>
                                            <div id="error"> Error occurred while sending email. Please try again later. </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rsvp-area end -->
        @endif
        @if ($landing['landing_section_gta'])
        <!-- getting-area start -->
        <div class="gta-area">
            <div class="container">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Getting There</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                        <div class="row">
                            <div class="heading col-md-12 col-sm-6">
                                <h3>Transportation</h3>
                                <div class="gta-content">
                                    <p>industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s</p>
                                </div>
                                <div class="gta-img">
                                    <img src="{{ asset('assets/images/gta/img-2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="heading heading-2 col-md-12 col-sm-6">
                                <h3>Accommodations</h3>
                                <div class="gta-content">
                                    <p>industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s</p>
                                </div>
                                <div class="gta-img">
                                    <img src="{{ asset('assets/images/gta/img-1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- getting-area end -->
        @endif
        @if ($landing['landing_section_gift'])
        <!-- Gift Registration start -->
        <div class="Gift-area pt--100 pb--30">
            <div class="container">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Gift Registration</h2>
                    </div>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised.</p>
                </div>
                <div class="gift-item">
                    <div class="Gift-carousel owl-carousel">
                        <img src="{{ asset('assets/images/gift/img-1.jpg') }}" alt="clinet">
                        <img src="{{ asset('assets/images/gift/img-2.jpg') }}" alt="clinet">
                        <img src="{{ asset('assets/images/gift/img-3.jpg') }}" alt="clinet">
                        <img src="{{ asset('assets/images/gift/img-4.jpg') }}" alt="clinet">
                    </div>
                </div>
            </div>
        </div>
        <!-- Gift Registration end -->
        @endif

        @if ($landing['landing_section_footer'])
        <!-- start site-footer -->
        <footer class="site-footer" style="background-image: url('{{ $landing['landing_footer_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="text">
                        <h2>{{ $landing['landing_footer_title'] }}</h2>
                        <p>Thank you</p>
                    </div>

                    <div class="back-to-top">
                        <a href="#" class="back-to-top-btn"><span><i class="ti-arrow-up"></i></span></a>
                    </div>
                </div>
            </div> <!-- end container -->
        </footer>
        <!-- end site-footer -->
        @endif
        @if ($landing['landing_section_music'] && $landing['landing_music_file'] !== '')
        <!-- strat music-box -->
        <div class="music-box">
            <button class="music-box-toggle-btn">
                <i class="ti-music-alt"></i>
            </button>
            <div class="music-holder">
                <audio id="landing-music" controls autoplay loop preload="auto" src="{{ $landing['landing_music_file'] }}"></audio>
            </div>
            <script>
                (() => {
                    const music = document.getElementById('landing-music');
                    if (!music) {
                        return;
                    }

                    music.play().catch(() => {
                        document.addEventListener('click', () => music.play().catch(() => {}), {once: true});
                    });
                })();
            </script>
        </div>
        <!-- end music box -->
        @endif
    </div>
    <!-- end of page-wrapper -->



    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins for this template -->
    <script src="{{ asset('assets/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/spirit.js') }}"></script>

    <!-- Custom script for this template -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
