<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Checkout</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Colo Shop Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- font Awesome Cdn -->
        <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>

        <!-- Bootstrap cdn -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <!-- Owl Carousel File -->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">

        <!-- CSS File -->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('frontend/styles/style.css') }}">

    </head>

    <body>
        <div class="super_container">
            <!-- Header -->

            <header class="header trans_300">
                <!-- main Navigation -->
                <div class="main_nav_container">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <div class="logo_container">
                                    <a href="{{route('home')}}">E-<span>Mart</span></a>
                                </div>
                                <nav class="navbar">
                                    <ul class="navbar_menu">
                                        <li>
                                            <a href="{{route('home')}}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{route('shop.index')}}">Shop</a>
                                        </li>
                                        <li>
                                            <a href="#">Featuered Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Pages</a>
                                        </li>
                                        <li>
                                            <a href="#">Blog</a>
                                        </li>
                                        <li>
                                            <a href="#">Contact us</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar_user">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                        </li>

                                        {{-- cart dropdown --}}
                                        @include('backend.includes.cart_dropdown')

                                        @if (Auth::check())
                                        <li class="dropdown">
                                            <button class="btn dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <li><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                                            </button>
                                            <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item custom-dropdown-item disabled" href="javascript:void(0)">Welcome,<br>
                                                    <i class="fas fa-id-badge"> {{Auth::user()->name}}</a></i>

                                                @if(Auth::user()->role == 3)
                                                <a class="dropdown-item" href="{{route('user.dashboard')}}"><i class="fa fa-address-card" aria-hidden="true"> Profile Dashboard</i></a>
                                                @elseif(Auth::user()->role == 2)
                                                <a class="dropdown-item" href="{{route('vendor.dashboard')}}"><i class="fa fa-address-card" aria-hidden="true"> Vendor Dashboard</i></a>
                                                @endif
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="dropdown-item"
                                                        href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="fa fa-sign-out"> Logout</i>
                                                    </a>
                                                </form>
                                            </div>
                                        </li>

                                        @else

                                        <li class="dropdown">
                                            <button class="btn dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <li><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                                            </button>
                                            <div class="dropdown-menu custom-dropdown-menu-def" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('user.login')}}"><i class="fa fa-sign-in"> Sign in</i></a>
                                                <a class="dropdown-item" href="{{route('user.register')}}"><i class="fas fa-id-badge"> Register</i></a>
                                            </div>
                                        </li>

                                        @endif

                                    </ul>

                                    <div class="hamburger_container">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </div>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

            </header>

            <div class="fs_menu_overlay"></div>
            <div class="hamburger_menu">
                <div class="hamburger_close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
                <div class="hamburger_menu_content text-right">
                    <ul class="menu_top_nav">
                        <li class="menu_item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="menu_item">
                            <a href="cus_login.html">Profile</a>
                        </li>
                        <li class="menu_item">
                            <a href="{{route('shop.index')}}">Shop</a>
                        </li>
                        <li class="menu_item">
                            <a href="#">Promotion</a>
                        </li>
                        <li class="menu_item">
                            <a href="#">Pages</a>
                        </li>
                        <li class="menu_item">
                            <a href="#">Blog</a>
                        </li>
                        <li class="menu_item">
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Product Details -->
            <div class="find_shops">
                <div class="container">

                    <div class="row">
                        <div class="col text-center">
                            <div class="section_title find_shop_title">
                                <h2>Checkout</h2>
                                @php
                                    $cartItems = App\Models\Frontend\Cart::orderBy('id','asc')->where('user_id',Auth::id())->orWhere('user_id',request()->ip())->get();
                                    $total_price = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                @php $total_price += $item->product->product_price * $item->product_quantity @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-top: 50px">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{route('order.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No</label>
                                                <input type="text" name="phone" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Shipping Address</label>
                                                <input type="text" name="shipping_address" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-4" style="margin-top: 32px;">
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">product</th>
                                                <th scope="col">quantity</th>
                                                <th scope="col">total</th>
                                            </tr>
                                        </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{$item->product->product_name}}</td>
                                        <td>{{ $item->product_quantity }}</td>
                                        <td>{{ $item->product->product_price * $item->product_quantity }}</td>
                                    </tr>
                                    @endforeach
                                     <tr>
                                        <td>Final Price</td>
                                        <td></td>
                                       <td>{{ $total_price }}</td>
                                    </tr>
                                </tbody>
                               </table>
                             </div>
                             <div class="form-group">
                                 <input type="submit" name="orderConfirm" value="Confirm Order" class="btn btn-primary">
                             </div>
                            </div>
                          </div>
                        </form>
                    </div>




    <!-- Benefit -->
    <div class="benefit">
        <div class="container">
            <div class="row benefit_row">

                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                        </div>
                        <div class="benefit_content">
                            <h6>Free Shipping</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </div>
                        <div class="benefit_content">
                            <h6>45 Days Return</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <div class="benefit_content">
                            <h6>Cash on Delivery</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>
                        <div class="benefit_content">
                            <h6>Open 24/7</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div
                        class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
                        <ul class="footer_nav">
                            <li>
                                <a href="#">Blog</a>
                            </li>
                            <li>
                                <a href="#">FAQs</a>
                            </li>
                            <li>
                                <a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div
                        class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-skype" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_nav-container">
                        <div class="cr text-center">© 2021 Copyright – All Rights Reserved by
                            <a href="#">E-Mart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<!-- Isotope JS File -->
<script src="{{ asset('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<!-- Owl Carousel JS File -->
<script
    src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<!-- Javascript File -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>
