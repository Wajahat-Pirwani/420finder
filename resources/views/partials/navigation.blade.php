<header id="header" class="fixed-top {{ request()->routeIs('desktop-map') ? 'map-page' : '' }}">

    {{-- DESKTOP NAV --}}
    <div class="container desktop-nav-container">

        <div class="row">
            <div class="col-8">

                <div class="row">
                    <div class="col-2">
                        <div class="site-logo">
                            <a href="{{ route('index') }}"><img src="{{ asset('assets/img/logo.png') }}" alt=""
                                                                class="img-fluid"></a>
                        </div>
                    </div>

                    <div class="col-10">
                        <div class="topMenuSearchBar">
                            <form action="{{ route('search') }}" method="GET">

                                <div class="row product-location-wrap">

                                    {{-- <div class="col-6 d-flex align-items-center search-product-wrap px-0">
                                        <span class="searchIcon">
                                            <i class="fas fa-search"></i>
                                        </span>

                                        <div class="search-product">
                                            <input type="text" name="keyword" placeholder="Products, retailers, brands, and more">
                                        </div>

                                    </div> --}}

                                    <?php
                                    if(!request()->routeIs('maps')) {
                                    ?>
                                    <product-component></product-component>
                                    <?php }
                                    ?>


                                    <desktop-location-search>
                                    </desktop-location-search>

                                </div>

                            </form>

                            {{-- MENU LINKS --}}
                            <div class="menu-links">
                                <ul class="list-unstyled d-flex subMenu pt-2 subMenuRow">

                                    <li>
                                        <a href="{{ route('dispensaries') }}">
                                            Dispensaries</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('deliveries') }}">Deliveries</a>
                                    </li>


                                    <li>
                                        <a href="{{ route('desktop-map') }}">Maps</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('brands') }}">Brands</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('products.index') }}">
                                            Products</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('deals') }}">Deals</a>
                                    </li>

                                    {{--                                    <li>--}}
                                    {{--                                        <a href="{{ route('strains') }}">Strains</a>--}}
                                    {{--                                    </li>--}}

                                </ul>

                            </div>
                            {{-- MENU LINKS ENDS --}}

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-4 d-flex">

                <ul class="d-flex justify-content-end align-items-center" style="margin-left: auto; list-style: none">
                    <ul class="mobileIconsRow">

                        <ul class="d-flex justify-content-center">

                            <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                                <a class="nav-link" href="{{ route('notifications') }}">
                                    <i class="fas fa-bell"></i>
                                    <?php
                                    $notifications = \App\Models\Notifications::where('customer_id', Session('customer_id'))->where('status', 0)->get()
                                    ?>
                                    <span class="notification">{{ $notifications->count() }}</span>
                                </a>
                            </li>

                            <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                                <a class="nav-link" href="{{ route('favorites') }}">
                                    <i class="fas fa-heart"></i>
                                    <span class="notification">
                                        <?php
                                        $checkfavs = App\Models\Favorite::where('customer_id', session('customer_id'))->count();
                                        echo $checkfavs;
                                        ?>
                                    </span>
                                </a>
                            </li>

                            <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="notification cart-count">
                                        <?php

                                        if (Session::has('customer_id')) {

                                            $customerId = Session::get('customer_id');
                                            $checkDeliveryCart = App\Models\DeliveryCart::where('customer_id', $customerId)->get();
                                            $checkDispenseryCart = App\Models\DispensaryCart::where('customer_id', $customerId)->count();
                                            $dealsClaimed = App\Models\DealsClaimed::where('customer_id', $customerId)->count();

                                            $sum = $checkDeliveryCart->sum('qty') + $checkDispenseryCart + $dealsClaimed;
                                            echo $sum;
                                        } else {
                                            echo 0;
                                        }
                                        ?>
                                    </span>
                                    @if(Session::has('customer_id'))
                                        <span style="display: none" class="dealsClaimedCount">
                                        @php
                                            $dealsClaimed = App\Models\DealsClaimed::where('customer_id', $customerId)->count();
                                        @endphp
                                            @if($dealsClaimed > 0)
                                                {{ $dealsClaimed }}
                                            @else
                                                0
                                            @endif
                                    </span>
                                    @endif

                                </a>
                            </li>


                            @if (Session::has('customer_id') == false)
                                <li style="list-style: none"><a class="nav-link" style="background: #f8971c;
                                color: #fff;
                                border-radius: 20px;
                                padding: 0.3rem 0.7rem;
                                font-size: 0.9rem;
                                margin-right: 10px" href="{{ route('signin') }}">Sign In</a></li>
                            @endif

                            @if (Session::has('customer_id') == false)
                                <li style="list-style: none"><a class="nav-link" style="background: #f8971c;
                                color: #fff;
                                border-radius: 20px;
                                padding: 0.3rem 0.7rem;
                                font-size: 0.9rem;" href="{{ route('signup') }}">Sign Up</a></li>
                            @endif

                        </ul>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('dispensaries') }}">Dispensaries</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('deliveries') }}">Deliveries</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a href="{{ route('desktop-map') }}">Maps</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('brands') }}">Brands</a>
                        </li>

                        <li class="mobileIconsList hambergerSubMenuItems">
                            <a class="nav-link" href="{{ route('deals') }}">Deals</a>
                        </li>

                        {{--                        <li class="mobileIconsList hambergerSubMenuItems">--}}
                        {{--                            <a class="nav-link" href="{{ route('strains') }}">Strains</a>--}}
                        {{--                        </li>--}}
                    </ul>

                    @if (Session::has('customer_id') == false)
                        <li class="mobileIconsList hambergerSubMenuItems"><a class="nav-link"
                                                                             href="{{ route('signin') }}">Sign in</a>
                        </li>
                    @else
                        <li class="dropdown userAuthDropdown customer-dropdown"><a
                                href="{{ route('profile') }}"><span><i class="fas fa-user-circle"
                                                                       style="font-size: 25px;"></i></span> <i
                                    class="bi bi-chevron-down"></i></a>

                            <ul>
                                <li><a href="{{ route('profile') }}">View Account</a></li>
                                <li><a href="{{ route('accountsettings') }}">Account Settings</a></li>
                                <li><a href="{{ route('favorites') }}">Favorites</a></li>
                                <li><a href="{{ route('recentlyviewed') }}">Recently Viewed</a></li>
                                @php
                                    $business = \App\Models\Business::where('email',session('customer_email'))->where('email', '!=', null)->where('approve', 1)->first();
                                @endphp
                                @if($business)
                                    <hr>
                                    <li>
                                        @if(env('APP_ENV') === "local")
                                            <a href="http://127.0.0.1:8002/redirect-to-brands/{{ $business->id }}"
                                            >Manage My Business</a>
                                        @else
                                            <a href="http://brands.420finder.net/redirect-to-brands/{{ $business->id }}"
                                            >Manage My Business</a>

                                        @endif
                                    </li>
                                @endif
                                <hr>
                                <li><a href="{{ route('logout') }}"
                                       onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                            </ul>
                        </li>
                    @endif

                </ul>


            </div>
        </div>
    </div>

    {{-- MOBILE NAV --}}
    <div class="container mobile-nav-container">
        <div class="logo-icons-wrap d-flex align-items-center row">
            <div class="col-4">
                <div class="menu-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24">
                        <path fill="#252935" fill-rule="evenodd" clip-rule="evenodd"
                              d="M4 8a1 1 0 0 1 0-2h16a1 1 0 1 1 0 2H4Zm0 5a1 1 0 1 1 0-2h16a1 1 0 1 1 0 2H4Zm-1 4a1 1 0 0 0 1 1h16a1 1 0 1 0 0-2H4a1 1 0 0 0-1 1Z"></path>
                    </svg>
                </div>
            </div>

            <div class="col-4">
                <div class="menu-logo mobile-logo">
                    <div class="site-logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('assets/img/logo.png') }}" alt=""
                                                            class="img-fluid" width="100px" height="100px"></a>
                    </div>
                </div>
            </div>

            <div class="col-4 notify-icons">
                <ul class="d-flex justify-content-end">

                    <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                        <a class="nav-link" href="{{ route('notifications') }}">
                            <i class="fas fa-bell"></i>
                            <span class="notification">{{ $notifications->count() }}</span>
                        </a>
                    </li>

                    <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                        <a class="nav-link" href="{{ route('favorites') }}">
                            <i class="fas fa-heart"></i>
                            <span class="notification">
                                <?php
                                $checkfavs = App\Models\Favorite::where('customer_id', session('customer_id'))->count();
                                echo $checkfavs;
                                ?>
                            </span>
                        </a>
                    </li>

                    <li class="mobileIconsList desktop-li" style="border-bottom: none;">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="notification cart-count">
                                <?php

                                if (Session::has('customer_id')) {

                                    $customerId = Session::get('customer_id');
                                    $checkDeliveryCart = App\Models\DeliveryCart::where('customer_id', $customerId)->get();
                                    $checkDispenseryCart = App\Models\DispensaryCart::where('customer_id', $customerId)->count();
                                    $dealsClaimed = App\Models\DealsClaimed::where('customer_id', $customerId)->count();

                                    $sum = $checkDeliveryCart->sum('qty') + $checkDispenseryCart + $dealsClaimed;
                                    echo $sum;
                                } else {
                                    echo 0;
                                }
                                ?>
                            </span>

                            @if(Session::has('customer_id'))
                                <span style="display: none" class="dealsClaimedCount">
                                @php
                                    $dealsClaimed = App\Models\DealsClaimed::where('customer_id', $customerId)->count();
                                @endphp
                                    @if($dealsClaimed > 0)
                                        {{ $dealsClaimed }}
                                    @else
                                        0
                                    @endif
                            </span>
                            @endif

                        </a>
                    </li>

                </ul>


            </div>

        </div>

        <div class="container">
            <div class="menu-search-bar">
                <form action="{{ route('search') }}" method="GET">

                    <div class="row product-location-wrap">

                        <div class="col-6 d-flex align-items-center search-product-wrap px-0">
                                    <span class="searchIcon">
                                        <i class="fas fa-search"></i>
                                    </span>

                            <div class="search-product">
                                <input type="text" name="keyword" placeholder="Products, retailers, brands, and more"
                                       class="mobile-search-product-input">
                            </div>
                        </div>

                        <div class="col-6 px-0">
                            <div id="mobileCurrentLocation" class="d-flex location-wrap">

                                <span id="getcurrentlocation" class="btn btn-sm location-icon"
                                      onclick="getLocation()"><i class="fas fa-map-marker-alt"></i></span>

                                {{-- <span id="mobileLocationBox" class="locationBox"> --}}
                                <span class="locationBox mobileInput">
                                            {{-- <input type="text" id="mobile_search_input" value="Los Angeles, California, USA" placeholder="Type address..." class="mobile-search-location-input"/> --}}
                                            <input type="text" value="Los Angeles, California, USA"
                                                   placeholder="Type address..." class="mobile-search-location-input"/>
                                            {{-- <input type="hidden" id="mobile_loc_lat" />
                                            <input type="hidden" id="mobile_loc_long" /> --}}
                                        </span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>


    </div>

    {{-- MOBILE SEARCH MENU --}}
    <div class="search-menu">
        <mobilesearch-component logo="{{ asset("assets/img/logo.png") }}"></mobilesearch-component>
    </div>

    {{-- MOBILE SIDE MENU --}}
    <div class="side-menu">
        <div class="side-menu-backdrop"></div>
        <div class="side-menu-content">

            @if(Session::has('customer_id') == true)
            @else
                <div class="side-menu-btns">
                    <a href="{{ route('signin') }}">
                        SIGN IN
                    </a>
                    <a href="{{ route('signup') }}">
                        SIGN UP
                    </a>
                </div>
            @endif

            <ul>
                <li>
                    <a href="{{ route('dispensaries') }}">
                        <i class="bi bi-shop"></i>
                        Dispensaries
                    </a>
                </li>

                <li>
                    <a href="{{ route('deliveries') }}">
                        <i class="bi bi-truck"></i>
                        Deliveries</a>
                </li>

                <li>
                    <a href="{{ route('desktop-map') }}">
                        <i class="bi bi-map"></i>
                        Maps</a>
                </li>

                <li>
                    <a href="{{ route('brands') }}">
                        <i class="bi bi-check-circle"></i>
                        Brands</a>
                </li>

                <li>
                    <a href="{{ route('products.index') }}">
                        <i class="bi bi-check-circle"></i>
                        Products</a>
                </li>

                <li>
                    <a href="{{ route('deals') }}">
                        <i class="bi bi-tag"></i>
                        Deals</a>
                </li>


                @if (Session::has('customer_id') == false)
                @else
                    <li class="dropdown userAuthDropdown customer-dropdown customer-dropdown-mobile"><a
                            href="#"><span><i class="fas fa-user-circle" style="font-size: 25px;"></i></span> <i
                                class="bi bi-chevron-down"></i></a>

                        <ul>
                            <li><a href="{{ route('profile') }}">View Account</a></li>
                            <li><a href="{{ route('accountsettings') }}">Account Settings</a></li>
                            <li><a href="{{ route('favorites') }}">Favorites</a></li>
                            <li><a href="{{ route('recentlyviewed') }}">Recently Viewed</a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
                        </ul>
                    </li>
                @endif

                <li class="mb-site-logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Site Logo">
                    </a>
                </li>

            </ul>
        </div>
    </div>

</header>
