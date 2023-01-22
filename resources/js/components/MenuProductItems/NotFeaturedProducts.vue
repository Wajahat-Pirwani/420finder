<template>
    <div class="rest-product-item">
        <div class="product-item-left">
            <div class="product-item-img">
                <a :href="product.product_route">
                    <img :src="product.image" alt="Product Item Img">
                </a>
            </div>
            <div class="product-item-inner">
                <div class="product-item-cat">

                    <span v-for="strain, index in product.strain" :key="strain + index">{{ strain }}</span>

                    <span v-for="genetic, index in product.genetic" :key="genetic + index">{{ genetic }}</span>
                </div>

                <div class="product-item-title">
                    <a :href="product.product_route">
                        <h6>{{ product.name }}</h6>
                    </a>
                </div>

                <div class="product-item-badge">
                    <template v-if="product.brand_product">
                        <svg class="brand-icon-brand" width="18" height="18" viewBox="0 0 24 24">
                            <path class="brand-icon-brand" fill-rule="evenodd" clip-rule="evenodd"
                                  d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z"
                                  fill="#66CCFF"></path>
                        </svg>
                    </template>
                    <span>{{ product.brand_product ? product.brand.business_name : product.business_name }}</span>
                    <p><b>{{ product.category_name[0] }}</b></p>
                </div>

                <div class="product-item-percent">
                    <span>{{ product.thc_percentage }}% THC</span>
                    <span>{{ product.cbd_percentage }}% CBD</span>
                </div>

                <div class="record-item-reviews">
                    <div class="rating-icon">
                        <star-rating :increment="0.5" :read-only="true" :rating="ratingResolver(product.rating)"
                                     active-color="#f8971c" border-color="#f8971c" :star-size="15"
                                     :show-rating="false"></star-rating>
                    </div>
                    <div class="rating-avg">
                        <span>{{ ratingResolver(product.rating) }}</span>
                    </div>
                    <div class="rating-total">
                        <span>({{ product.reviewCount }})</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="product-item-right" v-if="product.flower_price_name == null">
            <div class="product-price">
                <span>${{ product.price }}</span>
                <!--                                <span>per 1/8 oz</span>-->
            </div>
            <div class="ft-quantity nfp-quantity">
                <button :disabled="qty <= 1 ? true : false" @click="changeQuantity('dec')">
                    -
                </button>
                <input type="number" v-model="qty" min="1">
                <button @click="changeQuantity('inc')">
                    +
                </button>
            </div>

            <div class="product-cart-btn">
                <a href="#" v-if="islogin" @click.prevent="addToCart(product.id)">Add to cart</a>
                <a href="/signin" v-else>Add to cart</a>
            </div>
        </div>
        <div class="productButton ft-cart-btn" v-else>
            <a :href="product.product_route">View Product</a>
        </div>
        <!-- Product Item Ends -->

    </div>
</template>

<script>

import StarRating from 'vue-star-rating';

export default {
    props: ['product', 'islogin', 'retailerid', 'isdispensary'],
    components: {
        StarRating
    },
    data() {
        return {
            qty: 1
        }
    },
    watch: {
        qty() {
            if (this.qty < 1) {
                this.qty = 1;
            }
        }
    },
    methods: {
        addToCart(deliveryProductId) {

            var dispensory_product_id = deliveryProductId;

            let url = "";

            if (this.isdispensary) {
                url = "/addtocartdispensary";
            } else {
                url = "/addtocartdelivery";
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {
                    retailer_id: this.retailerid,
                    dispensory_product_id: dispensory_product_id,
                    qty: this.qty
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
                                    retailer_id: this.retailerid,
                                    dispensory_product_id: dispensory_product_id,
                                    qty: this.qty
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
        },
        changeQuantity($val) {
            if ($val == 'inc') {
                this.qty++;
            } else {
                if (this.qty == 0) {
                    this.qty = 1;
                } else {
                    this.qty--;
                }
            }
        },
        ratingResolver(rating) {
            if (rating < 1) {
                return 0;
            }

            return parseFloat(parseFloat(rating).toFixed(1));
        },
    }
}
</script>
