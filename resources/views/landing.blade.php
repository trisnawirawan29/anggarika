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
        <section class="hero-slider hero-style-3" data-landing-section="hero">
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
                display: flex !important;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                width: 100%;
                max-width: 340px;
                margin: 0 auto;
                padding: 0;
                list-style: none;
            }

            .couple-area .couple-social-item {
                display: block !important;
                flex: 0 1 150px;
                width: auto !important;
                min-width: 0 !important;
                height: auto !important;
                margin: 0 !important;
                padding: 0 !important;
                line-height: normal !important;
                list-style: none !important;
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
                max-width: 100%;
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
                position: relative;
                z-index: 1;
                display: block !important;
                flex: 1 1 auto;
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
                visibility: visible !important;
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

                .couple-area .couple-social-item {
                    flex-basis: 136px;
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
        <div id="couple" class="couple-area section-padding" data-landing-section="couple">
            <div class="container">
                <div class="col-l2">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_couple_title'] }}</h2>
                    </article>
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
                                        <p style="font-family: Georgia, serif; white-space: pre-line;">{{ $landing['landing_groom_bio'] }}</p>
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
                                        <p style="font-family: Georgia, serif; white-space: pre-line;">{{ $landing['landing_bride_bio'] }}</p>
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
        <style>
            .countdown-modern .count-down-section {
                padding: clamp(58px, 8vw, 96px) 0;
            }

            .countdown-modern .count-down-section .big {
                margin-bottom: clamp(28px, 5vw, 52px);
            }

            .countdown-modern .count-down-section h2 {
                font-size: clamp(38px, 5vw, 60px);
            }

            .countdown-modern .count-down-section h2 > span {
                font-size: clamp(20px, 2.5vw, 30px);
                margin-bottom: 8px;
            }

            .countdown-modern .count-down-section #clock {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: clamp(8px, 2vw, 18px);
                max-width: 760px;
                margin: 0 auto;
                overflow: visible;
            }

            .countdown-modern .count-down-section #clock > div {
                width: auto;
                float: none;
                margin: 0 !important;
                padding: clamp(14px, 2.5vw, 28px) 8px;
                border: 1px solid rgba(255, 255, 255, .35);
                border-radius: 18px;
                background: linear-gradient(145deg, rgba(133, 170, 186, .82), rgba(72, 111, 126, .7));
                box-shadow: 0 12px 24px rgba(0, 0, 0, .18);
                backdrop-filter: blur(4px);
            }

            .countdown-modern .count-down-section #clock .box > div {
                font-size: clamp(30px, 5vw, 58px);
                line-height: 1;
            }

            .countdown-modern .count-down-section #clock .box span {
                display: block;
                margin-top: 8px;
                font-size: clamp(9px, 1.4vw, 14px);
                letter-spacing: .08em;
            }

            @media (max-width: 575px) {
                .countdown-modern .count-down-section #clock {
                    gap: 6px;
                }

                .countdown-modern .count-down-section #clock > div {
                    padding: 12px 3px;
                    border-radius: 12px;
                }

                .countdown-modern .count-down-section #clock .box > div {
                    font-size: clamp(24px, 8vw, 34px);
                }

                .countdown-modern .count-down-section #clock .box span {
                    margin-top: 5px;
                    font-size: 8px;
                    letter-spacing: .04em;
                }
            }
        </style>
        <div class="count-down-area count-down-area-sub countdown-modern" data-landing-section="countdown" style="background-image: url('{{ $landing['landing_countdown_background'] }}');">
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
        <style>
            .story-section .story-text p {
                font-family: Georgia, serif;
            }

            .story-section .story-timeline > .row {
                display: flex;
                align-items: stretch;
            }

            .story-section .story-timeline .story-media {
                display: flex;
            }

            .story-section .story-timeline .story-media .img-holder {
                width: 100%;
                height: 100%;
            }

            .story-section .story-timeline .story-media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            @media (max-width: 767px) {
                .story-section .story-timeline > .row {
                    display: flex;
                    flex-wrap: nowrap;
                    align-items: stretch;
                    margin-right: 0;
                    margin-left: 0;
                }

                .story-section .story-timeline > .row > .story-media,
                .story-section .story-timeline > .row > .story-copy {
                    float: none;
                    width: 50% !important;
                    flex: 0 0 50%;
                    padding: 0 !important;
                }

                .story-section .story-timeline > .row > .story-media {
                    order: 1;
                }

                .story-section .story-timeline > .row > .story-copy {
                    order: 2;
                }

                .story-section .story-timeline .story-media .img-holder {
                    min-height: clamp(150px, 42vw, 220px);
                }

                .story-section .story-timeline .story-media img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 0;
                }

                .story-section .story-timeline .story-copy .story-text {
                    height: 100%;
                    padding: 18px 14px;
                    text-align: left;
                }

                .story-section .story-timeline .story-copy h3 {
                    margin-bottom: 6px;
                    font-size: clamp(16px, 4.5vw, 20px);
                }

                .story-section .story-timeline .story-copy .date,
                .story-section .story-timeline .story-copy p {
                    font-size: clamp(11px, 3vw, 14px);
                    line-height: 1.5;
                }
            }
        </style>
        <!-- start story-section -->
        <section class="story-section section-padding" id="story" data-landing-section="story">
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
                                <div class="col col-md-6 story-copy">
                                    <div class="story-text right-align-text">
                                        <h3>{{ $landing['landing_story_1_title'] }}</h3>
                                        <p>{{ $landing['landing_story_1_text'] }}</p>
                                    </div>
                                </div>
                                <div class="col col-md-6 story-media">
                                    <div class="img-holder">
                                        <img src="{{ $landing['landing_story_photo_1'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($landing['landing_story_2_enabled'])
                            <div class="row">
                                <div class="col col-md-6 story-media">
                                    <div class="img-holder right-align-text story-slider">
                                        <img src="{{ $landing['landing_story_photo_2'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                                <div class="col col-md-6 text-holder story-copy">
                                    <span class="heart">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </span>
                                    <div class="story-text">
                                        <h3>{{ $landing['landing_story_2_title'] }}</h3>
                                        <p>{{ $landing['landing_story_2_text'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($landing['landing_story_3_enabled'])
                            <div class="row">
                                <div class="col col-md-6 text-holder right-heart story-copy">
                                    <span class="heart">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </span>
                                    <div class="story-text right-align-text">
                                        <h3>{{ $landing['landing_story_3_title'] }}</h3>
                                        <p>{{ $landing['landing_story_3_text'] }}</p>
                                    </div>
                                </div>
                                <div class="col col-md-6 story-media">
                                    <div class="img-holder right-align-text story-slider">
                                        <img src="{{ $landing['landing_story_photo_3'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($landing['landing_story_4_enabled'])
                            <div class="row">
                                <div class="col col-md-6 story-media">
                                    <div class="img-holder">
                                        <img src="{{ $landing['landing_story_photo_4'] }}" alt class="img img-responsive">
                                    </div>
                                </div>
                                <div class="col col-md-6 text-holder story-copy">
                                    <span class="heart">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </span>
                                    <div class="story-text">
                                        <h3>{{ $landing['landing_story_4_title'] }}</h3>
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
        <style>
            .cta-area .cta-title {
                font-size: var(--cta-title-size) !important;
            }

            .cta-area .cta-description {
                font-size: var(--cta-description-size) !important;
            }

            @media (max-width: 767px) {
                .cta-area .cta-title {
                    font-size: clamp(24px, 8vw, calc(var(--cta-title-size) * .72)) !important;
                    line-height: 1.15;
                }

                .cta-area .cta-description {
                    font-size: clamp(13px, 4.2vw, calc(var(--cta-description-size) * .9)) !important;
                    line-height: 1.6;
                }
            }
        </style>
        <!-- cta area start-->
        <div class="cta-area" data-landing-section="cta" style="background-image: url('{{ $landing['landing_cta_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cta-content">
                            <h2 class="cta-title" style="--cta-title-size: {{ (int) $landing['landing_cta_title_font_size'] }}px;{{ $landing['landing_cta_title_font_family'] !== 'inherit' ? ' font-family: '.$landing['landing_cta_title_font_family'].';' : '' }}">{{ $landing['landing_cta_title'] }}</h2>
                            <p class="cta-description" style="white-space: pre-line;--cta-description-size: {{ (int) $landing['landing_cta_text_font_size'] }}px;{{ $landing['landing_cta_text_font_family'] !== 'inherit' ? ' font-family: '.$landing['landing_cta_text_font_family'].';' : '' }}">{{ $landing['landing_cta_text'] }}</p>
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
        <style>
            .event-section .event-tabs-nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 12px;
                width: fit-content;
                max-width: 100%;
                margin: 0 auto;
                padding: 0;
            }

            .event-section .event-tabs-nav > li {
                float: none;
                margin: 0;
            }

            .event-section .event-tabs-nav > li > a {
                margin-right: 0;
            }
        </style>
        <!-- event-area -->
        <div id="event" class="event-section" data-landing-section="event">
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
                                @php
                                    $eventItems = collect([
                                        ['number' => 1, 'id' => 'turbo', 'label' => 'Ceremony', 'reverse' => false],
                                        ['number' => 2, 'id' => 'tyre', 'label' => 'Party', 'reverse' => false],
                                        ['number' => 3, 'id' => 'car-1', 'label' => 'Dinner', 'reverse' => false],
                                        ['number' => 4, 'id' => 'repair', 'label' => 'Reception', 'reverse' => false],
                                    ])->filter(fn (array $event): bool => $landing['landing_event_'.$event['number'].'_enabled']);
                                    $activeEventId = $eventItems->first()['id'] ?? null;
                                @endphp
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs event-tabs-nav">
                                            @foreach ($eventItems as $event)
                                                <li class="event-content{{ $event['id'] === $activeEventId ? ' active' : '' }}"><a data-toggle="tab" href="#{{ $event['id'] }}">{{ $landing['landing_event_'.$event['number'].'_title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="tab-content">
                                        @if ($landing['landing_event_1_enabled'])
                                        <div id="turbo" class="tab-pane{{ $activeEventId === 'turbo' ? ' active' : '' }}">
                                             <div class="event-wrap">
                                                <div class="row">
                                                    <div class="col-md-5 col-12">
                                                        <div class="event-img">
                                                            <img src="{{ $landing['landing_event_photo_1'] }}" alt>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-12">
                                                        <div class="event-text">
                                                            <h3>{{ $landing['landing_event_1_title'] }}</h3>
                                                            <span>{{ $landing['landing_event_1_date'] }}</span>
                                                            <span>{{ $landing['landing_event_1_location'] }}</span>
                                                            <p>{{ $landing['landing_event_1_text'] }}</p>
                                                            @if ($landing['landing_event_1_location_enabled'])
                                                            <div class="btn"><a class="popup-gmaps" href="{{ $landing['landing_event_1_location_url'] }}">{{ $landing['landing_event_1_location_label'] }}</a></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($landing['landing_event_2_enabled'])
                                        <div id="tyre" class="tab-pane{{ $activeEventId === 'tyre' ? ' active' : '' }}">
                                            <div class="row">
                                                 <div class="event-wrap">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="event-img">
                                                                <img src="{{ $landing['landing_event_photo_2'] }}" alt>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="event-text">
                                                                <h3>{{ $landing['landing_event_2_title'] }}</h3>
                                                                <span>{{ $landing['landing_event_2_date'] }}</span>
                                                                <span>{{ $landing['landing_event_2_location'] }}</span>
                                                                <p>{{ $landing['landing_event_2_text'] }}</p>
                                                                @if ($landing['landing_event_2_location_enabled'])
                                                                <div class="btn"><a class="popup-gmaps" href="{{ $landing['landing_event_2_location_url'] }}">{{ $landing['landing_event_2_location_label'] }}</a></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        @endif
                                        @if ($landing['landing_event_3_enabled'])
                                        <div id="car-1" class="tab-pane{{ $activeEventId === 'car-1' ? ' active' : '' }}">
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
                                                                <h3>{{ $landing['landing_event_3_title'] }}</h3>
                                                                <span>{{ $landing['landing_event_3_date'] }}</span>
                                                                <span>{{ $landing['landing_event_3_location'] }}</span>
                                                                <p>{{ $landing['landing_event_3_text'] }}</p>
                                                                @if ($landing['landing_event_3_location_enabled'])
                                                                <div class="btn"><a class="popup-gmaps" href="{{ $landing['landing_event_3_location_url'] }}">{{ $landing['landing_event_3_location_label'] }}</a></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        @endif
                                        @if ($landing['landing_event_4_enabled'])
                                        <div id="repair" class="tab-pane{{ $activeEventId === 'repair' ? ' active' : '' }}">
                                            <div class="row">
                                                 <div class="event-wrap">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="event-img">
                                                                <img src="{{ $landing['landing_event_photo_4'] }}" alt>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="event-text">
                                                                <h3>{{ $landing['landing_event_4_title'] }}</h3>
                                                                <span>{{ $landing['landing_event_4_date'] }}</span>
                                                                <span>{{ $landing['landing_event_4_location'] }}</span>
                                                                <p>{{ $landing['landing_event_4_text'] }}</p>
                                                                @if ($landing['landing_event_4_location_enabled'])
                                                                <div class="btn"><a class="popup-gmaps" href="{{ $landing['landing_event_4_location_url'] }}">{{ $landing['landing_event_4_location_label'] }}</a></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        @endif
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
        @if ($landing['landing_section_schedule'])
        <style>
            .schedule-section .schedule-grid {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 24px;
            }

            .schedule-section .schedule-card {
                flex: 0 1 280px;
                padding: 28px 24px;
                text-align: center;
                background: #fff;
                border: 1px solid rgba(133, 170, 186, .35);
                border-top: 5px solid #85aaba;
                border-radius: 18px;
                box-shadow: 0 12px 28px rgba(56, 92, 105, .12);
                transition: transform .25s ease, box-shadow .25s ease;
            }

            .schedule-section .schedule-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 18px 34px rgba(56, 92, 105, .18);
            }

            .schedule-section .schedule-card h3 {
                margin: 0 0 16px;
                color: #557f91;
                font-size: 24px;
                font-family: 'Great Vibes', cursive;
            }

            .schedule-section .schedule-card p {
                margin: 8px 0 0;
                color: #666;
                line-height: 1.6;
                font-family: Georgia, serif;
            }

            .schedule-section .schedule-card i {
                width: 34px;
                height: 34px;
                margin-right: 6px;
                color: #85aaba;
            }

            .schedule-section .schedule-card .schedule-address {
                display: flex;
                align-items: flex-start;
                justify-content: center;
                gap: 6px;
                margin-top: 6px;
                text-align: center;
                line-height: 1.35;
            }

            .schedule-section .schedule-card .schedule-address i {
                flex: 0 0 34px;
                margin-right: 0;
            }

            .schedule-section .schedule-location-button {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: clamp(24px, 4vw, 48px);
                padding: 10px 18px;
                border-radius: 999px;
                background: linear-gradient(135deg, #85aaba, #557f91);
                color: #fff;
                box-shadow: 0 8px 16px rgba(56, 92, 105, .2);
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                transition: transform .25s ease, box-shadow .25s ease;
            }

            .schedule-section .schedule-location-button:hover {
                color: #fff;
                transform: translateY(-3px);
                box-shadow: 0 12px 22px rgba(56, 92, 105, .3);
            }

            .schedule-section .schedule-location-button i {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: auto;
                height: auto;
                margin: 0;
                color: #fff;
                font-size: 14px;
            }

            @media (max-width: 575px) {
                .schedule-section .schedule-grid {
                    gap: 16px;
                }

                .schedule-section .schedule-card {
                    flex-basis: min(100%, 320px);
                    padding: 22px 18px;
                }
            }
        </style>
        <section id="schedule" class="schedule-section section-padding" data-landing-section="schedule">
            <div class="container">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_schedule_title'] }}</h2>
                    </div>
                </div>
                <div class="schedule-grid">
                    @for ($number = 1; $number <= (int) $landing['landing_schedule_count']; $number++)
                        <article class="schedule-card">
                            <h3>{{ $landing['landing_schedule_'.$number.'_name'] }}</h3>
                            <p><i class="fa fa-calendar" aria-hidden="true"></i>{{ $landing['landing_schedule_'.$number.'_date'] }}</p>
                            <p><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $landing['landing_schedule_'.$number.'_time'] }}</p>
                            <p class="schedule-address"><i class="fa fa-map-marker" aria-hidden="true"></i><span>{{ $landing['landing_schedule_'.$number.'_location'] }}</span></p>
                            @if ($landing['landing_schedule_'.$number.'_location_enabled'])
                                <a class="schedule-location-button popup-gmaps" href="{{ $landing['landing_schedule_'.$number.'_location_url'] }}"><i class="fa fa-map-marker" aria-hidden="true"></i>Lihat lokasi</a>
                            @endif
                        </article>
                    @endfor
                </div>
            </div>
        </section>
        @endif
        @if ($landing['landing_section_people'])
        <!-- groomsmen-bridesmaid-area start -->
        <div id="people" class="groomsmen-bridesmaid-area pt--150 pb--70" data-landing-section="people">
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
        <div class="cta-area" data-landing-section="cta_gallery" style="background-image: url('{{ $landing['landing_cta_gallery_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cta-content">
                            <h2>{{ $landing['landing_cta_gallery_title'] }}</h2>
                            <p style="font-family: Georgia, serif; white-space: pre-line;">{{ $landing['landing_cta_gallery_text'] }}</p>
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
        <style>
            .gallery-section .masonry-gallery .grid {
                width: 25%;
            }

            .gallery-section .gallery-centered {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: clamp(24px, 4vw, 48px);
                height: auto !important;
            }

            @media (min-width: 992px) {
                .gallery-section .gallery-centered {
                    margin-top: clamp(52px, 5vw, 76px);
                }
            }

            .gallery-section .gallery-centered .grid {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                float: none !important;
                transform: none !important;
            }

            .gallery-section .masonry-gallery .grid img {
                height: 220px;
                object-fit: cover;
                border-radius: 12px;
            }

            @media (max-width: 767px) {
                .gallery-section .masonry-gallery .grid {
                    width: 50%;
                }

                .gallery-section .masonry-gallery .grid img {
                    height: 170px;
                }
            }

            @media (max-width: 550px) {
                .gallery-section .masonry-gallery .grid {
                    width: 100%;
                }
            }
        </style>
        <section id="gallery" class="gallery-section section-padding" data-landing-section="gallery">
            <div class="container">
                <div class="col-l2">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_gallery_title'] }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12 sortable-gallery">
                        <div class="gallery-container gallery-fancybox masonry-gallery gallery-centered">
                            @foreach ($galleryItems as $galleryItem)
                                <div class="grid">
                                    <a href="{{ $galleryItem['url'] }}" class="fancybox" data-fancybox-group="gall-1">
                                        <img src="{{ $galleryItem['url'] }}" alt="Foto galeri" class="img img-responsive">
                                        <div class="icon"><i class="ti-plus"></i></div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </section>
        <!--End project area--> 
        @endif

        @if ($landing['landing_section_rsvp'])
        <!-- rsvp-area strat -->
        <style>
            .rsvp-modern .rsvp-wrap {
                padding: clamp(32px, 5vw, 58px);
                border-radius: 24px;
                background: rgba(255, 255, 255, .94);
                box-shadow: 0 18px 42px rgba(56, 92, 105, .16);
            }

            .rsvp-modern .section-title {
                margin-bottom: 70px;
            }

            .rsvp-modern .section-title h2 {
                color: #557f91;
            }

            .rsvp-modern .rsvp-description {
                max-width: 680px;
                margin: 0 auto 34px;
                color: #666;
                font-family: Georgia, serif;
                line-height: 1.8;
                text-align: center;
            }

            .rsvp-modern .rsvp-message-form {
                margin-bottom: clamp(34px, 6vw, 58px);
                padding: clamp(20px, 4vw, 34px);
                border: 1px solid rgba(133, 170, 186, .28);
                border-radius: 18px;
                background: #f8fbfc;
            }

            .rsvp-modern .rsvp-field {
                width: 100%;
                margin-bottom: 16px;
                padding: 14px 16px;
                border: 1px solid rgba(133, 170, 186, .45);
                border-radius: 10px;
                background: #fff;
                color: #557f91;
                font-family: inherit;
                outline: none;
                transition: border-color .2s ease, box-shadow .2s ease;
            }

            .rsvp-modern .rsvp-field:focus {
                border-color: #557f91;
                box-shadow: 0 0 0 3px rgba(133, 170, 186, .18);
            }

            .rsvp-modern .rsvp-field::placeholder {
                color: #8a9aa0;
                opacity: 1;
            }

            .rsvp-modern textarea.rsvp-field {
                min-height: 118px;
                resize: vertical;
            }

            .rsvp-modern .rsvp-submit {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 26px;
                border: 0;
                border-radius: 999px;
                background: linear-gradient(135deg, #85aaba, #557f91);
                color: #fff;
                font-weight: 600;
                box-shadow: 0 9px 18px rgba(56, 92, 105, .2);
                transition: transform .2s ease, box-shadow .2s ease;
            }

            .rsvp-modern .rsvp-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 13px 24px rgba(56, 92, 105, .28);
            }

            .rsvp-modern .rsvp-feedback {
                margin-bottom: 18px;
                padding: 12px 16px;
                border-radius: 10px;
                background: #e8f5ed;
                color: #277344;
                text-align: center;
            }

            .rsvp-modern .rsvp-errors {
                background: #fff0f0;
                color: #9b3d3d;
            }

            .rsvp-modern .rsvp-messages-title {
                margin: 0 0 22px;
                color: #557f91;
                font-family: 'Great Vibes', cursive;
                font-size: 34px;
                text-align: center;
            }

            .rsvp-modern .rsvp-message-list {
                display: grid;
                gap: 14px;
            }

            .rsvp-modern .rsvp-message-card {
                display: flex;
                gap: 14px;
                padding: 18px;
                border: 1px solid rgba(133, 170, 186, .24);
                border-radius: 15px;
                background: #fff;
                box-shadow: 0 8px 18px rgba(56, 92, 105, .08);
            }

            .rsvp-modern .rsvp-message-avatar {
                display: flex;
                flex: 0 0 42px;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: #85aaba;
                color: #fff;
                font-weight: 700;
            }

            .rsvp-modern .rsvp-message-meta {
                display: flex;
                align-items: baseline;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 5px;
            }

            .rsvp-modern .rsvp-message-meta strong {
                color: #557f91;
            }

            .rsvp-modern .rsvp-message-meta small {
                color: #999;
                white-space: nowrap;
            }

            .rsvp-modern .rsvp-message-text {
                margin: 0;
                color: #666;
                font-family: Georgia, serif;
                line-height: 1.65;
                white-space: pre-line;
            }

            .rsvp-modern .rsvp-pagination {
                margin-top: 26px;
                text-align: center;
            }

            @media (max-width: 767px) {
                .rsvp-modern .rsvp-wrap {
                    padding: 24px 16px;
                }

                .rsvp-modern .section-title {
                    margin-bottom: 60px;
                }

                .rsvp-modern .rsvp-description {
                    margin-top: 0;
                }

                .rsvp-modern .rsvp-message-meta {
                    display: block;
                }

                .rsvp-modern .rsvp-message-meta small {
                    display: block;
                    margin-top: 3px;
                }
            }
        </style>
        <div id="rsvp" class="rsvp-area rsvp-modern go-rsvp-area" data-landing-section="rsvp" style="background-image: url('{{ $landing['landing_rsvp_background'] }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="rsvp-wrap">
                            <div class="col-12">
                                <div class="section-title section-title-2 text-center">
                                    <h2>{{ $landing['landing_rsvp_title'] }}</h2>
                                </div>
                            </div>
                            <p class="rsvp-description">{{ $landing['landing_rsvp_description'] }}</p>
                            @if (session('rsvp_success'))
                                <div class="rsvp-feedback">{{ session('rsvp_success') }}</div>
                            @endif
                            @if ($errors->has('name') || $errors->has('message'))
                                <div class="rsvp-feedback rsvp-errors">{{ $errors->first('name') ?: $errors->first('message') }}</div>
                            @endif
                            <form action="{{ route('rsvp.messages.store') }}" method="POST" class="rsvp-message-form">
                                @csrf
                                <input type="text" name="name" class="rsvp-field" placeholder="Tuliskan nama lengkap Anda" maxlength="80" value="{{ old('name') }}" required>
                                <textarea name="message" class="rsvp-field" placeholder="Tuliskan ucapan dan doa untuk pasangan..." maxlength="1000" required>{{ old('message') }}</textarea>
                                <div class="text-center"><button type="submit" class="rsvp-submit"><i class="fa fa-paper-plane me-2" aria-hidden="true"></i>Kirim ucapan</button></div>
                            </form>
                            <h3 class="rsvp-messages-title">Ucapan &amp; Doa</h3>
                            <div class="rsvp-message-list">
                                @forelse ($rsvpMessages as $rsvpMessage)
                                    <article class="rsvp-message-card">
                                        <div class="rsvp-message-avatar" aria-hidden="true">{{ strtoupper(substr($rsvpMessage->name, 0, 1)) }}</div>
                                        <div class="flex-grow-1">
                                            <div class="rsvp-message-meta"><strong>{{ $rsvpMessage->name }}</strong><small>{{ $rsvpMessage->created_at->format('d M Y, H:i') }}</small></div>
                                            <p class="rsvp-message-text">{{ $rsvpMessage->message }}</p>
                                        </div>
                                    </article>
                                @empty
                                    <p class="rsvp-message-text text-center">Belum ada ucapan. Jadilah yang pertama memberikan doa.</p>
                                @endforelse
                            </div>
                            @if ($rsvpMessages->hasPages())
                                <div class="rsvp-pagination">{{ $rsvpMessages->links() }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rsvp-area end -->
        @endif
        @if ($landing['landing_section_gta'])
        <!-- getting-area start -->
        <div class="gta-area" data-landing-section="gta">
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
        <style>
            .gift-registration-modern {
                padding: clamp(72px, 9vw, 120px) 0 clamp(48px, 7vw, 88px);
                background: linear-gradient(180deg, #fff 0%, #f7fbfc 100%);
            }

            .gift-registration-modern .section-title {
                margin-bottom: 70px;
            }

            .gift-registration-modern .gift-description {
                max-width: 680px;
                margin: 0 auto clamp(28px, 5vw, 48px);
                color: #666;
                font-family: Georgia, serif;
                font-size: 16px;
                line-height: 1.8;
                text-align: center;
            }

            .gift-registration-modern .gift-card-wrap {
                display: flex;
                justify-content: center;
            }

            .gift-registration-modern .gift-card {
                position: relative;
                width: min(100%, 460px);
                min-height: 270px;
                padding: 28px 32px;
                overflow: hidden;
                border: 1px solid rgba(255, 255, 255, .45);
                border-radius: 24px;
                background: linear-gradient(135deg, #557f91 0%, #85aaba 52%, #c0d8df 100%);
                box-shadow: 0 22px 42px rgba(56, 92, 105, .24);
                color: #fff;
                isolation: isolate;
            }

            .gift-registration-modern .gift-card::before,
            .gift-registration-modern .gift-card::after {
                position: absolute;
                z-index: -1;
                width: 190px;
                height: 190px;
                border: 1px solid rgba(255, 255, 255, .2);
                border-radius: 50%;
                content: '';
            }

            .gift-registration-modern .gift-card::before {
                top: -108px;
                right: -42px;
            }

            .gift-registration-modern .gift-card::after {
                right: -84px;
                bottom: -122px;
            }

            .gift-registration-modern .gift-card-top,
            .gift-registration-modern .gift-card-bottom {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .gift-registration-modern .gift-bank-name {
                font-size: 21px;
                font-weight: 700;
                letter-spacing: .04em;
            }

            .gift-registration-modern .gift-card-type {
                font-size: 11px;
                font-weight: 700;
                letter-spacing: .18em;
                text-transform: uppercase;
            }

            .gift-registration-modern .gift-chip {
                width: 48px;
                height: 36px;
                margin: 30px 0 20px;
                border: 1px solid rgba(70, 80, 80, .35);
                border-radius: 8px;
                background: linear-gradient(135deg, #f4df9d, #c59c51);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, .28);
            }

            .gift-registration-modern .gift-account-number {
                margin: 0 0 24px;
                font-size: clamp(23px, 5vw, 31px);
                font-weight: 600;
                letter-spacing: .12em;
                line-height: 1.2;
                word-break: break-word;
            }

            .gift-registration-modern .gift-card-bottom {
                align-items: flex-end;
                gap: 16px;
            }

            .gift-registration-modern .gift-card-label {
                display: block;
                margin-bottom: 4px;
                font-size: 9px;
                letter-spacing: .14em;
                opacity: .78;
                text-transform: uppercase;
            }

            .gift-registration-modern .gift-account-holder {
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .05em;
                text-transform: uppercase;
            }

            .gift-registration-modern .gift-contactless {
                font-size: 27px;
                line-height: 1;
                opacity: .85;
                transform: rotate(90deg);
            }

            @media (max-width: 575px) {
                .gift-registration-modern .section-title {
                    margin-bottom: 60px;
                }

                .gift-registration-modern .gift-card {
                    min-height: 230px;
                    padding: 22px 21px;
                    border-radius: 19px;
                }

                .gift-registration-modern .gift-chip {
                    width: 41px;
                    height: 31px;
                    margin: 22px 0 16px;
                }

                .gift-registration-modern .gift-account-number {
                    margin-bottom: 20px;
                    letter-spacing: .08em;
                }
            }
        </style>
        <div class="Gift-area gift-registration-modern" data-landing-section="gift">
            <div class="container">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>{{ $landing['landing_gift_title'] }}</h2>
                    </div>
                    <p class="gift-description">{{ $landing['landing_gift_description'] }}</p>
                </div>
                <div class="gift-card-wrap">
                    <article class="gift-card" aria-label="Informasi rekening hadiah">
                        <div class="gift-card-top">
                            <span class="gift-bank-name">{{ $landing['landing_gift_bank_name'] }}</span>
                            <span class="gift-card-type">Wedding Gift</span>
                        </div>
                        <div class="gift-chip" aria-hidden="true"></div>
                        <p class="gift-account-number">{{ $landing['landing_gift_account_number'] }}</p>
                        <div class="gift-card-bottom">
                            <div>
                                <span class="gift-card-label">Atas nama</span>
                                <span class="gift-account-holder">{{ $landing['landing_gift_account_holder'] }}</span>
                            </div>
                            <span class="gift-contactless" aria-hidden="true">)))</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <!-- Gift Registration end -->
        @endif

        @if ($landing['landing_section_footer'])
        <!-- start site-footer -->
        <footer class="site-footer" data-landing-section="footer" style="background-image: url('{{ $landing['landing_footer_background'] }}');">
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
        <div class="music-box" data-landing-section="music">
            <button class="music-box-toggle-btn">
                <i class="ti-music-alt"></i>
            </button>
            <div class="music-holder">
                <audio id="landing-music" controls autoplay loop preload="auto" src="{{ $landing['landing_music_file'] }}"></audio>
            </div>
            <script>
                (() => {
                    const music = document.getElementById('landing-music');
                    const toggleButton = document.querySelector('.music-box-toggle-btn');
                    if (!music) {
                        return;
                    }

                    const playMusic = () => music.play();
                    const startAfterInteraction = () => {
                        playMusic().catch(() => {});
                        document.removeEventListener('pointerdown', startAfterInteraction);
                        document.removeEventListener('keydown', startAfterInteraction);
                    };

                    playMusic().catch(() => {
                        document.addEventListener('pointerdown', startAfterInteraction, {once: true, passive: true});
                        document.addEventListener('keydown', startAfterInteraction, {once: true});
                    });

                    toggleButton?.addEventListener('click', () => {
                        if (music.paused) {
                            playMusic().catch(() => {});
                        } else {
                            music.pause();
                        }
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
    <script>
        (() => {
            const wrapper = document.querySelector('.page-wrapper');
            const sectionOrder = @json($landing['landing_section_order']);
            if (!wrapper || !Array.isArray(sectionOrder)) {
                return;
            }

            const sections = new Map([...wrapper.querySelectorAll('[data-landing-section]')]
                .map((section) => [section.dataset.landingSection, section]));
            sectionOrder.forEach((sectionName) => {
                const section = sections.get(sectionName);
                if (section) {
                    wrapper.appendChild(section);
                }
            });
        })();
    </script>
</body>
</html>
