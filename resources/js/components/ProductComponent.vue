<template>

    <div class="col-6 d-flex align-items-center search-product-wrap product-ret-wrap px-0">
            <span class="searchIcon">
                <i class="fas fa-search"></i>
            </span>

         <div class="search-product">

            <input type="text" name="keyword" placeholder="Products, retailers, brands, and more" v-model="searchQuery" @focus="showCardOnFocus()" autocomplete="off">
        </div>

        <!-- SEARCH RESULTS -->
        <div class="search-results" v-click-outside="cardHide" v-show="cardVisible">
            <div class="search-query">
                <h5 v-if="searchQuery.length >= 2">Search results for "{{ searchQuery }}"</h5>
            </div>
            <div v-if="loading" class="loading-spinner">
                <p><i class="fas fa-circle-notch fa-spin"></i></p>
            </div>
            <div v-else>
                <template v-if="productsResult.length > 0">
                    <a :href="product.product_route" class="search-result-link" v-for="product in productsResult" :key="`${product.slug}-${product.id}`">
                    <div class="search-result-item">
                        <div class="search-result-item-img">
                            <img :src="product.image" alt="Search Item Img">
                        </div>
                        <div class="search-result-item-title">
                            <h5>{{ product.name }}</h5>
                            <p v-html="product.description"></p>
                        </div>
                    </div>
                    </a>
                </template>

                <template v-if="searchResult.length > 0">
                      <a :href="link(result.business_type, result.business_name, result.id, result.route_url)" class="search-result-link" v-for="result in searchResult" :key="result.id">
                <div class="search-result-item">
                    <div class="search-result-item-img">
                        <img :src="result.profile_picture" alt="Search Item Img">
                    </div>
                    <div class="search-result-item-title">
                        <h5>{{ result.business_name }}</h5>
                        <p>{{ result.address_line_1 }}</p>
                    </div>
                </div>
                </a>
                </template>
                 <div v-else-if="productsResult.length < 1 && searchResult.length < 1" class="no-result-content">
                    <p>No results found</p>
                 </div>
            </div>

        </div>

    </div>
</template>

<script>

import ClickOutside from 'vue-click-outside';

export default {
    data() {
        return {
            searchQuery: '',
            searchResult: [],
            loading: false,
            cardVisible: false,
            productsResult: [],
        }
    },
    watch: {
        searchQuery: _.debounce(function(val){
                    if(val.length >= 3) {
                        this.cardVisible = true;
                        this.getSearchResults(val)
                    } else {
                        this.cardVisible = false;
               }
        }, 500),
    },
    methods: {
        cardHide() {
            this.cardVisible = false;
        },
        showCardOnFocus() {
            if(this.searchQuery.length >= 3) {
                this.cardVisible = true;
            }
        },
        link(businessType, business_name, businessId, routeUrl) {
            if(businessType == 'Delivery') {
                return `${routeUrl}/deliveries/${business_name}/${businessId}`;
            } else if(businessType == 'Dispensary') {
                return `${routeUrl}/dispensaries/${business_name}/${businessId}`;
            } else {
                return `${routeUrl}/brand/${businessId}`;
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
            }).catch((err) =>{
                this.loading = false;
               // console.log(err);
            });

        }
    },
    mounted() {
         this.popupItem = this.$el;
    },
     directives: {
      ClickOutside
    }
}

</script>

<style scoped>
    .product-ret-wrap {
        position: relative;
    }

    .search-results {
        position: absolute;
        top: 35px;
        left: -8px;
        width: 102.5%;
        background-color: #fff;
        overflow-y: auto;
        padding-top: 0.8rem;
        border: 1px solid rgb(238, 238, 238);
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .search-results .search-query h5 {
        font-size: 0.8rem;
        font-weight: 600;
        color: #f8971c;
        padding-left: 1rem;
    }

    .search-results a.search-result-link {
        display: block;
    }

    .search-results a.search-result-link:hover {
        background-color: #F2F5F5;
    }

    .search-results a.search-result-link:hover h5 {
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
