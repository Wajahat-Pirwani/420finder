<template>
    <div style="margin-bottom: 1.3rem;">
        <div class="featured-item" style="margin-right: 1rem;">
            <!-- FEATURED ITEM HEAD -->
            <div class="featured-item-head">
                <div class="featured-item-img">
                    <a :href="featured.product_route">
                        <img :src="featured.image" alt="Featured Image">
                    </a>
                </div>
            </div>

            <!-- FEATURED ITEM BODY -->
            <div class="featured-item-body">
                <div class="ft-body-cat">
                    <span v-for="strain, index in featured.strain" :key="strain + index">{{ strain }}</span>

                    <span v-for="genetic, index in featured.genetic" :key="genetic + index">{{ genetic }}</span>
                </div>

                <div class="ft-body-title">
                    <a :href="featured.product_route">

                        <h6>{{ featured.name }}</h6>


                    </a>
                </div>

                <div class="ft-badge">
                    <template v-if="featured.brand_product">
                        <svg class="brand-icon-brand" width="18" height="18" viewBox="0 0 24 24">
                            <path class="brand-icon-brand" fill-rule="evenodd" clip-rule="evenodd"
                                  d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z"
                                  fill="#66CCFF"></path>
                        </svg>
                    </template>

                    <span>{{ featured.brand_product ? featured.brand.business_name : featured.business_name }}</span>

                    <!--                    <svg v-if="featured.verify == 1"  class="brand-icon-brand" width="18" height="18" viewBox="0 0 24 24"><path class="brand-icon-brand" fill-rule="evenodd" clip-rule="evenodd" d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z" fill="#66CCFF"></path></svg>-->

                </div>

                <div class="productButton" v-if="featured.flower_price_name == null">
                    <div class="ft-price">
                        <!-- <span>$150.00</span> -->
                        <span></span>
                        <span>${{ featured.price }}</span>
                    </div>

                    <div class="ft-quantity">
                        <button :disabled="qty <= 1 ? true : false" @click="changeQuantity('dec')">
                            -
                        </button>
                        <input type="number" v-model="qty" min="1">
                        <button @click="changeQuantity('inc')">
                            +
                        </button>
                    </div>
                    <div class="ft-cart-btn" >
                        <a href="#" v-if="islogin" class="addtocartdelivery"
                           @click.prevent="addToCart(featured.id)"
                        >Add to cart</a>
                        <a href="/signin" v-else>Add to cart</a>
                    </div>
                </div>
                <div class="productButton ft-cart-btn" v-else>
                    <a :href="featured.product_route">View Product</a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: ['featured', 'islogin', 'retailerid', 'isdispensary'],
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
    }
}
</script>

<style>

</style>
