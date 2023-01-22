<template>
<div class="">
    <h2 style="margin-left: 10px">Deals</h2>
    <!-- <div>{{deals}}</div> -->
        <div class="featured-products">
            <div v-if="loading" class="loading-spinner">
                <p><i class="fas fa-circle-notch fa-spin"></i></p>
            </div>
            <template v-else>

                    <carousel :items="4" :dots="false" :nav="true" :responsive="{0:{items:1,nav:false},600:{items:4,nav:false}}">

                            <div class="col-12 col-md-3" style="margin-bottom: 1.5rem; width: 100%;"
                             v-for="(deal, index) in deals"
                                 :key="deal.id"
                            >
                                <div class="post-slide">
                                    <div class="card">
                                        <label class="label-off" v-if="deal.percentage > 0">{{ deal.percentage }}% off</label>

                                                <div class="post-img">
                                                    <img :src="JSON.parse(deal.picture)[0]" class="card-img-top"
                                                         alt="...">
                                                    <a :href="'/deal/'+deal.id"
                                                       class="mb-3 cursor-pointer over-layer"><i class="fa fa-link"></i>
                                                    </a>
                                                </div>
                                                <div class="p-3" style="border-top: 3px solid #f8971c;">
                                                    <span class="pnamemobile"><b>{{ business.business_name }}</b></span>
                                                        <img v-if="business.profile_picture" :src="business.profile_picture" style="width: 60px !important; height: 50px !important; float: right" class="card-img-top" alt="...">
                                                        <img v-else src="https://420finder.net/assets/img/logo.png" style="width: 60px !important; height: 50px !important; float: right" class="card-img-top" alt="...">
                                                    <h6 class="pnamemobile" ><i class="fas fa-box"></i> <b>{{ business.business_type }}</b></h6>

                                                    <div class="rating-wrap">
                                                        <star-rating :increment="0.5" :read-only="true" :rating="rating[index]" active-color="#f8971c" border-color="#f8971c" :star-size="15" :show-rating="false"></star-rating>
<!--                                                        <div class="index-rating" v-bind:data-rating="rating[index]"></div>-->
                                                        <div class="reviewAvgCount">
                                                            <span>{{ rating[index] }}</span>
                                                            <span>({{ reviews[index] }})</span>
                                                        </div>
                                                    </div>
                                                    <h6 class="pnamemobile"  >
                                                        <strong>{{ deal.title }}</strong>
                                                    </h6>
                                                    <h6 ><strong > {{ deal.deal_price }}</strong></h6>

                                            </div>

                                        </div>

                                    </div>
                            </div>

                                     <div class="container" v-if="deals.length == 0">
                                        <div class="no-deals-img">
                                            <img
                                                src="images/retailer-banners/retailerhasnodeals_banner.jpg"
                                                alt="Retailer has no deals" class="retailer-desktop-banner">
                                            <img
                                                src="images/retailer-banners/retailerhasnodeals_banner_mobile.jpg"
                                                alt="Retailer has no deals" class="retailer-mobile-banner">
                                        </div>
                                    </div>
<!--                        <template slot="next"><span class="next">next</span></template>-->
                        <template slot="prev"><span class="prev slider-btn sliderbtn" style="left: -10px !important;"><i class="fa fa-angle-left"></i></span></template>
                        <template slot="next"><span class="next slider-btn sliderbtn" style="right: -10px !important;"><i class="fa fa-angle-right"></i></span></template>
                    </carousel>
            </template>
    </div>
</div>
</template>
<script>
import axios from "axios";
import carousel from "vue-owl-carousel";
import StarRating from 'vue-star-rating';
// @import '../css/menu.css';
export default {
        props: ['deals', 'business'],
        data(){
            return{
                loading:false,
                rating:[],
                reviews:[],
            }
        },
        components: {
            carousel,
            StarRating,
        },
        methods:{
            getData(d){
                d.forEach(element => {
                    axios.get('/api/rating/get/'+element.retailer_id).then(response => {
                        this.rating.push(response.data.totalratings)
                        this.reviews.push(response.data.count)
                    })
                });

            }
        },
        mounted(){
            this.getData(this.deals)
        }
}
</script>
<style>
.sliderbtn{
    height: 40px !important;
    width: 40px !important;
    filter: drop-shadow(rgba(0, 0, 0, 0.14) 0px 0.125rem 0.25rem) drop-shadow(rgba(0, 0, 0, 0.12) 0px 0.25rem 0.3125rem) drop-shadow(rgba(0, 0, 0, 0.2) 0px 0.0625rem 0.625rem);
}
</style>
