<template>
    <div class="mobile-v-form">
        <div class="row search-logo-wrap v-mobile-pad">
            <div class="col-4 close-btn">
                <div class="close-btn">
                    <h6 class="close-btn-text">Cancel</h6>
                </div>
            </div>
            <div class="col-4">
                <div class="logo-btn">
                    <img :src="logo" onerror="this.src='https://420finder.net/assets/img/logo01.png'" alt="Search Menu Logo">
                </div>
            </div>
            <div class="col-4">
                <div class="search-btn">
                    <h6>Search</h6>
                </div>
            </div>
        </div>
        <div class="form-wrap search-menu-form v-mobile-pad">
            <form action="">
                <div class="product-search">
                    <input type="text" name="" placeholder="Products, retailors, brands and more"
                           class="search-menu-form-input" autocomplete="off" v-model="searchQuery"
                           @focus="productSearch = true">
                </div>
            </form>
            <form action="">
                <div class="location-search v-location-search" id="mobileLocationBox">
                    <!-- <input type="text" name="" placeholder="Los Angeles, CA" class="search-menu-form-input" id="mobile_search_input" ref="autocomplete"> -->
                    <input type="text" name="" placeholder="Los Angeles, CA" class="search-menu-form-input"
                           v-model="geometrySearch" @focus="emptyValue">
                </div>
            </form>
        </div>
        <!-- PRODUCT RESULTS -->
        <div class="v-product-results" v-if="productSearch">
            <div class="search-query">
                <h5 v-if="searchQuery.length >= 2">Search results for "{{ searchQuery }}"</h5>
            </div>
            <div v-if="loading" class="loading-spinner">
                <p><i class="fas fa-circle-notch fa-spin"></i></p>
            </div>
            <div v-else>
                <template v-if="productsResult.length > 0">
                    <a :href="product.product_route" class="search-result-link" v-for="product in productsResult"
                       :key="`${product.slug}-${product.id}`">
                        <div class="search-result-item">
                            <div class="search-result-item-img">
                                <img :src="product.image" onerror="this.src='https://420finder.net/assets/img/logo01.png'" alt="Search Item Img">
                            </div>
                            <div class="search-result-item-title">
                                <h5>{{ product.name }}</h5>
                                <p v-html="product.description"></p>
                            </div>
                        </div>
                    </a>
                </template>
                <template v-if="searchResult.length > 0">
                    <a :href="link(result.business_type, result.business_name, result.id, result.route_url)"
                       class="search-result-link" v-for="result in searchResult" :key="result.id">
                        <div class="search-result-item">
                            <div class="search-result-item-img">
                                <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                     :src="result.profile_picture" alt="Search Item Img">
                            </div>
                            <div class="search-result-item-title">
                                <h5>{{ result.business_name }}</h5>
                                <p>{{ result.address_line_1 }}</p>
                            </div>
                        </div>
                    </a>
                </template>
                <div
                    v-else-if="searchQuery.length >= 3 && searchResult.length < 1 && !loading &&productsResult.length < 1"
                    class="no-result-content">
                    <p>No results found</p>
                </div>
            </div>
        </div>
        <!-- LOCATION RESULTS -->
        <div class="v-location-results" v-else>
            <ul>
                <li class="current-location-btn d-flex align-items-center" @click="getUserCoordinates">
                    <div class="current-location-icon">
                        <svg class="wm-locate" width="20px" height="20px" viewBox="0 0 20 20">
                            <path
                                d="M10 6.364C7.99 6.364 6.364 7.99 6.364 10c0 2.01 1.627 3.636 3.636 3.636 2.01 0 3.636-1.627 3.636-3.636 0-2.01-1.627-3.636-3.636-3.636zm8.127 2.727C17.71 5.3 14.7 2.29 10.91 1.874V0H9.09v1.873C5.3 2.29 2.29 5.3 1.874 9.09H0v1.82h1.873c.418 3.79 3.427 6.8 7.218 7.217V20h1.82v-1.873c3.79-.418 6.8-3.427 7.217-7.218H20V9.09h-1.873zM10 16.365c-3.518 0-6.364-2.846-6.364-6.364S6.482 3.636 10 3.636 16.364 6.482 16.364 10 13.518 16.364 10 16.364z"
                                fill="#999999"></path>
                        </svg>
                    </div>
                    <div class="current-location-text">
                        <h6>Current Location</h6>
                    </div>
                </li>
                <li v-for="predict in predictions" :key="predict.place_id"
                    @click="getCoordinates(predict.place_id, predict.description)">
                <span>
                    <svg width="25px" height="25px" viewBox="0 0 24 24" class="location__SVG-sc-14zeeeh-0 gIxWzV"><path
                        fill="#a5a9b1"
                        d="M20 10.36c0 2.87-2.59 6.8-7.88 11.6a.18.18 0 0 1-.24 0C6.58 17.15 4 13.22 4 10.35 4 5.75 7.58 2 12 2s8 3.75 8 8.36Zm-8 3.78c1.84 0 3.33-1.6 3.33-3.57C15.33 8.6 13.84 7 12 7s-3.33 1.6-3.33 3.57c0 1.97 1.49 3.57 3.33 3.57Z"></path></svg>
                </span>
                    <span v-html="highlightQuery(predict.description)"></span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import ClickOutside from 'vue-click-outside';
export default {
    props: ['logo'],
    data() {
        return {
            key: 'AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8',
            locationInput: '',
            geometrySearch: 'Los Angeles, California, USA',
            predictions: [],
            selectedLat: '',
            selectedLng: '',
            productSearch: false,
            searchQuery: '',
            searchResult: [],
            loading: false,
            productsResult: [],
        }
    },
    watch: {
        geometrySearch: _.debounce(function (val) {
            if (val.length >= 2) {
                this.initService();
            }
        }, 300),
        searchQuery: _.debounce(function (val) {
            if (val.length >= 3) {
                this.cardVisible = true;
                this.getSearchResults(val)
            } else {
                this.cardVisible = false;
            }
        }, 500),
    },
    methods: {
        displaySuggestions(predictions, status) {
            if (status != google.maps.places.PlacesServiceStatus.OK || !predictions) {
                // alert(status);
                return;
            }
            this.predictions = predictions;
        },
        getCoordinates(predictionPlaceId, predictDescription) {
            this.geometrySearch = predictDescription;
            var map = new google.maps.Map(document.getElementById("map_canvas"));
            var request = {
                placeId: predictionPlaceId,
                fields: ['name', 'geometry']
            };
            let service = new google.maps.places.PlacesService(map);
            service.getDetails(request, callback);
            let that = this;
            function callback(place, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    that.selectedLat = place.geometry.location.lat();
                    that.selectedLng = place.geometry.location.lng();
                    that.getUserLocation();
                }
            }
        },
        highlightQuery(predictDescription) {
            var iQuery = new RegExp(this.geometrySearch, "ig");
            return predictDescription.toString().replace(iQuery, function (matchedTxt, a, b) {
                return ('<span class=\'highlight\'>' + matchedTxt + '</span>');
            });
        },
        changeToDefault() {
            this.geometrySearch = 'Los Angeles, California, USA';
        },
        emptyValue() {
            this.geometrySearch = "";
            this.productSearch = false;
        },
        getUserCoordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${position.coords.latitude},${position.coords.longitude}&key=${this.key}`;
                        var that = this;
                        $.get(url, function (data, status) {
                            that.geometrySearch = data.results[3].formatted_address;
                            that.selectedLat = position.coords.latitude;
                            that.selectedLng = position.coords.longitude;
                            that.getUserLocation();
                        });
                        this.cardVisible = false;
                    },
                    //   (error) => {
                    //     alert(error.message);
                    //   }
                );
            } else {
                alert("Your browser does not support geolocation API ");
            }
        },
        getUserLocation() {
            this.cardVisible = false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/getlocationforcurrentuser",
                method: "POST",
                data: {
                    lat: this.selectedLat,
                    lon: this.selectedLng
                },
                success: function (data) {
                    let response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        localStorage.removeItem("currentlocation");
                        localStorage.setItem("currentlocation", response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        },
        initService() {
            var sessionToken = new google.maps.places.AutocompleteSessionToken();
            // Pass the token to the autocomplete service.
            var autocompleteService = new google.maps.places.AutocompleteService();
            autocompleteService.getPlacePredictions({
                    input: this.geometrySearch,
                    sessionToken: sessionToken
                },
                this.displaySuggestions);
        },
        // ================ PRODUCT SEARCH =================
        link(businessType, business_name, businessId, routeUrl) {
            if (businessType == 'Delivery') {
                return `${routeUrl}/deliveries/${business_name}/${businessId}`;
            } else if (businessType == 'Dispensary') {
                return `${routeUrl}/dispensaries/${business_name}/${businessId}`;
            } else {
                return `${routeUrl}/brand/${business_name}/${businessId}`;
            }
        },
        getSearchResults(query) {
            this.loading = true;
            axios.post(`/api/products/search`, {
                'search': query
            }).then((response) => {
                this.loading = false;
                this.searchResult = response.data.businesses;
                this.productsResult = response.data.products;
            }).catch((err) => {
                this.loading = false;
            });
        },
        setGeometrySearch() {
            let currentLocation = localStorage.getItem('currentlocation');
            if (currentLocation !== null) {
                this.geometrySearch = currentLocation;
            } else {
                this.geometrySearch = 'Los Angeles, California, USA';
            }
        }
    },
    mounted() {
        this.setGeometrySearch();
        this.popupItem = this.$el;
    },
    directives: {
        ClickOutside
    }
}
</script>
<style scoped>
@import './css/mobile-search.css';
.v-product-results .search-query h5 {
    font-size: 0.8rem;
    font-weight: 600;
    color: #f8971c;
    padding-left: 1rem;
}
.v-product-results a.search-result-link {
    display: block;
}
.v-product-results a.search-result-link:hover {
    background-color: #F2F5F5;
}
.v-product-results a.search-result-link:hover h5 {
    color: #444;
}
.search-result-item {
    display: flex;
    padding-top: 0.5rem;
    padding-left: 1rem;
    padding-right: 0.5rem;
}
.search-result-item:last-child {
    padding-bottom: 0.8rem;
}
.search-result-item img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
}
.search-result-item-title {
    padding-left: 0.5rem;
    overflow: hidden;
}
.search-result-item-title h5 {
    font-size: 0.9rem;
    margin-bottom: 0;
    /* display: inline-block; */
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow-wrap: normal;
}
.search-result-item-title p {
    margin: 0;
    font-size: 0.9rem;
    color: rgb(124, 124, 124);
    display: inline-block;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow-wrap: normal;
}
.loading-spinner {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 80%;
}
.loading-spinner i {
    font-size: 2.2rem;
}
.no-result-content {
    padding: 1rem;
}
.no-result-content p {
    text-align: center;
}
</style>
