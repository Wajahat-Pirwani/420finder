<template>
    <div>
        <div class="container map-filter-wrap">
            <!-- LOCATION -->
            <div class="desktop-location-wrap">
                <div class="desktop-location-head">
                    <h3>Marijuana listings <span>{{ currentLocation }}</span></h3>
                </div>
            </div>
            <!-- DESKTOP MENU SWIPER -->
            <div class="desktop-menu-swiper desktop-map-swiper">
                <!-- OPEN NOW -->
                <div class="mobile-open-now">
                    <button class="desktop-map-btn-common" @click="openNow"
                            :class="{'desktop-btn-common-dark' : checkPropertyExists('opennow')}"
                    >Open now
                    </button>
                </div>
                <!-- STOREFRONT -->
                <div class="mobile-storefront">
                    <button class="desktop-map-btn-common" @click="checkStoreDelivery('storefront', 'Dispensary')"
                            :class="{'desktop-btn-common-dark' : checkPropertyValueExists('Dispensary')}">Storefronts
                    </button>
                </div>
                <!-- DELIVERY -->
                <div class="mobile-storefront">
                    <button class="desktop-map-btn-common" @click="checkStoreDelivery('storefront', 'Delivery')"
                            :class="{'desktop-btn-common-dark' : checkPropertyValueExists('Delivery')}">Delivery
                    </button>
                </div>
                <!-- ORDER ONLINE -->
                <div class="mobile-storefront">
                    <button class="desktop-map-btn-common" @click="orderOnline"
                            :class="{'desktop-btn-common-dark' : checkPropertyExists('orderonline')}">Order Online
                    </button>
                </div>
                <!-- BEST OF -->
                <div class="mobile-storefront">
                    <button class="desktop-map-btn-common" @click="bestOf"
                            :class="{'desktop-btn-common-dark' : checkPropertyExists('bestof')}">Top Ranked
                    </button>
                </div>
                <!-- LICENSE TYPE -->
                <!-- <div class="mobile-storefront">
                   <button class="desktop-map-btn-common">
                       License Type
                       <svg class="desktop-map-btn-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847" style="transform:rotate(0deg)"><path fill="currentColor" d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path></svg>
                   </button>
                </div> -->
                <!-- CURBSIDE PICKUP -->
                <!-- <div class="mobile-storefront">
                   <button class="desktop-map-btn-common">Curbside pickup</button>
                </div> -->
                <!-- PRODUCTS -->
                <div class="mobile-storefront map-products" v-click-outside="hideCategoryBox">
                    <button class="desktop-map-btn-common"
                            :class="{'desktop-btn-common-dark' : checkPropertyExists('category') || categoryToggle}"
                            @click="checkCategoryToggle">
                 <span>
                     Products
                </span>
                        <svg class="" width="10px" height="14px" viewBox="0 0 451.847 451.847">
                            <path fill="currentColor"
                                  d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                        </svg>
                    </button>
                    <template v-if="categoryToggle">
                        <div class="map-categories">
                            <div class="map-category-wrap row">
                                <MapCategory v-for="category in categories" :key="category.id" :category="category"
                                             @category="selectedCategory"
                                             :categoryBg="checkCategorySelected(category.id)"></MapCategory>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- AMENITIES -->
                <!-- <div class="mobile-storefront">
                   <button class="desktop-map-btn-common">Amenities</button>
                </div> -->
                <!-- SORT BY -->
                <!-- <div class="mobile-storefront">
                   <button class="desktop-map-btn-common">Sort by</button>
                </div> -->
            </div>
            <!-- MOBILE MENU SWIPER -->
            <div class="mobile-menu-swiper mobile-map-swiper">
                <!-- Category Dialog -->
                <DesktopMapDialog @close="closeCategoryModal" v-if="mobileProductDialog">
                    <product-categories @selected-item="selectedMobileCategories" @close="closeCategoryModal"
                                        @click="showCategoryModal" :category="categories"
                                        :selectedCategories="checkedCategories"
                                        @reset="removeCategoryKey"></product-categories>
                </DesktopMapDialog>
                <swiper ref="mySwiper" :options="swiperOptions">
                    <swiper-slide>
                        <!-- OPEN NOW -->
                        <div class="mobile-open-now">
                            <button class="mobile-map-btn-common" @click="openNow"
                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('opennow')}"
                            >Open now
                            </button>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <!-- STOREFRONT -->
                        <div class="mobile-storefront">
                            <button class="mobile-map-btn-common"
                                    @click="checkStoreDelivery('storefront', 'Dispensary')"
                                    :class="{'mobile-btn-common-dark' : checkPropertyValueExists('Dispensary')}">
                                Storefronts
                            </button>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <!-- DELIVERY -->
                        <div class="mobile-storefront">
                            <button class="mobile-map-btn-common" @click="checkStoreDelivery('storefront', 'Delivery')"
                                    :class="{'mobile-btn-common-dark' : checkPropertyValueExists('Delivery')}">Delivery
                            </button>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <!-- ORDER ONLINE -->
                        <div class="mobile-storefront">
                            <button class="mobile-map-btn-common" @click="orderOnline"
                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('orderonline')}">Order
                                Online
                            </button>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <!-- BEST OF -->
                        <div class="mobile-storefront">
                            <button class="mobile-map-btn-common" @click="bestOf"
                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('bestof')}">Top Ranked
                            </button>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <!-- PRODUCTS -->
                        <div class="mobile-storefront map-products">
                            <button class="mobile-map-btn-common"
                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('category')}"
                                    @click="showCategoryModal">
                 <span>
                     Products
                </span>
                                <svg class="" width="10px" height="14px" viewBox="0 0 451.847 451.847">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
            </div>
            <!-- MOBILE SWIPER BTNS ENDS -->
        </div>
        <div class="desktop-map">
            <template v-if="stores.length > 0">
                <div class="deals-slider">
                    <carousel :items="1" :dots="false" :nav="false" :autoplay="true" :loop="true">
                        <template slot="prev"><span class="prev slider-btn"><i class="fa fa-angle-left"></i></span>
                        </template>
                        <template slot="next"><span class="next slider-btn"><i class="fa fa-angle-right"></i></span>
                        </template>
                        <template v-for="store in stores">
                            <template v-if="store.deals.length > 0">
                                <a :href="`/deal/${deal.id}`" v-for="deal in store.deals" :key="deal.id">
                                    <div class="deals-item">
                                        <div class="deals-slider-item">
                                            <div class="deals-slider-item-img">
                                                <img :src="JSON.parse(deal.picture)[0]" alt="Deals Image">
                                                <div class="deals-slider-item-inner">
                                                    <img :src="store.profile_picture"  onerror="this.src='https://420finder.net/assets/img/logo01.png'" alt="Business Image">
                                                </div>
                                            </div>
                                            <!-- DEALS SLIDER BODY -->
                                            <div class="deals-slider-body">
                                                <!--                            <div class="deals-slider-item-cat">-->
                                                <!--                            <span>Storefront</span>-->
                                                <!--                        </div>-->
                                                <div class="deals-slider-item-title">
                                                    <h3>{{ deal.title }}</h3>
                                                </div>
                                                <div class="deals-slider-item-title">
                                                    <h3>$ {{ deal.deal_price }}</h3>
                                                </div>
                                                <div class="deals-slider-item-b-name">
                                                    <span>{{ store.business_name }}</span>
                                                </div>
                                                <div class="deals-slider-item-b-type">
                                                    <span>{{ store.business_type }}</span>
                                                </div>
                                                <!-- <div class="deals-slider-item-b-type">
                                                   <span>Medical Cultivation</span>
                                               </div> -->
                                                <div class="deals-slider-reviews">
                                                    <div class="record-item-reviews">
                                                        <div class="rating-icon">
                                                            <star-rating :increment="0.5" :read-only="true"
                                                                         :rating="ratingResolver(store.rating)"
                                                                         active-color="#f8971c" border-color="#f8971c"
                                                                         :star-size="15"
                                                                         :show-rating="false"></star-rating>
                                                        </div>
                                                        <div class="rating-avg">
                                                            <span>{{ ratingResolver(store.rating) }}</span>
                                                        </div>
                                                        <div class="rating-total">
                                                            <span>({{ store.reviews_count }})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- DEALS SLIDER BODY ENDS -->
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </template>
                    </carousel>
                </div>
            </template>
            <div class="map-container">
                <div id="map">
                </div>
                <button v-if="redoSearchBtnVisible" @click="getRecords(selectedFilters)" class="map-redo-btn">
                    Redo search in this area
                </button>
            </div>
            <!-- RECORDS -->
            <div class="desktop-map-records" :class="{ 'resize': resize }">
                <template v-if="recordFullCheck">
                    <div class="record-full">
                        <!-- MOBILE FILTERS -->
                        <div class="record-mobile-filters">
                            <!-- LOCATION -->
                            <div class="desktop-location-wrap">
                                <div class="desktop-location-head">
                                    <h3>Marijuana listings <span>{{ currentLocation }}</span></h3>
                                </div>
                            </div>
                            <!-- DESKTOP MENU SWIPER -->
                            <div class="desktop-menu-swiper desktop-map-swiper">
                                <!-- OPEN NOW -->
                                <div class="mobile-open-now">
                                    <button class="desktop-map-btn-common" @click="openNow"
                                            :class="{'desktop-btn-common-dark' : checkPropertyExists('opennow')}"
                                    >Open now
                                    </button>
                                </div>
                                <!-- STOREFRONT -->
                                <div class="mobile-storefront">
                                    <button class="desktop-map-btn-common"
                                            @click="checkStoreDelivery('storefront', 'Dispensary')"
                                            :class="{'desktop-btn-common-dark' : checkPropertyValueExists('Dispensary')}">
                                        Storefronts
                                    </button>
                                </div>
                                <!-- DELIVERY -->
                                <div class="mobile-storefront">
                                    <button class="desktop-map-btn-common"
                                            @click="checkStoreDelivery('storefront', 'Delivery')"
                                            :class="{'desktop-btn-common-dark' : checkPropertyValueExists('Delivery')}">
                                        Delivery
                                    </button>
                                </div>
                                <!-- ORDER ONLINE -->
                                <div class="mobile-storefront">
                                    <button class="desktop-map-btn-common" @click="orderOnline"
                                            :class="{'desktop-btn-common-dark' : checkPropertyExists('orderonline')}">
                                        Order Online
                                    </button>
                                </div>
                                <!-- BEST OF -->
                                <div class="mobile-storefront">
                                    <button class="desktop-map-btn-common" @click="bestOf"
                                            :class="{'desktop-btn-common-dark' : checkPropertyExists('bestof')}">Top
                                        Ranked
                                    </button>
                                </div>
                                <!-- LICENSE TYPE -->
                                <!-- <div class="mobile-storefront">
                                   <button class="desktop-map-btn-common">
                                       License Type
                                       <svg class="desktop-map-btn-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847" style="transform:rotate(0deg)"><path fill="currentColor" d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path></svg>
                                   </button>
                                </div> -->
                                <!-- CURBSIDE PICKUP -->
                                <!-- <div class="mobile-storefront">
                                   <button class="desktop-map-btn-common">Curbside pickup</button>
                                </div> -->
                                <!-- PRODUCTS -->
                                <div class="mobile-storefront map-products" v-click-outside="hideCategoryBox">
                                    <button class="desktop-map-btn-common"
                                            :class="{'desktop-btn-common-dark' : checkPropertyExists('category') || categoryToggle}"
                                            @click="checkCategoryToggle">
                 <span>
                     Products
                </span>
                                        <svg class="" width="10px" height="14px" viewBox="0 0 451.847 451.847">
                                            <path fill="currentColor"
                                                  d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                        </svg>
                                    </button>
                                    <template v-if="categoryToggle">
                                        <div class="map-categories">
                                            <div class="map-category-wrap row">
                                                <MapCategory v-for="category in categories" :key="category.id"
                                                             :category="category" @category="selectedCategory"
                                                             :categoryBg="checkCategorySelected(category.id)"></MapCategory>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <!-- AMENITIES -->
                                <!-- <div class="mobile-storefront">
                                   <button class="desktop-map-btn-common">Amenities</button>
                                </div> -->
                                <!-- SORT BY -->
                                <!-- <div class="mobile-storefront">
                                   <button class="desktop-map-btn-common">Sort by</button>
                                </div> -->
                            </div>
                            <!-- MOBILE MENU SWIPER -->
                            <div class="mobile-menu-swiper mobile-map-swiper">
                                <!-- Category Dialog -->
                                <DesktopMapDialog @close="closeCategoryModal" v-if="mobileProductDialog">
                                    <product-categories @selected-item="selectedMobileCategories"
                                                        @close="closeCategoryModal" @click="showCategoryModal"
                                                        :category="categories" :selectedCategories="checkedCategories"
                                                        @reset="removeCategoryKey"></product-categories>
                                </DesktopMapDialog>
                                <swiper ref="mySwiper" :options="swiperOptions">
                                    <swiper-slide>
                                        <!-- OPEN NOW -->
                                        <div class="mobile-open-now">
                                            <button class="mobile-map-btn-common" @click="openNow"
                                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('opennow')}"
                                            >Open now
                                            </button>
                                        </div>
                                    </swiper-slide>
                                    <swiper-slide>
                                        <!-- STOREFRONT -->
                                        <div class="mobile-storefront">
                                            <button class="mobile-map-btn-common"
                                                    @click="checkStoreDelivery('storefront', 'Dispensary')"
                                                    :class="{'mobile-btn-common-dark' : checkPropertyValueExists('Dispensary')}">
                                                Storefronts
                                            </button>
                                        </div>
                                    </swiper-slide>
                                    <swiper-slide>
                                        <!-- DELIVERY -->
                                        <div class="mobile-storefront">
                                            <button class="mobile-map-btn-common"
                                                    @click="checkStoreDelivery('storefront', 'Delivery')"
                                                    :class="{'mobile-btn-common-dark' : checkPropertyValueExists('Delivery')}">
                                                Delivery
                                            </button>
                                        </div>
                                    </swiper-slide>
                                    <swiper-slide>
                                        <!-- ORDER ONLINE -->
                                        <div class="mobile-storefront">
                                            <button class="mobile-map-btn-common" @click="orderOnline"
                                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('orderonline')}">
                                                Order Online
                                            </button>
                                        </div>
                                    </swiper-slide>
                                    <swiper-slide>
                                        <!-- BEST OF -->
                                        <div class="mobile-storefront">
                                            <button class="mobile-map-btn-common" @click="bestOf"
                                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('bestof')}">
                                                Top Ranked
                                            </button>
                                        </div>
                                    </swiper-slide>
                                    <swiper-slide>
                                        <!-- PRODUCTS -->
                                        <div class="mobile-storefront map-products">
                                            <button class="mobile-map-btn-common"
                                                    :class="{'mobile-btn-common-dark' : checkPropertyExists('category')}"
                                                    @click="showCategoryModal">
                 <span>
                     Products
                </span>
                                                <svg class="" width="10px" height="14px" viewBox="0 0 451.847 451.847">
                                                    <path fill="currentColor"
                                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </swiper-slide>
                                    <div class="swiper-pagination" slot="pagination"></div>
                                </swiper>
                            </div>
                            <!-- MOBILE SWIPER BTNS ENDS -->
                        </div>
                        <!-- MOBILE FILTERS ENDS -->
                        <div class="results-sort">
                            <div class="results-sort-result">
                                <h5>Showing results {{ pagination.from }} <span
                                    v-if="currentFeatures.length > 0">-</span> {{ pagination.to }} </h5>
                            </div>
                            <div class="results-sort-sort" v-click-outside="sortDropdownHide">
                                <h5 @click="sortDropdownShow"><span>{{ sortItemTitle }}</span>
                                    <svg class="finder-angle-down" width="10px" height="14px"
                                         viewBox="0 0 451.847 451.847">
                                        <path fill="currentColor"
                                              d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                    </svg>
                                </h5>
                                <div class="sortby" v-if="sortDropdownVisible">
                                    <sort-dropdown @sortData="checkSortBy" :sortItemTitle="sortItemTitle"/>
                                </div>
                            </div>
                        </div>
                        <div class="record-items">
                            <div class="record-item" v-for="item in currentFeatures" :key="item.id">
                                <div class="record-item-content" @click="showSingleRecord(item)">
                                    <div class="record-item-img">
                                        <img src="https://420finder.net/assets/img/logo01.png" alt=""
                                             v-if="singleRecord.profile_picture == '' || singleRecord.profile_picture == 'NULL'|| item.profile_picture == 'https://images.weedmaps.com/original/image_missing.jpg'">
                                        <img :src="item.profile_picture" alt="Business Image"
                                             onerror="this.src='https://420finder.net/assets/img/logo01.png'" v-else>
                                    </div>
                                    <div class="record-item-info">
                                        <div class="record-item-title">
                                            <h5>{{ item.business_name }}</h5>
                                        </div>
                                        <div class="record-item-reviews">
                                            <div class="rating-icon">
                                                <star-rating :increment="0.5" :read-only="true"
                                                             :rating="ratingResolver(item.rating)"
                                                             active-color="#f8971c" border-color="#f8971c"
                                                             :star-size="15" :show-rating="false"></star-rating>
                                            </div>
                                            <div class="rating-avg">
                                                <span>{{ ratingResolver(item.rating) }}</span>
                                            </div>
                                            <div class="rating-total">
                                                <span>({{ item.reviewCount }})</span>
                                            </div>
                                        </div>
                                        <div class="record-brand">
                                            <h5>
                                                <span> {{ item.business_type }} </span>
                                            </h5>
                                        </div>
                                        <div class="record-item-tag">
                                            <span>{{ checkTime(item.opening_time, item.closing_time) }}</span>
                                            <span>Order online</span>
                                            <span>Curbside pickup</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="record-item-link">
                                    <a :href="link(item.business_type, item.slug, item.id, item.route)">View
                                        menu</a>
                                </div>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination" v-if="currentFeatures.length">
                                <div class="pagination-inner">
                                    <button
                                        :disabled="changeButtonBg(pagination.current_page, pagination.current_page, 'prev')"
                                        :class="{'grey_bg': changeButtonBg(pagination.current_page, pagination.current_page, 'prev')}"
                                        @click="getRecords(selectedFilters, pagination.current_page - 1)">
                                        <svg width="8px" height="14px">
                                            <path fill="#999999" transform="rotate(180 4 7)"
                                                  d="M7.533 6.538L8 7l-.467.462L.933 14 0 13.075l6.6-6.537v.924L0 .925.933 0z"></path>
                                        </svg>
                                    </button>
                                    <select name="" id="" @change="getRecords(selectedFilters, $event.target.value)"
                                            class="form-control">
                                        <option :value="page" v-for="page in pagination.last_page" :key="page"
                                                :selected="(pagination.current_page == page) ? 'selected' : '' ">Page
                                            {{ page }} of {{ pagination.last_page }}
                                        </option>
                                    </select>
                                    <button
                                        :disabled="changeButtonBg(pagination.current_page, pagination.last_page, 'next')"
                                        :class="{'grey_bg': changeButtonBg(pagination.current_page, pagination.last_page, 'next')}"
                                        @click="getRecords(selectedFilters, pagination.current_page + 1)"
                                    >
                                        <svg width="8px" height="14px">
                                            <path fill="#999999" transform="rotate(0 0 0)"
                                                  d="M7.533 6.538L8 7l-.467.462L.933 14 0 13.075l6.6-6.537v.924L0 .925.933 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- PAGINATION ENDS -->
                            <div class="record-footer-content">
                                <MapFooter/>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <MapRecordSingle :singleRecord="singleRecord" @showResultFull="showResultFull"/>
                </template>
                <div class="resize-btn">
                    <button @click="toggleResizeRecord">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DesktopMapDialog from './dialog/DesktopMapDialog.vue';
import ProductCategories from './MapFilterItems/ProductCategories.vue';
import {directive, Swiper, SwiperSlide} from 'vue-awesome-swiper';
import StarRating from 'vue-star-rating';
import ClickOutside from 'vue-click-outside';
import MapCategory from './mapcomponents/MapCategory.vue';
import MapFooter from './mapcomponents/MapFooter.vue';
import SortDropdown from './dropdown/SortDropdown.vue';
import MapRecordSingle from './mapcomponents/MapRecordSingle.vue';
import carousel from "vue-owl-carousel";
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";

export default {
    props: ['latitude', 'longitude'],
    components: {
        DesktopMapDialog,
        ProductCategories,
        Swiper,
        SwiperSlide,
        StarRating,
        carousel,
        SortDropdown,
        MapCategory,
        MapFooter,
        MapRecordSingle
    },
    data() {
        return {
            currentLocation: '',
            swiperOptions: {
                pagination: {
                    el: '.swiper-pagination'
                },
                slidesPerView: 'auto',
                spaceBetween: 0,
                allowTouchMove: true,
                allowSlideNext: true,
                allowSlidePrev: true,
                preventClicks: false,
                preventClicksPropagation: false
            },
            resize: false,
            recordFullCheck: true,
            singleRecord: {},
            map: null,
            lat: this.latitude,
            lng: this.longitude,
            redoSearchBtnVisible: false,
            markers: [],
            currentFeatures: [],
            categories: [],
            checkedCategories: [],
            categoryToggle: false,
            selectedFilters: {},
            pagination: {},
            opennow: false,
            storeDelivery: [],
            orderonline: false,
            bestof: false,
            sortDropdownVisible: false,
            sortItemTitle: 'Sort by',
            stores: [],
            mobileProductDialog: false
        }
    },
    watch: {
        currentFeatures: {
            handler() {
                if (this.currentFeatures) {
                    this.resetMarkers();
                    this.updateMarkers();
                }
            },
            deep: true,
        },
        selectedFilters: {
            handler(query) {
                this.getRecords(query);
                if (Object.keys(query).length > 0) {
                    this.recordFullCheck = true;
                }
            },
            deep: true
        }
    },
    methods: {
        toggleResizeRecord() {
            this.resize = !this.resize;
        },
        resetMarkers() {
            this.markers.forEach((marker) => {
                marker.remove();
            });
            this.markers = [];
        },
        updateMarkers() {
            // this.markers =
            this.markers = this.currentFeatures.map((feature) => {
                const el = this.getBusinessMarker(feature.business_type, feature.top_business, feature.icon, feature.custom_icon, feature.z_index);
                //  create the popup
                const popup = this.featurePopup(feature);
                const marker = new mapboxgl.Marker(el, {offset: [0, -50 / 2]}).setLngLat([feature.longitude, feature.latitude]).setPopup(popup).addTo(this.map);
                const markerDiv = marker.getElement();
                const pop = marker.getPopup();
                markerDiv.addEventListener('mouseenter', () => {
                    marker.togglePopup();
                    $(".index-rating").starRating({
                        readOnly: true,
                        totalStars: 5,
                        starSize: 13,
                        emptyColor: 'lightgray',
                        activeColor: '#f8971c',
                        useGradient: false
                    });
                });
                markerDiv.addEventListener('click', () => {
                    this.showSingleRecord(feature);
                    // console.log(feature);
                });
                markerDiv.addEventListener('mouseleave', () => popup.remove());
                // markerDiv.addEventListener('mouseleave', () => marker.togglePopup());
                // return new mapboxgl.Marker(el).setLngLat([feature.longitude,feature.latitude]).setPopup(popup).addTo(this.map);
                return marker;
            });
        },
        initMap() {
            mapboxgl.accessToken = "pk.eyJ1IjoiamNhcnJhc2NvNzIzIiwiYSI6ImNsOGJ6dmhlcTAxcHczb3F1enl0Z2s2dmsifQ._JYP-_Ma0bRQh6Ho-yAppw";
            this.map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/light-v10",
                center: [this.lng, this.lat],
                zoom: 12,
            });
            this.map.on("load", () => {
                this.map.addControl(new mapboxgl.NavigationControl(), "top-right");
                if (this.markers.length > 0) {
                    this.resetMarkers();
                }
                if (this.currentFeatures) {
                    this.updateMarkers();
                }
                const el = document.createElement("div");
                el.className = "marker";
                el.style.width = '56px';
                el.style.height = '77px';
                el.style.position = 'absolute';
                el.style.backgroundRepeat = 'no-repeat';
                el.style.backgroundImage = "url('/icon2.png')";
                new mapboxgl.Marker(el, {offset: [0, -50 / 2]}).setLngLat([this.lng, this.lat]).addTo(this.map);
            });
        },
        getBusinessMarker(businessType, topStatus, topIcon, customIcon, zIndex) {
            const el = document.createElement("div");
            el.className = "marker";
            el.style.width = '56px';
            el.style.height = '77px';
            el.style.position = 'absolute';
            if (zIndex != 'n') {
                el.style.zIndex = zIndex;
            }
            el.style.backgroundRepeat = 'no-repeat';
            if (businessType == 'Delivery') {
                if (topStatus == '1') {
                    el.style.zIndex = 1;
                    el.style.backgroundImage = `url('${topIcon}')`;
                }
                if (topStatus == '0' || topStatus == null) {
                    el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/delivery-green.png')";
                }
            } else if (businessType == 'Dispensary') {
                if (topStatus == '1') {
                    el.style.zIndex = 1;
                    el.style.backgroundImage = `url('${topIcon}')`;
                }
                if (topStatus == '0' || topStatus == null) {
                    el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/dispensary-green.png')";
                }
            }
            return el;
        },
        featurePopup(feature) {
            let innerContent = `<div class="card popup-card" id="popup-card-${feature.id}">
          <div class="card-body popup-body">
          <div class="popup-img">
            <img onerror="this.src='https://420finder.net/assets/img/logo01.png'" src="${feature.profile_picture}" alt="Business Image" />
          </div>
          <div class="popup-content">
             <div class="popup-title">
                <h5>${feature.business_name}</h5>
             </div>
             <div class="popup-brand">
                <h5>
                    <span>${feature.business_type}</span>
                </h5>
             </div>
             <div class="popup-item-tag">
                <span>${this.checkTime(feature.opening_time, feature.closing_time)}</span>
                <span>Order online</span>
                <span>Curbside pickup</span>
             </div>
              <div class="record-item-reviews">
                  <div class="rating-icon">
                    <div class="index-rating" data-rating="${parseFloat(feature.rating)}"></div>
                  </div>
                  <div class="rating-avg">
                       <span>${feature.rating}</span>
                  </div>
                  <div class="rating-total">
                    <span>(${feature.reviewCount})</span>
                   </div>
              </div>
          </div>
          </div>
        </div>`;
            let div = document.createElement('div');
            div.innerHTML = innerContent;
            div.addEventListener('click', () => {
                this.showSingleRecord(feature);
            });
            div.style.cursor = 'pointer';
            let element = new mapboxgl.Popup({offset: 25}).setDOMContent(div);
            return element;
        },
        getRecords(query, page = 1) {
            this.redoSearchBtnVisible = false;
            if (page <= 0 || page > this.pagination.last_page) {
                return;
            }
            axios.get('/api/map', {
                params: {
                    latitude: this.lat,
                    longitude: this.lng,
                    ...query,
                    page
                }
            }).then((response) => {
                console.log(response);
                this.currentFeatures = response.data.data;
                this.pagination = response.data.meta;
            }).catch((err) => {
                console.log(err);
            })
        },
        async getCategories() {
            await axios.get('/api/map/categories').then((response) => {
                this.categories = response.data.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        async getAllStores() {
            await axios.get(`/api/map/get-all-stores/${this.lat}/${this.lng}`).then((response) => {
                this.stores = response.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        //  FILTERS
        activateFilter(key, value) {
            if (key == 'opennow') {
                if (this.opennow) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'opennow');
                }
            } else if (key == 'storedelivery') {
                if (this.storeDelivery.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.storeDelivery)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'storedelivery')
                }
            } else if (key == 'orderonline') {
                if (this.orderonline) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'orderonline');
                }
            } else if (key == 'bestof') {
                if (this.bestof) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'bestof');
                }
            } else if (key == 'category') {
                if (this.checkedCategories.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.checkedCategories)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'category')
                }
            } else {
                this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
            }
        },
        // =========== FILTER - BTNS ================
        openNow() {
            this.opennow = !this.opennow;
            this.activateFilter('opennow', this.opennow);
        },
        checkStoreDelivery(key, value) {
            if (_.includes(this.storeDelivery, value)) {
                this.storeDelivery = _.remove(this.storeDelivery, function (n) {
                    return n != value;
                });
            } else {
                this.storeDelivery.push(value);
            }
            this.activateFilter('storedelivery', this.storeDelivery);
        },
        checkPropertyExists(property) {
            return this.selectedFilters.hasOwnProperty(property);
        },
        checkPropertyValueExists(property) {
            if (this.selectedFilters.hasOwnProperty('storedelivery')) {
                return _.includes(this.storeDelivery, property);
            }
        },
        orderOnline() {
            this.orderonline = !this.orderonline;
            this.activateFilter('orderonline', this.orderonline);
        },
        bestOf() {
            this.bestof = !this.bestof;
            this.activateFilter('bestof', this.bestof);
        },
        // ====================== CHECKED CATEGORIES ===================
        selectedCategory(categoryId) {
            if (_.includes(this.checkedCategories, categoryId)) {
                this.checkedCategories = _.remove(this.checkedCategories, function (n) {
                    return n != categoryId;
                });
            } else {
                this.checkedCategories.push(categoryId);
            }
            this.activateFilter('category', this.checkedCategories);
        },
        checkCategorySelected(categoryId) {
            return _.includes(this.checkedCategories, categoryId);
        },
        hideCategoryBox() {
            this.categoryToggle = false;
        },
        checkCategoryToggle() {
            this.categoryToggle = !this.categoryToggle;
        },
        changeButtonBg(current, lastPage, btn) {
            if (btn == 'prev') {
                return current == 1 ? true : false;
            } else {
                return current == lastPage ? true : false;
            }
        },
        link(businessType, business_name, businessId, routeUrl) {
            if (businessType == 'Delivery') {
                return `${routeUrl}/deliveries/${business_name}/${businessId}`;
            } else if (businessType == 'Dispensary') {
                return `${routeUrl}/dispensaries/${business_name}/${businessId}`;
            } else if (businessType == 'Brand') {
                return `${routeUrl}/brand/${businessId}`;
            } else {
                return '/maps'
            }
        },
        checkTime(openingTime, closingTime) {
            const d = new Date();
            let time = d.getHours() + ':' + d.getMinutes();
            if (time >= openingTime && time <= closingTime) {
                return 'Open now';
            } else {
                return 'Closed';
            }
        },
        ratingResolver(rating) {
            if (rating < 1) {
                return 0;
            }
            return parseFloat(parseFloat(rating).toFixed(1));
        },
        // ================= SHOW RECORD ================
        showSingleRecord(item) {
            this.singleRecord = item;
            this.recordFullCheck = false;
        },
        showResultFull() {
            this.recordFullCheck = true;
        },
        // ================= SORT =======================
        sortDropdownShow() {
            this.sortDropdownVisible = !this.sortDropdownVisible;
        },
        sortDropdownHide() {
            this.sortDropdownVisible = false;
        },
        checkSortBy(sortItem) {
            this.sortItemTitle = sortItem.name;
            this.activateFilter('sort', sortItem.value);
            this.sortDropdownHide();
        },
        // ================ MOBILE FILTER ===============
        closeCategoryModal() {
            this.mobileProductDialog = false;
        },
        showCategoryModal() {
            this.mobileProductDialog = true;
        },
        removeCategoryKey() {
            this.checkedCategories = [];
            this.selectedFilters = _.omit(this.selectedFilters, 'category');
            this.closeCategoryModal();
        },
        selectedMobileCategories(checkedCategories) {
            this.checkedCategories = checkedCategories;
            this.activateFilter('category', this.checkedCategories);
        },
        setLocation() {
            let currentLocation = localStorage.getItem('currentlocation');
            if (currentLocation !== null) {
                this.currentLocation = currentLocation;
            } else {
                this.currentLocation = 'Los Angeles, California, USA';
            }
        },
    },
    mounted() {
        this.setLocation();
        this.initMap();
        this.getRecords();
        this.getCategories();
        this.getAllStores();
        var modelApp = {
            menu: function () {
                $(".index-rating").starRating({
                    readOnly: true,
                    totalStars: 5,
                    starSize: 18,
                    emptyColor: 'lightgray',
                    activeColor: '#f8971c',
                    useGradient: false
                })
            },
        };
        /* ---------------------------------------------
         Document ready function
         --------------------------------------------- */
        $(function () {
            modelApp.menu();
        });
    },
    directives: {
        swiper: directive,
        ClickOutside
    }
}
</script>
<style scoped>
@import './css/desktop-map.css';

.map-container {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: calc(100vh - 210px);
}

.checked {
    color: orange;
}

#map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    border-radius: 0.25rem;
    border: 1px solid #ccc;
}

.marker:before {
    content: "";
    cursor: pointer;
    position: absolute;
    width: 25px;
    height: 25px;
    border: 1px solid #ccc;
    border-radius: 75% 45% 75% 0%;
    background: #3498db;
    bottom: 0;
    transform-origin: 0% 100%;
    transform: rotate(-45deg) scale(1);
}

.mapboxgl-popup-content .list-group-item {
    padding: 0.5rem 0.25rem;
}

.mapboxgl-popup-content .list-group-item .label {
    padding-right: 0.5rem;
    font-weight: bold;
}

.swiper-slide {
    width: auto;
}

.markershow {
    background-image: url('../../mapbox-marker-icon-20px-blue.png');
    background-size: cover;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
}
</style>
