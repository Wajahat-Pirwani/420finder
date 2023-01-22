@extends('layouts.app')
  <?php
     $loc = "Marijuana Listings in " . "$location";
  ?>
  @section('title', $loc)

  @section('content')

  <style>
    /*#Map{
        filter: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="g"><feColorMatrix type="matrix" values="0.3 0.3 0.3 0 0 0.3 0.3 0.3 0 0 0.3 0.3 0.3 0 0 0 0 0 1 0"/></filter></svg>#g');
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
        filter: progid:DXImageTransform.Microsoft.BasicImage(grayScale=1);
    }*/
    #showbusinesses {
        display: none;
    }
    /*#searchthisarea {
        margin-top: 10px;
    }*/
    #searchthisarea {
        position: absolute;
        top: 18%;
        right: 37%;
        width: 15%;
    }
    #searchthisarea span {
        position: absolute;
        right: 24%;
        border-radius: 8px;
        background: #f8971c;
        color: white;
        padding: 10px 16px;
        box-shadow: 4px 4px 8px silver;
        font-size: 12px;
    }
    #mapCanvas {
        width: 100%;
        height: 650px;
    }
    #retailersAll {
      background: white;
      position: absolute;
      top: 15rem;
      left: 0.5rem;
      width: 375px;
      height: 65%;
      overflow-y: scroll;
      overflow-x: hidden;
    }
    footer#footer {
      display: none;
    }
    #dealsAll {
      background: white;
      position: absolute;
      top: 18rem;
      right: 4rem;
      width: 300px;
    }
    ul.list-unstyled.d-flex.ratings .fa {
      color: #FBAC24;
    }
    ul.list-unstyled.d-flex.ratings li, .reviewCount {
      font-size: 12px;
    }
    .mapSearchFiltersOnMobile {
      display: none;
    }
    @media(max-width: 980px) {
      .hideMarijuanaListingOnMobile {
        display: none;
      }
      .mapSearchFiltersOnMobile {
        display: block;
      }
      .mapSearchFiltersOnMobile a {
          text-align: center;
          font-size: 9px;
          margin-top: 0 !important;
      }
      .mapSearchFilters {
        display: none;
      }
      .mapTopSection {
        height: 140px !important;
      }
      .mapTopSection {
          margin: 0 !important;
          padding-top: 5px;
      }
      #searchthisarea {
          position: absolute;
          top: 29%;
          right: -12%;
          width: 71%;
      }
        #showbusinesses {
            display: block;
        }
        div#locationOptions {
            position: absolute;
            bottom: -46px;
            background: white;
            padding: 20px 0;
            z-index: 999;
            height: 300px;
            overflow-y: scroll;
        }
        #dealsAll {
            display: none;
        }
        #retailersAll {
            /*width: 250px;
            height: 250px;
            top: 28rem;*/
            display: none;
        }
        .mapSearchFilters .col-md-12 {
            text-align: center;
        }

        .mapSearchFilters a {
            font-size: 10px;
            margin-right: 0px !important;
            margin-bottom: 10px;
        }
    }
  </style>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxwjOXvOkYjK2qU5J7sbmvIp08JCNCy2g"></script>

  <section class="fiveCols mt-4 pb-2 mapTopSection" style="background: white;width: 375px;margin-left: 8px;height: 200px;font-size: 12px;margin-top: 40px !important;">
      <div class="container-fluid pt-5">
        <div class="row">
          <div class="col-md-12">
            <nav class="mapBreadcrumbs pt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $location }}</li>
              </ol>
            </nav>
            <div class="row mt-2 mapSearchFiltersOnMobile text-center">
              <div class="col-md-12">
                <a href="{{ route('maps') }}" class="primary-bg text-white br-30 btn shadow-sm me-2">All</a>
                <a href="{{ route('mapfilter', ['keyword' => 'Dispensary']) }}" class="primary-bg text-white br-30 btn shadow-sm me-2">Dispensaries</a>
                <a href="{{ route('mapfilter', ['keyword' => 'Delivery']) }}" class="primary-bg text-white br-30 btn shadow-sm me-2">Deliveries</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center" id="locationOptions">
            <div class="col-md-12 hideMarijuanaListingOnMobile">
              <h4 class="mapLocations mb-0" style="font-size: 12px;"><strong>Marijuana Listings </strong> in {{ $location }}</h4>
            </div>
            <div class="row mt-2 mapSearchFilters">
              <div class="col-md-12">
                <a href="{{ route('maps') }}" class="primary-bg text-white br-30 btn shadow-sm me-2">All</a>
                <a href="{{ route('mapfilter', ['keyword' => 'Dispensary']) }}" class="primary-bg text-white br-30 btn shadow-sm me-2">Dispensaries</a>
                <a href="{{ route('mapfilter', ['keyword' => 'Delivery']) }}" class="primary-bg text-white br-30 btn shadow-sm me-2">Deliveries</a>
              </div>
            </div>
            <div id="showbusinesses">
                <div class="row p-3">
                    @if($businesses->count() > 0)
                      @foreach($businesses as $business)
                      <div class="col-md-12 border-bottom pb-3 mb-3 mainbusinesslistings">
                        <div class="row viewbusinessdetail" rel="{{ $business->id }}" style="cursor: pointer;">
                          <div class="col-md-4 col-4">
                            @if($business->profile_picture == '')
                              <img src="{{ asset('dummy.png') }}" alt="" class="w-100 img-thumbnail">
                            @else
                              <img src="{{ $business->profile_picture }}" alt="" class="w-100 img-thumbnail">
                            @endif

                          </div>
                          <div class="col-md-8 col-8">
                            <div>
                              <p class="mb-1">
                                <strong>
                                  <?php

                                    if (empty($business->business_name)) {
                                      $bname = $business->business_type;
                                    } else {
                                      $bname = $business->business_name;
                                    }

                                  ?>
                                  {{ $bname }}
                                </strong>
                              </p>
                              <?php
                                  $reviews = App\Models\RetailerReview::where('retailer_id', $business->id)->get();
                              ?>

                              <ul class="list-unstyled d-flex ratings mb-0">
                                  <?php

                                      if (count($reviews) > 0) {

                                          $sum = 0;
                                          foreach ($reviews as $review) {

                                              $sum = $sum + $review->rating;

                                          }
                                          $totalratings = $sum / $reviews->count();

                                      } else {
                                          $totalratings = 0;
                                      }

                                      if ($totalratings < 1) {
                                          echo '
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings <= 1) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 1 AND $totalratings <=2) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 2 AND $totalratings <=3) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 3 AND $totalratings <=4) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 4 AND $totalratings <=5) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          ';
                                      }

                                      echo " <span class='reviewCount'>(".$reviews->count().")</span>";

                                  ?>
                              </ul>
                              <p class="text-black-50 mb-1" style="font-size: 14px;">{{ $business->business_type }}</p>
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 12px;">
                                Order Online
                              </span><br>
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 12px;">
                                <?php
                                    if ($business->opening_time >= date('h:i') OR $business->closing_time <= date('h:i')) {
                                        echo "Open now!";
                                    } else {
                                        echo "Closed. Opens at " . $business->opening_time;
                                    }
                                ?>
                              </span>
                              {{-- @if($business->business_type == 'Dispensary')

                                @if($business->order_online == 1)
                                  <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                    Order Online
                                  </span>
                                @else
                                  <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                    In Store Purchase
                                  </span>
                                @endif

                              @elseif($business->business_type == 'Delivery')

                                @if($business->delivery == 1)
                                  <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                    Call on Order
                                  </span>
                                @else
                                  <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                    Order Online
                                  </span>
                                @endif

                              @endif --}}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <?php
                              if (empty($business->business_name)) {
                                $name = $business->business_type;
                              } else {
                                $name = $business->business_name;
                              }
                            ?>
                            @if($business->business_type == 'Dispensary')
                              <a href="{{ route('dispensarysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}" class="btn w-100 border mt-3">View Menu</a>
                            @elseif($business->business_type == 'Delivery')
                              <a href="{{ route('deliverysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}" class="btn w-100 border mt-3">View Menu</a>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div id="businessdetailbox" class="row" style="display: none;">
                        <div class="col-md-12 mb-3">
                          <span id="backtoresults" style="cursor: pointer;">
                            <strong>< back to results</strong>
                          </span>
                        </div>
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-4">
                              <img id="businessPicture" src="{{ asset('dummy.png') }}" class="w-100 img-thumbnail" style="height: 95px;width: 95px;">
                            </div>
                            <div class="col-8">
                              <div>
                              <p class="mb-1">
                                <strong id="businessname">
                                </strong>
                              </p>
                              <p id="business_type" class="text-black-50 mb-1" style="font-size: 14px;"></p>
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 12px;">
                                Order Online
                              </span>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 text-center my-3">
                          <a id="businesscontact" href="" style="border: 1px solid silver;padding: 5px;border-radius: 50%;display: inline-grid;" class="me-2">
                            <i class="fas fa-phone-alt"></i>
                          </a>
                          <a id="businessemail" href="" style="border: 1px solid silver;padding: 5px;border-radius: 50%;display: inline-grid;" class="me-2">
                            <i class="fas fa-envelope"></i>
                          </a>
                          <a id="businessreviews" href="" style="border: 1px solid silver;padding: 5px;border-radius: 50%;display: inline-grid;" class="me-2">
                            <i class="fas fa-star"></i>
                          </a>
                        </div>
                        <div class="col-md-12 border-top pt-3">
                          <h5 class="pb-3"><strong>Hours of operations</strong></h5>
                          <div class="row">
                            <div class="col-md-6">
                              <strong>Monday</strong><br>
                              <strong>Tuesday</strong><br>
                              <strong>Wednesday</strong><br>
                              <strong>Thursday</strong><br>
                              <strong>Friday</strong><br>
                              <strong>Saturday</strong><br>
                              <strong>Sunday</strong>
                            </div>
                            <div class="col-md-6">
                              <span class="opening_time"></span> - <span class="closing_time"></span><br>
                              <span class="opening_time"></span> - <span class="closing_time"></span><br>
                              <span class="opening_time"></span> - <span class="closing_time"></span><br>
                              <span class="opening_time"></span> - <span class="closing_time"></span><br>
                              <span class="opening_time"></span> - <span class="closing_time"></span><br>
                              <span class="opening_time"></span> - <span class="closing_time"></span><br>
                              <span class="opening_time"></span> - <span class="closing_time"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <a id="viewbusinessmenu" href="" class="btn w-100 border mt-3">View Menu</a>
                        </div>
                      </div>
                      @endforeach
                      <div class="row">
                        <div class="col-6">
                          <a href="{{ route('dispensaries') }}" class="btn w-100 border mt-3" style="font-size: 10px;">View All Dispensaries</a>
                        </div>
                        <div class="col-6">
                          <a href="{{ route('deliveries') }}" class="btn w-100 border mt-3" style="font-size: 10px;">View All Deliveries</a>
                        </div>
                      </div>
                    @else
                      <div class="col-md-12 text-center">
                        No results found.
                      </div>
                    @endif
                </div>
            </div>
        </div>
      </div>
  </section>

  <div id="container">

    <article class="entry">

      <div class="entry-content">

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

        <script type="text/javascript">
            var contentstring = [];
            var regionlocation = [];
            var markers = [];
            var iterator = 0;
            var areaiterator = 0;
            var map;
            var infowindow = [];
            var businesstype = [];
            geocoder = new google.maps.Geocoder();

            $(document).ready(function () {
                setTimeout(function() { initialize(); }, 400);
            });

            function initialize() {
                infowindow = [];
                markers = [];
                GetValues();
                iterator = 0;
                areaiterator = 0;

                var myStyles =[
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#a7a7a7"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#737373"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#efefef"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#dadada"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#696969"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#b3b3b3"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#d6d6d6"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#ffffff"
                            },
                            {
                                "weight": 1.8
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#d7d7d7"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#808080"
                            },
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#d3d3d3"
                            }
                        ]
                    }
                ];

                region = new google.maps.LatLng(regionlocation[areaiterator].split(',')[0], regionlocation[areaiterator].split(',')[1]);
                map = new google.maps.Map(document.getElementById("Map"), {
                    zoom: 12,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: region,
                    styles: myStyles,
                });
                drop();
            }

            function GetValues() {

              <?php

                foreach ($businesses as $inc => $business) {

                  $plc_name = $business->address_line_1;
                  $plc_loc = $business->business_name;
                  $lat =  $business->latitude;
                  $lng =  $business->longitude;
                  $string = "contentstring[" . $inc . "]";
                  $region = "regionlocation[" . $inc . "]";
                  $businesstype = "businesstype[" . $inc . "]";

                  ?><?php echo $string; ?> = "<?php echo $plc_loc; ?>";
                  <?php echo $businesstype; ?> = "<?php echo $business->business_type; ?>";
                  <?php echo $region; ?> = '<?php echo $lat; ?>, <?php echo $lng; ?>';<?php

                }

                if (count($stores) > 0) {
                  foreach($stores as $i => $store) {
                    $new = $i + $inc;
                    $string = "contentstring[" . $new . "]";
                    $region = "regionlocation[" . $new . "]";

                  ?><?php echo $string; ?> = "<?php echo $store->store_name; ?>";
                  <?php echo $region; ?> = '<?php echo $store->latitude; ?>, <?php echo $store->longitude; ?>';<?php

                  }
                }

              ?>

            }

            function drop() {
                for (var i = 0; i < contentstring.length; i++) {
                    setTimeout(function() {
                        addMarker();
                    }, 800);
                }
            }




            function addMarker() {

              console.log(businesstype);

                // var address = contentstring[areaiterator];
                // if(areaiterator % 2 == 0) {
                //   var icons = "{{ asset('images/icons/icondelivery.png') }}";
                // } else {
                //   var icons = "{{ asset('images/icons/icondispensary.png') }}";
                // }

                var address = contentstring[areaiterator];
                if(businesstype == 'Delivery') {
                  var icons = "{{ asset('images/icons/icondelivery.png') }}";
                } else if(businesstype == 'Dispensary') {
                  var icons = "{{ asset('images/icons/icondispensary.png') }}";
                } else {
                  if(areaiterator % 2 == 0) {
                    var icons = "{{ asset('images/icons/icondelivery.png') }}";
                  } else {
                    var icons = "{{ asset('images/icons/icondispensary.png') }}";
                  }
                }

                // var icons = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';

                var templat = regionlocation[areaiterator].split(',')[0];
                var templong = regionlocation[areaiterator].split(',')[1];
                var temp_latLng = new google.maps.LatLng(templat, templong);
                // console.log("val: " + areaiterator);
                markers.push(new google.maps.Marker(
                {
                    position: temp_latLng,
                    map: map,
                    icon: icons,
                    draggable: false
                }));
                iterator++;
                info(iterator);
                areaiterator++;
            }

            function info(i) {
                infowindow[i] = new google.maps.InfoWindow({
                    content: contentstring[i - 1]
                });
                infowindow[i].content = contentstring[i - 1];
                google.maps.event.addListener(markers[i - 1], 'click', function() {
                    for (var j = 1; j < contentstring.length + 1; j++) {
                        infowindow[j].close();
                    }
                    infowindow[i].open(map, markers[i - 1]);
                });
            }
        </script>
        @if(count($businesses) > 0)
          <div id="mapWithRetailer">
            <div id="Map" style="width: 100%; height: 750px;position:absolute;width:100%;min-height:100%;top:0px;left:0px;z-index:-1;"></div>
            <div id="searchthisarea">
              <span>SEARCH THIS AREA</span>
            </div>
            <div id="retailersAll">
              <div class="row p-3">
                @if($businesses->count() > 0)
                  @foreach($businesses as $business)
                  <div class="col-md-12 border-bottom pb-3 mb-3 mainbusinesslistings">
                    <div class="row viewbusinessdetail" rel="{{ $business->id }}" style="cursor: pointer;">
                      <div class="col-md-4 col-4">
                        @if($business->profile_picture == '')
                          <img src="{{ asset('dummy.png') }}" alt="" class="w-100 img-thumbnail">
                        @else
                          <img src="{{ $business->profile_picture }}" alt="" class="w-100 img-thumbnail">
                        @endif

                      </div>
                      <div class="col-md-8 col-8">
                        <div>
                          <p class="mb-1">
                            <strong>
                              <?php

                                if (empty($business->business_name)) {
                                  $bname = $business->business_type;
                                } else {
                                  $bname = $business->business_name;
                                }

                              ?>
                              {{ $bname }}
                            </strong>
                          </p>
                          <?php
                              $reviews = App\Models\RetailerReview::where('retailer_id', $business->id)->get();
                          ?>

                          <ul class="list-unstyled d-flex ratings mb-0">
                              <?php

                                  if (count($reviews) > 0) {

                                      $sum = 0;
                                      foreach ($reviews as $review) {

                                          $sum = $sum + $review->rating;

                                      }
                                      $totalratings = $sum / $reviews->count();

                                  } else {
                                      $totalratings = 0;
                                  }

                                  if ($totalratings < 1) {
                                      echo '
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                      ';
                                  } elseif ($totalratings <= 1) {
                                      echo '
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                      ';
                                  } elseif ($totalratings > 1 AND $totalratings <=2) {
                                      echo '
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                      ';
                                  } elseif ($totalratings > 2 AND $totalratings <=3) {
                                      echo '
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                      ';
                                  } elseif ($totalratings > 3 AND $totalratings <=4) {
                                      echo '
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="far fa-star"></i></a></li>
                                      ';
                                  } elseif ($totalratings > 4 AND $totalratings <=5) {
                                      echo '
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star"></i></a></li>
                                      ';
                                  }

                                  echo " <span class='reviewCount'>(".$reviews->count().")</span>";

                              ?>
                          </ul>
                          <p class="text-black-50 mb-1" style="font-size: 14px;">{{ $business->business_type }}</p>
                          <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 12px;">
                            Order Online
                          </span><br>
                          <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 12px;">
                            <?php
                                if ($business->opening_time >= date('h:i') OR $business->closing_time <= date('h:i')) {
                                    echo "Open now!";
                                } else {
                                    echo "Closed. Opens at " . $business->opening_time;
                                }
                            ?>
                          </span>
                          {{-- @if($business->business_type == 'Dispensary')

                            @if($business->order_online == 1)
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                Order Online
                              </span>
                            @else
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                In Store Purchase
                              </span>
                            @endif

                          @elseif($business->business_type == 'Delivery')

                            @if($business->delivery == 1)
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                Call on Order
                              </span>
                            @else
                              <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 10px;">
                                Order Online
                              </span>
                            @endif

                          @endif --}}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <?php
                          if (empty($business->business_name)) {
                            $name = $business->business_type;
                          } else {
                            $name = $business->business_name;
                          }
                        ?>
                        @if($business->business_type == 'Dispensary')
                          <a href="{{ route('dispensarysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}" class="btn w-100 border mt-3">View Menu</a>
                        @elseif($business->business_type == 'Delivery')
                          <a href="{{ route('deliverysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}" class="btn w-100 border mt-3">View Menu</a>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div id="businessdetailbox" class="row" style="display: none;">
                    <div class="col-md-12 mb-3">
                      <span id="backtoresults" style="cursor: pointer;">
                        <strong>< back to results</strong>
                      </span>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-4">
                          <img id="businessPicture" src="{{ asset('dummy.png') }}" class="w-100 img-thumbnail" style="height: 95px;width: 95px;">
                        </div>
                        <div class="col-8">
                          <div>
                          <p class="mb-1">
                            <strong id="businessname">
                            </strong>
                          </p>
                          <p id="business_type" class="text-black-50 mb-1" style="font-size: 14px;"></p>
                          <span class="bg-light me-2 text-dark px-2 py-1 shadow-sm" style="font-size: 12px;">
                            Order Online
                          </span>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center my-3">
                      <a id="businesscontact" href="" style="border: 1px solid silver;padding: 5px;border-radius: 50%;display: inline-grid;" class="me-2">
                        <i class="fas fa-phone-alt"></i>
                      </a>
                      <a id="businessemail" href="" style="border: 1px solid silver;padding: 5px;border-radius: 50%;display: inline-grid;" class="me-2">
                        <i class="fas fa-envelope"></i>
                      </a>
                      <a id="businessreviews" href="" style="border: 1px solid silver;padding: 5px;border-radius: 50%;display: inline-grid;" class="me-2">
                        <i class="fas fa-star"></i>
                      </a>
                    </div>
                    <div class="col-md-12 border-top pt-3">
                      <h5 class="pb-3"><strong>Hours of operations</strong></h5>
                      <div class="row">
                        <div class="col-md-6">
                          <strong>Monday</strong><br>
                          <strong>Tuesday</strong><br>
                          <strong>Wednesday</strong><br>
                          <strong>Thursday</strong><br>
                          <strong>Friday</strong><br>
                          <strong>Saturday</strong><br>
                          <strong>Sunday</strong>
                        </div>
                        <div class="col-md-6">
                          <span class="opening_time"></span> - <span class="closing_time"></span><br>
                          <span class="opening_time"></span> - <span class="closing_time"></span><br>
                          <span class="opening_time"></span> - <span class="closing_time"></span><br>
                          <span class="opening_time"></span> - <span class="closing_time"></span><br>
                          <span class="opening_time"></span> - <span class="closing_time"></span><br>
                          <span class="opening_time"></span> - <span class="closing_time"></span><br>
                          <span class="opening_time"></span> - <span class="closing_time"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <a id="viewbusinessmenu" href="" class="btn w-100 border mt-3">View Menu</a>
                    </div>
                  </div>
                  @endforeach
                  <div class="row">
                    <div class="col-6">
                      <a href="{{ route('dispensaries') }}" class="btn w-100 border mt-3" style="font-size: 10px;">View All Dispensaries</a>
                    </div>
                    <div class="col-6">
                      <a href="{{ route('deliveries') }}" class="btn w-100 border mt-3" style="font-size: 10px;">View All Deliveries</a>
                    </div>
                  </div>
                @else
                  <div class="col-md-12 text-center">
                    No results found.
                  </div>
                @endif
              </div>
            </div>


  <style>
    .navLinks {
      display: flex;
    }
    .navLinks button {
      position: unset;
      background: black;
    }
    .carousel-control-next, .carousel-control-prev {
      width: 10% !important;
    }
    button.carousel-control-prev {
      margin-right: 2px;
    }
  </style>


            <div id="dealsAll">
              <div class="row p-3">
                <div class="col-md-12">

                  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="navLinks justify-content-end pe-2 pb-2">
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                    <div class="carousel-inner">
                      @if($deals->count() > 0)
                        @foreach($deals as $index => $deal)
                        <div class="carousel-item @if($index == 0) active @else @endif">
                          @if($deal->picture == '')
                            <img src="{{ asset('dummy.png') }}" alt="" class="d-block w-100">
                          @else
                            <img src="{{ $deal->picture }}" alt="" class="d-block w-100">
                          @endif
                          <p class="mb-0"><strong>{{ $deal->title }}</strong></p>
                          <p class="text-black-50 mb-1" style="font-size: 10px;">{{ $deal->description }}</p>
                        </div>
                        @endforeach
                      @else
                        <div class="col-md-12 text-center">
                          No results found.
                        </div>
                      @endif
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        @else
          <div class="container">
            <div class="row">
              <div class="col-6 offset-3 shadow pt-5 pb-5 mb-5 text-center" style="border-top: 5px solid #f8971c;">
                <div>
                  <i class="fas fa-map-marker-alt fa-3x mb-4"></i>
                </div>
                <p><strong>No Retailers Found in your area.</strong></p>
              </div>
            </div>
          </div>
        @endif

      </div><!-- .entry-content -->

    </article>

  </div><!-- #container -->
@endsection
