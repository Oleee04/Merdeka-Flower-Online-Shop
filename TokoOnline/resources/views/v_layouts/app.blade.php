<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>Merdeka Flower - Online Plant Shop</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- Custom CSS -->
    <style>
        /* Primary Colors */
        :root {
            --primary-color: #3c6e47; /* Dark green */
            --secondary-color: #8da97e; /* Light green */
            --accent-color: #e9c46a; /* Golden yellow */
            --light-color: #f8f9fa; /* Very light gray */
            --dark-color: #2a3d45; /* Dark blue */
            --text-color: #333333; /* Black for text */
            --text-light: #5a5a5a; /* Gray for text */
            --white: #ffffff; /* White */
        }
        
        /* Typography */
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--light-color);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--dark-color);
            font-weight: 600;
        }
        
        /* Header */
        #header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 10px 0;
        }
        
        .header-logo img {
            max-height: 60px;
            transition: transform 0.3s ease;
        }
        
        .header-logo img:hover {
            transform: scale(1.05);
        }
        
        .header-btns .header-btns-icon {
            background-color: var(--white);
            color: var(--white);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .header-btns .header-btns-icon:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }
        
        .header-btns strong {
            font-weight: 500;
        }
        
        /* Navigation */
        #navigation {
            background-color: var(--primary-color);
            padding: 0;
        }
        
        .category-nav .category-header {
            background-color: var(--dark-color);
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .category-nav .category-list {
            background-color: var(--white);
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .category-nav .category-list li a {
            color: var(--text-color);
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        
        .category-nav .category-list li a:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
            padding-left: 25px;
        }
        
        .menu-nav .menu-list li a {
            color: var(--white);
            font-weight: 500;
            padding: 18px 20px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .menu-nav .menu-list li a:hover,
        .menu-nav .menu-list li a:focus {
            color: var(--dark-color);
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .menu-nav .menu-list li a:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 10%;
            width: 80%;
            height: 2px;
            background-color: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .menu-nav .menu-list li a:hover:after {
            transform: scaleX(1);
        }
        
        /* Home Slider */
        #home {
            padding: 30px 0;
        }
        
        .banner {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .banner img {
            transition: transform 0.5s ease;
        }
        
        .banner:hover img {
            transform: scale(1.03);
        }
        
        .banner-caption {
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 30px;
            color: var(--white);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        
        .banner-caption h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--white);
        }
        
        /* Section */
        .section {
            padding: 60px 0;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 40px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-color));
            border-radius: 3px;
        }
        
          /* Aside */
        .aside {
            background-color: var(--white);
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            color: var(--dark-color);
        }

        .aside-title {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .aside-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .aside .list-links li a {
            color: var(--dark-color);
        }

        .aside .list-links li a:hover {
            color: var(--primary-color);
        }

        /* Product Widget */
        .product.product-widget {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .product.product-widget:last-child {
            border-bottom: none;
        }

        .product-thumb {
            border-radius: 6px;
            overflow: hidden;
            margin-right: 15px;
        }

        .product-body .product-name a {
            color: var(--dark-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .product-body .product-name a:hover {
            color: var(--primary-color);
        }

        .product-body .product-price {
            color: var(--dark-color);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .list-links li a {
            color: var(--dark-color);
            padding: 8px 0;
            display: block;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 20px;
        }

        .list-links li a:before {
            content: '•';
            position: absolute;
            left: 0;
            color: var(--primary-color);
        }

        .list-links li a:hover {
            color: var(--primary-color);
            padding-left: 25px;
        }

        /* Footer */
        #footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 60px 0 0;
        }
        
        .footer .footer-header {
            color: var(--white);
            font-size: 1.25rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .footer .footer-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .footer-logo img {
            max-height: 60px;
            margin-bottom: 20px;
        }
        
        .footer-social li {
            display: inline-block;
            margin-right: 10px;
        }
        
        .footer-social li a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .footer-social li a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .list-links li a {
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }
        
        .list-links li a:hover {
            color: var(--primary-color);
        }
        
        .footer .input {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border: none;
        }
        
        .footer .input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .footer .input:focus {
            box-shadow: 0 0 0 1px var(--primary-color);
        }
        
        .footer .primary-btn {
            background-color: var(--white);
            color: var(--dark-color);
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }
        
        .footer .primary-btn:hover {
            background-color: var(--white);
        }
        
        .footer-copyright {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 20px 0;
            margin-top: 60px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Buttons */
        .primary-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(60, 110, 71, 0.25);
        }
        
        .primary-btn:hover {
            background-color: var(--secondary-color);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(60, 110, 71, 0.35);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animated {
            animation: fadeIn 0.6s ease forwards;
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .menu-nav .menu-header {
                background-color: var(--dark-color);
            }
            
            .category-nav .category-header {
                background-color: var(--dark-color);
            }
            
            #responsive-nav .dropdown .custom-menu {
                background-color: rgba(255, 255, 255, 0.95);
            }
            
            .banner-caption h2 {
                font-size: 1.8rem;
            }
        }
    </style>
    
    <!-- IE Compatibility -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- HEADER -->
    <header>
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <div class="header-logo">
                        <a class="logo" href="#">
                            <img src="{{ asset('image/icon_merdeka_flower.png') }}" alt="Merdeka Flower">
                        </a>
                    </div>
                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">
                            <a href="{{ route('order.cart') }}" class="dropdown-toggle" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <strong class="text-uppercase">Cart</strong>
                            </a>
                        </li>

                        <!-- Account -->
                        @if (Auth::check())
                        <li class="header-account dropdown default-dropdown">
                            <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon"><i class="fa fa-user-o"></i></div>
                                <strong class="text-uppercase">{{ Auth::user()->nama }} <i class="fa fa-caret-down"></i></strong>
                            </div>
                            <ul class="custom-menu">
                                <li><a href="{{ route('customer.akun', ['id' => Auth::user()->id]) }}"><i class="fa fa-user-o"></i> Profile</a></li>
                                <li><a href="history"><i class="fa fa-check"></i> History</a></li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>
                                    <form id="keluar-app" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="header-account dropdown default-dropdown">
                            <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon"><i class="fa fa-user-o"></i></div>
                                <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                            </div>
                            <a href="{{ route('auth.redirect') }}" class="text-uppercase">Login</a>
                        </li>
                        @endif

                        <!-- Mobile nav toggle -->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- NAVIGATION -->
    <div id="navigation">
        <div class="container">
            <div id="responsive-nav">
                @php 
                    $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get(); 
                @endphp

                @if (request()->segment(1) == '' || request()->segment(1) == 'beranda')
                <div class="category-nav">
                    <span class="category-header">Categories <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                        @foreach ($kategori as $row)
                        <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="category-nav show-on-click">
                    <span class="category-header">Categories <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                        @foreach ($kategori as $row)
                        <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Menu nav -->
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="{{ route('beranda') }}">Home</a></li>
                        <li><a href="{{ route('produk.all') }}">Products</a></li>
                        <li><a href="{{ route('cara.pesan') }}">How to Order</a></li>
                        <li><a href="{{ route('lokasi') }}">Location</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- HOME -->
    @if (request()->segment(1) == '' || request()->segment(1) == 'beranda')
    <div id="home">
        <div class="container">
            <div class="home-wrap">
                <div id="home-slick">
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/banner/banner04.png') }}" alt="Ornamental Plants">
                    </div>
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/banner/banner05.png') }}" alt="Plant Care">
                    </div>
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/banner/banner06.png') }}" alt="Indoor Plants">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <div class="aside">
                        <h3 class="aside-title">Popular Products</h3>
                        <div class="product product-widget">
                            <div class="product-thumb"><img src="{{ asset('storage/img-produk/Begonia_-_Maculata.png') }}" alt=""></div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="">Begonia Maculata</a></h2>
                                <h3 class="product-price">Rp. 570.404</h3>
                                <div class="product-rating">
                                    @for ($i = 0; $i < 4; $i++)<i class="fa fa-star"></i>@endfor
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                            </div>
                        </div>
                        <div class="product product-widget">
                            <div class="product-thumb"><img src="{{ asset('storage/img-produk/Philo_Gloriosum.png') }}" alt=""></div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Philodendron Gloriosum </a></h2>
                                <h3 class="product-price">Rp 975.000</h3>
                                <div class="product-rating">
                                    @for ($i = 0; $i < 5; $i++)<i class="fa fa-star"></i>@endfor
                                </div>
                            </div>
                        </div>
                        <div class="product product-widget">
                            <div class="product-thumb"><img src="{{ asset('storage/img-produk/Aglaonema_-_Silver_Queen.png') }}" alt=""></div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Aglaonema Silver Queen</a></h2>
                                <h3 class="product-price">Rp. 299.000 </h3>
                                <div class="product-rating">
                                    @for ($i = 0; $i < 3; $i++)<i class="fa fa-star"></i>@endfor
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">Filter by Category</h3>
                        <ul class="list-links">
                            @foreach ($kategori as $row)
                            <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- MAIN -->
                <div id="main" class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer id="footer" class="section section-grey">
        <div class="container">
            <div class="row">
                <!-- Footer widgets -->
                <div class="col-md-4 col-sm-6">
                    <div class="footer">
                        <p>Merdeka Flower provides various quality ornamental plants at affordable prices. We are committed to providing a pleasant plant shopping experience.</p>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6">
                    <div class="footer">
                        <h3 class="footer-header">About Us</h3>
                        <ul class="list-links">
                            <li><a href="#">History</a></li>
                            <li><a href="#">Vision & Mission</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer">
                        <h3 class="footer-header">Customer Service</h3>
                        <ul class="list-links"> 
                            <li><a href="#">How to Order</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Care Guide</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul> 
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer">
                        <h3 class="footer-header">Subscribe</h3>
                        <p>Get the latest information about promotions and plant care tips delivered to your email.</p>
                        <form>
                            <div class="form-group">
                                <input class="input" placeholder="Your Email">
                            </div>
                            <button class="primary-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="footer-copyright">
                        &copy;<script>document.write(new Date().getFullYear());</script> Merdeka Flower. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS Plugins -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    
    <script>
        // Animation when page loads
        $(document).ready(function() {
            $('.animated').each(function(i) {
                $(this).delay(100 * i).queue(function() {
                    $(this).addClass('fadeIn');
                });
            });
            
            // Initialize slider
            $('#home-slick').slick({
                dots: true,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 5000,
                fade: true,
                cssEase: 'linear'
            });
        });
    </script>

    @yield('scripts')
</body>

</html>