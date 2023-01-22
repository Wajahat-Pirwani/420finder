<template>
    <div class="container" style="padding: 0px">
        <!-- MOBILE VIEW FILTERS -->
        <div class="mobile-filters">
            <form @submit.prevent="mbSearchFormHandler" v-if="searchDialog" v-click-outside="hideSearchDialog">
                <div class="mb-search-wrap">
                    <input type="text" placeholder="Search this menu" v-model="searchQuery"/>
                    <div class="svg-icon" @click="closeSearchForm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path
                                d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                        </svg>
                    </div>
                </div>
            </form>
            <!-- SORT -->
            <MobileMenuDialog @close="closeSortModal" v-if="sortDialog">
                <sort-item @selected-item="selectedSort" @close="closeSortModal" @click="showSortModal"
                           :relevance="relevance" @reset="removeSortKey"></sort-item>
            </MobileMenuDialog>
            <!-- CATEGORY -->
            <MobileMenuDialog @close="closeCategoryModal" v-if="categoryDialog">
                <category-item @selected-item="selectedCategory" @close="closeCategoryModal" @click="showCategoryModal"
                               :category="categories" :selectedCategories="checkedCategories"
                               @reset="removeCategoryKey"></category-item>
            </MobileMenuDialog>
            <!-- PRICE -->
            <MobileMenuDialog @close="closePriceModal" v-if="priceDialog">
                <price-item @selected-item="selectedPrice" @close="closePriceModal" @click="showPriceModal"
                            :price="price" @reset="removePriceKey"></price-item>
            </MobileMenuDialog>
            <!-- GENETIC -->
            <template v-if="genetics.length > 0">
                <MobileMenuDialog @close="closeGeneticModal" v-if="geneticDialog">
                    <genetic-item @selected-item="selectedGenetic" @close="closeGeneticModal" @click="showGeneticModal"
                                  :genetic="genetics" :selectedGenetics="checkedGenetics"
                                  @reset="removeGeneticKey"></genetic-item>
                </MobileMenuDialog>
            </template>
            <!-- BRANDS -->
            <MobileMenuDialog @close="closeBrandsModal" v-if="brandsDialog">
                <brandlist-item @selected-item="selectedBrands" @close="closeBrandsModal" @click="showBrandsModal"
                                :brands="brands" :deliveryId="id" :selectedBrands="checkedBrandlist"
                                @reset="removeBrandsKey"></brandlist-item>
            </MobileMenuDialog>
            <!-- FILTERS -->
            <MobileMenuDialog @close="closeFiltersModal" v-if="filtersDialog">
                <filters-item @selected-item="selectedFiltersModified" @close="closeFiltersModal"
                              @click="showFiltersModal" :selectedFilters="selectedFilters"
                              @reset="removeFilters"></filters-item>
            </MobileMenuDialog>
            <!-- MENU SWIPER SLIDE -->
            <div class="menu-swiper-slide" v-if="searchDialog == false">
                <swiper ref="mySwiper" :options="swiperOptions">
                    <!-- SEARCH -->
                    <swiper-slide>
                        <div class="mobile-sort">
                            <button class="sort-btn mb-btn-common" @click="showSearchDialog"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('search') }">
                                <svg class="finder-search" width="14px" height="14px" viewBox="0 0 1792 1792">
                                    <path fill="currentColor"
                                          d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"></path>
                                </svg>
                                {{ mobileSearchTitle.length >= 1 ? `"${mobileSearchTitle}"` : '' }}
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- SORT -->
                    <swiper-slide>
                        <div class="mobile-sort">
                            <button class="sort-btn mb-btn-common" @click="showSortModal"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('relevance') }">{{ mobileSortTitle
                                }}
                                <svg class="mb-btn-common-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847"
                                     style="transform:rotate(0deg)">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- CATEGORIES -->
                    <swiper-slide>
                        <div class="mobile-categories">
                            <button class="sort-btn mb-btn-common" @click="showCategoryModal"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('category') }">{{
                                    mobileCategoryTitle }}
                                <svg class="mb-btn-common-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847"
                                     style="transform:rotate(0deg)">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- PRICE -->
                    <swiper-slide>
                        <div class="mobile-prices">
                            <button class="price-btn mb-btn-common" @click="showPriceModal"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('price') }">{{ mobilePriceTitle }}
                                <svg class="mb-btn-common-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847"
                                     style="transform:rotate(0deg)">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- GENETICS -->
                    <swiper-slide v-if="genetics.length > 0">
                        <div class="mobile-genetics">
                            <button class="genetic-btn mb-btn-common" @click="showGeneticModal"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('genetic') }">{{ mobileGeneticTitle
                                }}
                                <svg class="mb-btn-common-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847"
                                     style="transform:rotate(0deg)">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- BRAND VERIFIED -->
                    <swiper-slide>
                        <div class="mobile-brand-verified">
                            <button class="brand-verified-btn mb-btn-common"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('brand') }"
                                    @click="mbBrandVerified">
                                <svg class="finder-icon-brand" width="16" height="16" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z"
                                          fill="currentColor"></path>
                                </svg>
                                Brand Verified
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- BRANDS -->
                    <swiper-slide>
                        <div class="mobile-brands">
                            <button class="brandlist-btn mb-btn-common" @click="showBrandsModal"
                                    :class="{ 'bg-dark-custom' : checkPropertyExists('brandlist') }">
                    <span v-if="checkedBrandlist.length > 0" class="mb-btn-count">
                        {{ checkedBrandlist.length }}
                    </span>
                                Brands
                                <svg class="mb-btn-common-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847"
                                     style="transform:rotate(0deg)">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <!-- FILTERS -->
                    <swiper-slide>
                        <div class="mobile-brands">
                            <button class="brandlist-btn mb-btn-common" @click="showFiltersModal"
                                    :class="{ 'bg-dark-custom' : Object.keys(selectedFilters).length > 0}">
                    <span v-if="Object.keys(selectedFilters).length > 0" class="mb-btn-count">
                        {{ Object.keys(selectedFilters).length }}
                    </span>
                                Filters
                                <svg class="mb-btn-common-svg" width="10px" height="10px" viewBox="0 0 451.847 451.847"
                                     style="transform:rotate(0deg)">
                                    <path fill="currentColor"
                                          d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path>
                                </svg>
                            </button>
                        </div>
                    </swiper-slide>
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
            </div>
            <!-- MENU SWIPER SLIDE ENDS -->
        </div>
        <!-- DESKTOP MENU -->
        <div class="row desktop-menu">
            <div class="col-lg-4 menu-left-content-col">
                <div class="menu-left-content">
                    <div class="filter-list" v-if="Object.keys(selectedFilters).length > 0">
                        <button class="btn btn-primary" @click="clearFilters">Clear Filters</button>
                    </div>
                    <div class="categories">
                        <h4>Categories</h4>
                    </div>
                    <div class="products">
                        <h4>All Products</h4>
                        <ul>
                            <li v-for="category in categories" :key="category.id">
                                <input type="checkbox" name="category"
                                       :id="`category-${category.id}`"
                                       class="checkboxInput"
                                       :value="category.id"
                                       :true-value="1"
                                       v-model="checkedCategories" @change="activateFilter('category', category.id)"/>
                                <label :for="`category-${category.id}`">{{ category.name }}</label>
                            </li>
                        </ul>
                    </div>
                    <div class="brand-verified">
                        <h4>Brand Verified</h4>
                        <div class="brand-checkbox">
                            <input type="checkbox" name="brand_verified" id="brand-verified" v-model="brandVerified"
                                   @change="activateFilter('brand', +brandVerified)">
                            <div>
                                <label for="brand-verified">Brand Verified</label>
                                <svg class="brand-icon-brand" width="18" height="18" viewBox="0 0 24 24">
                                    <path class="brand-icon-brand" fill-rule="evenodd" clip-rule="evenodd"
                                          d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z"
                                          fill="#66CCFF"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="brands">
                        <h4>Brands</h4>
                        <div class="brands-search">
                            <input type="text" placeholder="Search Brand" v-model="searchBrand"/>
                        </div>
                        <div class="brands-list">
                            <div v-if="brandLoading" class="loading-spinner">
                                <p><i class="fas fa-circle-notch fa-spin"></i></p>
                            </div>
                            <template v-else>
                                <template v-if="brands.length > 0">
                                    <div class="brand-item" v-for="brand in brands" :key="brand.id">
                                        <input type="checkbox" name="brandlist" :id="`brand-item-${brand.id}`"
                                               v-model="checkedBrandlist" :value="brand.id"
                                               @change="activateFilter('brandlist', brand.id)"/>
                                        <div class="brand-img-label">
                                            <img :src="brand.logo" alt="Brand Image">
                                            <label :for="`brand-item-${brand.id}`">{{ brand.name }}</label>
                                        </div>
                                    </div>
                                </template>
                                <div v-else>
                                    <p>No results found.</p>
                                </div>
                            </template>
                            <!-- <div class="show-more" v-if="brands.length > 5">
                                <a href="#">Show more brands</a>
                            </div> -->
                        </div>
                    </div>
                    <!-- HYBRID -->
                    <div class="common-block" v-if="genetics.length > 0">
                        <h4>Hybrid, Indica, Sativa</h4>
                        <div class="icon"></div>
                        <div class="common-block-list">
                            <ul>
                                <li v-for="genetic in genetics" :key="genetic.id">
                                    <input type="checkbox" name="" :id="`genetic-${genetic.id}`"
                                           v-model="checkedGenetics"
                                           :value="genetic.id"
                                           @change="activateFilter('genetic', genetic.id)"
                                    >
                                    <label :for="`genetic-${genetic.id}`">{{ genetic.name }}</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- STRAINS -->
                    <div class="common-block" v-if="strains.length > 0">
                        <h4>Strains</h4>
                        <div class="icon"></div>
                        <div class="common-block-list">
                            <ul>
                                <li v-for="strain in strains" :key="strain.id">
                                    <input type="checkbox" name="strain"
                                           :value="strain.id"
                                           :id="`strain-${strain.id}`"
                                           v-model="checkedStrains"
                                           @change="activateFilter('strain', strain.id)"
                                    />
                                    <label :for="`strain-${strain.id}`">{{ strain.name }}</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- CANNABINOIDS -->
                    <div class="common-block" v-if="cannabs.thc > 0 || cannabs.cbd > 0">
                        <h4>Cannabinoids</h4>
                        <div class="icon"></div>
                        <div class="common-block-list">
                            <ul>
                                <li v-if="cannabs.thc > 0">
                                    <input type="checkbox" name="canibies-thc" id="can-thc" :value="1"
                                           v-model="checkedCan" @change="activateFilter('canibies', 1)"/>
                                    <label for="can-thc">THC</label>
                                </li>
                                <li v-if="cannabs.cbd > 0">
                                    <input type="checkbox" name="canibies-cbd" id="can-cbd" :value="2"
                                           v-model="checkedCan" @change="activateFilter('canibies', 2)"/>
                                    <label for="can-cbd">CBD</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- PRICE RANGE -->
                    <div class="common-block">
                        <h4>Price range</h4>
                        <div class="icon"></div>
                        <div class="common-block-list">
                            <ul>
                                <li>
                                    <input type="radio" name="price" id="price-any" v-model="price" value="any" checked
                                           @change="activateFilter('price', price)">
                                    <label for="price-any">Any</label>
                                </li>
                                <li>
                                    <input type="radio" name="price" id="price-25" value="24" v-model="price"
                                           @change="activateFilter('price', price)">
                                    <label for="price-25">Under $25</label>
                                </li>
                                <li>
                                    <input type="radio" name="price" id="price-25-50" value="26" v-model="price"
                                           @change="activateFilter('price', price)">
                                    <label for="price-25-50">$25 to $50</label>
                                </li>
                                <li>
                                    <input type="radio" name="price" id="price-50-100" value="51" v-model="price"
                                           @change="activateFilter('price', price)">
                                    <label for="price-50-100">$50 to $100</label>
                                </li>
                                <li>
                                    <input type="radio" name="price" id="price-100-200" value="101" v-model="price"
                                           @change="activateFilter('price', price)">
                                    <label for="price-100-200">$100 to $200</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="menu-right-content">
                    <!-- Search Dropdown -->
                    <div class="search-box-dropdown">
                        <div class="search-box">
                            <div class="icon">
                                <svg class="finder-search" width="14px" height="14px" viewBox="0 0 1792 1792">
                                    <path fill="#6c6b6b"
                                          d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"></path>
                                </svg>
                            </div>
                            <input type="text" placeholder="Search this menu" v-model="searchQuery">
                        </div>
                        <div class="dropdown">
                            <select name="" id="" @change="activateFilter('relevance', $event.target.value)"
                                    class="form-control" v-model="relevance">
                                <option value="relevance">Relevance</option>
                                <!-- <option value="">Most Popular</option> -->
                                <option value="recently-added">Recently Added</option>
                                <option value="low-price">Lowest price</option>
                                <option value="high-price">Highest price</option>
                                <option value="thc-low-to-high">THC%: low to high</option>
                                <option value="thc-high-to-low">THC%: high to low</option>
                                <option value="cbd-low-to-high">CBD%: low to high</option>
                                <option value="cbd-high-to-low">CBD%: high to low</option>
                            </select>
                        </div>
                    </div>
                    <!-- Results Found -->
                    <div class="result-time-wrap">
                        <div class="result-content">
                            <p v-if="loading">Loading...</p>
                            <p v-else>{{ productsCount }} results found</p>
                        </div>
                        <!-- <div class="time-content">
                            <div class="icon">
                                <svg class="last-updated__ClockIcon-sc-22llrd-1 eJbGlU" height="16px" width="16px" viewBox="0 0 24 24" data-testid="clock-icon"><path fill="#02b35a" d="M11.805 14.019H7.94a1.21 1.21 0 1 1 0-2.418h2.657V7.25a1.21 1.21 0 0 1 2.419 0v5.559a1.21 1.21 0 0 1-1.21 1.209M12 4.04C7.611 4.04 4.04 7.61 4.04 12c0 4.389 3.571 7.96 7.96 7.96 4.389 0 7.96-3.571 7.96-7.96 0-4.389-3.571-7.96-7.96-7.96M12 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10"></path></svg>
                            </div>
                            <div class="time-content-text">
                                <p>Updated 1 day ago</p>
                            </div>
                        </div> -->
                    </div>
                    <!-- Featured Products -->
                    <div class="featured-products">
                        <h3 class="featured-title" v-if="isFeatured && featuredProducts.length > 0">Featured
                            products</h3>
                        <div class="">
                            <div v-if="loading" class="loading-spinner">
                                <p><i class="fas fa-circle-notch fa-spin"></i></p>
                            </div>
                            <template v-else>
                                <template v-if="isFeatured && featuredProducts.length > 0">
                                    <carousel :items="3" :dots="false" :nav="false"
                                              :responsive="{0:{items:2,nav:false},600:{items:3,nav:false}}">
                                        <template slot="prev"><span class="prev slider-btn"><i
                                            class="fa fa-angle-left"></i></span></template>
                                        <FeaturedProducts
                                            v-for="featured in featuredProducts"
                                            :key="featured.id"
                                            :featured="featured"
                                            :islogin="islogin"
                                            :retailerid="id"
                                            :isdispensary="true"
                                        >
                                        </FeaturedProducts>
                                        <template slot="next"><span class="next slider-btn"><i
                                            class="fa fa-angle-right"></i></span></template>
                                    </carousel>
                                </template>
                            </template>
                        </div>
                    </div>
                    <!-- Rest Products -->
                    <div class="rest-products">
                        <!--                        <div class="rest-products-title">-->
                        <!--                            <h3 v-if="(filterProducts.length > 0) ? filterProducts[0]['category_name'][0] : ''">-->
                        <!--                                {{ filterProducts[0]['category_name'][0]}}</h3>-->
                        <!--                        </div>-->
                        <NotFeaturedProducts
                            v-for="product in filterProducts"
                            :key="product.id"
                            :product="product"
                            :islogin="islogin"
                            :retailerid="id"
                            :isdispensary="true"
                        >
                        </NotFeaturedProducts>
                    </div>
                    <!-- Pagination -->
                    <div class="pagination" style="background: #fff" v-if="pagination.total > 50">
                        <button
                            :disabled="changeButtonBg(pagination.current_page, pagination.current_page, 'prev')"
                            :class="{'grey_bg': changeButtonBg(pagination.current_page, pagination.current_page, 'prev')}"
                            @click="getProducts(selectedFilters, pagination.current_page - 1)">
                            <svg width="8px" height="14px">
                                <path fill="#999999" transform="rotate(180 4 7)"
                                      d="M7.533 6.538L8 7l-.467.462L.933 14 0 13.075l6.6-6.537v.924L0 .925.933 0z"></path>
                            </svg>
                        </button>
                        <select name="" id="" @change="getProducts(selectedFilters, $event.target.value)"
                                class="form-control">
                            <option :value="page" v-for="page in pagination.last_page" :key="page"
                                    :selected="(pagination.current_page == page) ? 'selected' : '' ">Page {{ page }} of
                                {{ pagination.last_page }}
                            </option>
                        </select>
                        <button
                            :disabled="changeButtonBg(pagination.current_page, pagination.last_page, 'next')"
                            :class="{'grey_bg': changeButtonBg(pagination.current_page, pagination.last_page, 'next')}"
                            @click="getProducts(selectedFilters, pagination.current_page + 1)"
                        >
                            <svg width="8px" height="14px">
                                <path fill="#999999" transform="rotate(0 0 0)"
                                      d="M7.533 6.538L8 7l-.467.462L.933 14 0 13.075l6.6-6.537v.924L0 .925.933 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating';
import ClickOutside from 'vue-click-outside';
import {Swiper, SwiperSlide, directive} from 'vue-awesome-swiper'
import SortItem from './filterItems/SortItem.vue';
import CategoryItem from './filterItems/CategoryItem.vue';
import PriceItem from './filterItems/PriceItem.vue';
import GeneticItem from './filterItems/GeneticItem.vue';
import BrandlistItem from './filterItems/BrandlistItem.vue';
import FiltersItem from './filterItems/FiltersItem.vue';
import MobileMenuDialog from './dialog/MobileMenuDialog.vue';
import carousel from "vue-owl-carousel";
import FeaturedProducts from './MenuProductItems/FeaturedProducts.vue';
import NotFeaturedProducts from './MenuProductItems/NotFeaturedProducts.vue';
export default {
    props: ['id', 'islogin'],
    components: {
        StarRating,
        carousel,
        Swiper,
        SwiperSlide,
        MobileMenuDialog,
        SortItem,
        CategoryItem,
        PriceItem,
        GeneticItem,
        BrandlistItem,
        FiltersItem,
        FeaturedProducts,
        NotFeaturedProducts
    },
    data() {
        return {
            swiperOptions: {
                pagination: {
                    el: '.swiper-pagination'
                },
                slidesPerView: 'auto',
                spaceBetween: 10,
                allowTouchMove: true,
                allowSlideNext: true,
                allowSlidePrev: true,
                preventClicks: false,
                preventClicksPropagation: false
            },
            categories: [],
            checkedCategories: [],
            checkedBrandlist: [],
            checkedGenetics: [],
            checkedStrains: [],
            checkedCan: [],
            genetics: [],
            strains: [],
            cannabs: {
                'thc': 0,
                'cbd': 0
            },
            brands: [],
            brandLoading: false,
            price: 'any',
            relevance: 'relevance',
            brandVerified: 0,
            productsCount: '',
            selectedFilters: {},
            filterProducts: [],
            isFeatured: true,
            featuredProducts: [],
            loading: false,
            searchQuery: "",
            searchBrand: "",
            pagination: {},
            mobileSearchTitle: '',
            searchDialog: false,
            mobileSortTitle: 'Sort',
            sortDialog: false,
            mobileCategoryTitle: 'Category',
            categoryDialog: false,
            mobilePriceTitle: 'Price',
            priceDialog: false,
            mobileGeneticTitle: 'Indica, Sativa, Hybrid',
            geneticDialog: false,
            brandsDialog: false,
            filtersDialog: false,
        }
    },
    computed: {
        swiper() {
            return this.$refs.mySwiper.$swiper
        }
    },
    watch: {
        searchBrand: _.debounce(function (val) {
            if (val.length >= 2) {
                this.getSearchBrands(val);
            } else {
                this.getBrands();
            }
        }, 500),
        searchQuery: _.debounce(function (val) {
            if (val.length >= 3) {
                this.selectedFilters = Object.assign({}, this.selectedFilters, {['search']: val});
                this.getProducts(this.selectedFilters, val);
            } else {
                this.getProducts(this.selectedFilters);
                this.selectedFilters = _.omit(this.selectedFilters, 'search');
            }
        }, 500),
        selectedFilters: {
            handler(query) {
                if (Object.keys(query).length > 0) {
                    this.getProducts(query);
                } else {
                    this.getInitialProducts(1);
                }
            },
            deep: true
        }
    },
    methods: {
        async getInitialProducts(page) {
            this.loading = true;
            await axios.get('/api/products/dispensary', {
                params: {
                    delivery: this.id,
                    initial: 1,
                    page
                }
            }).then((response) => {
                this.loading = false;
                this.productsCount = response.data.product_count;
                this.filterProducts = response.data.data;
                this.pagination = response.data.meta;
            }).catch((error) => {
                this.loading = false;
                console.log(error);
            });
            await axios.get('/api/featured-products/dispensary', {
                params: {
                    delivery: this.id
                }
            }).then((response) => {
                this.isFeatured = true;
                this.featuredProducts = response.data.data;
                // console.log(response)
            }).catch((err) => {
                console.log(err);
            });
        },
        getProducts(query, page = 1) {
            if (page <= 0 || page > this.pagination.last_page) {
                return;
            }
            this.loading = true;
            this.isFeatured = false;
            axios.get('/api/products/dispensary', {
                params: {
                    delivery: this.id,
                    ...query,
                    //    search: searchQuery,
                    page
                }
            }).then((response) => {
                this.loading = false;
                this.productsCount = response.data.product_count;
                this.filterProducts = response.data.data;
                this.pagination = response.data.meta;
            }).catch((error) => {
                this.loading = false;
                console.log(error);
            });
        },
        async getCategories() {
            await axios.get(`/api/products/dispensary/get-categories/${this.id}`).then((response) => {
                this.categories = response.data.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        async getBrands() {
            this.brandLoading = true;
            await axios.get(`/api/products/dispensary/get-brand/${this.id}`).then((response) => {
                this.brandLoading = false;
                this.brands = response.data.data;
            }).catch((err) => {
                this.brandLoading = false;
                console.log(err);
            });
        },
        async getSearchBrands(query) {
            this.brandLoading = true;
            await axios.get(`/api/products/dispensary/search-brand/${this.id}/${query}`).then((response) => {
                this.brandLoading = false;
                this.brands = response.data.data;
            }).catch((err) => {
                this.brandLoading = false;
                console.log(err);
            });
        },
        async getGenetics() {
            await axios.get(`/api/products/dispensary/get-genetics/${this.id}`).then((response) => {
                this.genetics = response.data.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        async getStrains() {
            await axios.get(`/api/products/dispensary/get-strains/${this.id}`).then((response) => {
                this.strains = response.data.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        async getCannabs() {
            await axios.get(`/api/products/dispensary/get-cannabs/${this.id}`).then((response) => {
                this.cannabs = response.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        activateFilter(key, value) {
            if (key == 'category') {
                if (this.checkedCategories.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.checkedCategories)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'category')
                }
            } else if (key == 'brandlist') {
                if (this.checkedBrandlist.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.checkedBrandlist)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'brandlist');
                }
            } else if (key == 'genetic') {
                if (this.checkedGenetics.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.checkedGenetics)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'genetic');
                }
            } else if (key == 'strain') {
                if (this.checkedStrains.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.checkedStrains)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'strain');
                }
            } else if (key == 'canibies') {
                if (this.checkedCan.length > 0) {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: JSON.stringify(this.checkedCan)});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'canibies');
                }
            } else if (key == 'brand') {
                if (this.brandVerified == '1') {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
                } else {
                    this.selectedFilters = _.omit(this.selectedFilters, 'brand');
                }
            } else if (key == 'price') {
                if (this.price == 'any') {
                    this.selectedFilters = _.omit(this.selectedFilters, 'price');
                } else {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
                }
            } else if (key == 'relevance') {
                if (value == 'relevance') {
                    this.selectedFilters = _.omit(this.selectedFilters, 'relevance');
                } else {
                    this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
                }
            } else {
                this.selectedFilters = Object.assign({}, this.selectedFilters, {[key]: value});
            }
        },
        changeButtonBg(current, lastPage, btn) {
            if (btn == 'prev') {
                return current == 1 ? true : false;
            } else {
                return current == lastPage ? true : false;
            }
        },
        clearFilters() {
            this.selectedFilters = {};
            this.checkedCategories = [];
            this.checkedBrandlist = [];
            this.checkedGenetics = [];
            this.checkedStrains = [];
            this.checkedCan = [];
            this.brandVerified = 0;
            this.price = 'any';
            this.relevance = 'relevance';
        },
        checkPropertyExists(property) {
            return this.selectedFilters.hasOwnProperty(property);
        },
        // ================= MOBILE SEARCH ==================
        mbSearchFormHandler() {
            this.searchDialog = false;
            this.mobileSearchTitle = this.searchQuery;
        },
        hideSearchDialog() {
            this.searchDialog = false;
            this.mbSearchFormHandler();
        },
        showSearchDialog() {
            this.searchDialog = true;
        },
        closeSearchForm() {
            this.mobileSearchTitle = '';
            this.searchQuery = '';
            this.selectedFilters = _.omit(this.selectedFilters, 'search');
            this.searchDialog = false;
        },
        // ================= MOBILE SORT ====================
        selectedSort(item) {
            this.mobileSortTitle = item.title;
            this.relevance = item.value;
            this.activateFilter('relevance', this.relevance);
            this.closeSortModal();
        },
        closeSortModal() {
            this.sortDialog = false;
        },
        showSortModal() {
            this.sortDialog = true;
        },
        removeSortKey() {
            this.closeSortModal();
            this.mobileSortTitle = 'Sort';
            this.relevance = 'relevance';
            this.selectedFilters = _.omit(this.selectedFilters, 'relevance');
        },
        // ================= MOBILE CATEGORY ====================
        selectedCategory(categories) {
            // console.log(categories[0]);
            let cat = categories[0];
            let selectedCat = this.categories.filter((item) => {
                return item.id == cat;
            });
            this.mobileCategoryTitle = selectedCat[0]['name'];
            this.checkedCategories = categories;
            this.activateFilter('category', '');
            this.closeCategoryModal();
        },
        closeCategoryModal() {
            this.categoryDialog = false;
        },
        showCategoryModal() {
            this.categoryDialog = true;
        },
        removeCategoryKey() {
            this.closeCategoryModal();
            this.checkedCategories = [];
            this.mobileCategoryTitle = 'Category';
            this.selectedFilters = _.omit(this.selectedFilters, 'category');
        },
        // ================= MOBILE PRICE ====================
        selectedPrice(item) {
            this.mobilePriceTitle = item.title;
            this.price = item.value;
            this.activateFilter('price', this.price);
            this.closePriceModal();
        },
        closePriceModal() {
            this.priceDialog = false;
        },
        showPriceModal() {
            this.priceDialog = true;
        },
        removePriceKey() {
            this.closePriceModal();
            this.mobilePriceTitle = 'Price';
            this.price = 'any';
            this.selectedFilters = _.omit(this.selectedFilters, 'price');
        },
        // ================= MOBILE GENETICS ====================
        selectedGenetic(genetics) {
            this.checkedGenetics = genetics;
            this.activateFilter('genetic', '');
            this.closeGeneticModal();
        },
        closeGeneticModal() {
            this.geneticDialog = false;
        },
        showGeneticModal() {
            this.geneticDialog = true;
        },
        removeGeneticKey() {
            this.closeGeneticModal();
            this.checkedGenetics = [];
            this.selectedFilters = _.omit(this.selectedFilters, 'genetic');
        },
        // ====================== MOBILE BRAND VERIFIED ====================
        mbBrandVerified() {
            if (this.brandVerified == '1') {
                this.brandVerified = 0;
            } else {
                this.brandVerified = 1;
            }
            this.activateFilter('brand', this.brandVerified);
        },
        // ================= MOBILE BRANDLIST ====================
        selectedBrands(brands) {
            this.checkedBrandlist = brands;
            this.activateFilter('brandlist', '');
            this.closeBrandsModal();
        },
        closeBrandsModal() {
            this.brandsDialog = false;
        },
        showBrandsModal() {
            this.brandsDialog = true;
        },
        removeBrandsKey() {
            this.closeBrandsModal();
            this.checkedBrandlist = [];
            this.selectedFilters = _.omit(this.selectedFilters, 'brandlist');
        },
        // ======================= MOBILE FILTERS =====================
        selectedFiltersModified(filters) {
            this.selectedFilters = filters;
            this.closeFiltersModal();
        },
        closeFiltersModal() {
            this.filtersDialog = false;
        },
        showFiltersModal() {
            this.filtersDialog = true;
        },
        removeFilters() {
            this.clearFilters();
            this.closeFiltersModal();
        },
        ratingResolver(rating) {
            if (rating < 1) {
                return 0;
            }
            return parseFloat(parseFloat(rating).toFixed(1));
        },
        addToCart(dispensaryProductId) {
            var dispensory_product_id = dispensaryProductId;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/addtocartdispensary",
                method: "POST",
                data: {
                    retailer_id: this.id,
                    dispensory_product_id: dispensory_product_id
                },
                success: (data) => {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        let dealsClaimedCount = parseInt($('.dealsClaimedCount:first').text().trim());
                        $('.cart-count').text(dealsClaimedCount + response.cartCount);
                        toastr.info(response.message);
                    } else if (response.statuscode == 201) {
                        toastr.error(response.message);
                    } else if (response.statuscode == 202) {
                        $("#diffdeliverycart").modal('show');
                        $(".alertmsg").html(response.message);
                        $(".newcartproductid").attr('rel', dispensory_product_id);
                        $(".newcartproductid").on('click', () => {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "/removedcartadddelivery",
                                method: "POST",
                                data: {
                                    retailer_id: this.id,
                                    dispensory_product_id: dispensory_product_id
                                },
                                success: (data) => {
                                    var response = JSON.parse(data);
                                    if (response.statuscode == 200) {
                                        $("#diffdeliverycart").modal('hide');
                                        toastr.info(response.message);
                                        $('.dealsClaimedCount').text(0);
                                        $('.cart-count').text(response.cartCount);
                                    } else {
                                        toastr.error(response.message);
                                    }
                                }
                            });
                        });
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    },
    mounted() {
        this.popupItem = this.$el;
        this.getCategories();
        this.getBrands();
        this.getGenetics();
        this.getStrains();
        this.getCannabs();
        this.getInitialProducts(1);
    },
    directives: {
        swiper: directive,
        ClickOutside
    }
}
</script>
<style scoped>
@import './css/menu.css';
.swiper-slide {
    width: auto;
}
</style>
