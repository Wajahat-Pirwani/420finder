<template>
    <div class="review-wrapper" v-cloak>
        <template v-if="reviewCustomers.length > 0">
            <div class="review-head-wrap">
                <div class="review-head">
                    <h2>Reviews</h2>
                </div>
                <div class="write-review">
                    <button @click="checkReviewForm" v-if="!isReviewed">Write Review</button>
                </div>
            </div>
        </template>
        <MenuReviewDialog v-if="showLoginDialog" @hide-modal="hideModal"/>
        <form @submit.prevent="submitReview" action="#" v-if="showReviewForm && !showLoginDialog" class="review-form">
            <div class="star-rating">
                <star-rating :increment="0.5" active-color="#f8971c" border-color="#f8971c" :star-size="20"
                             v-model="boundRating" :show-rating="false" @rating-selected="setRating"></star-rating>
                <span v-if="showBoundRating" class="rating-num">{{ boundRating }}</span>
            </div>
            <textarea name="" id="" cols="30" class="form-control" v-model.trim="reviewDesc"
                      placeholder="Write a review..."></textarea>
            <button type="submit" class="mt-4 btn btn-primary"
                    style="margin-left: auto; display: inherit; background-color: #f8971c; border: 1px solid #f8971c;">
                Submit
            </button>
        </form>
        <template v-if="reviewCustomers.length > 0">
            <div class="row">
                <div class="col-12 col-md-3 details-progress-sm" style="margin-bottom: 30px;">
                    <div class="details-progress-wrap">
                        <div class="details-progress"
                             :style="{background: `conic-gradient(#f5ab24 ${reviewBackground}deg, #E6E6E6 ${reviewBackground}deg)`}">
                            <div class="details-progress-rating">
                                <span>{{ reviewRatingNumbers.reviewAvgRating }}</span>
                                <span>
                                                 <star-rating :increment="0.5" :read-only="true"
                                                              :rating="parse(reviewRatingNumbers.reviewAvgRating)"
                                                              active-color="#f8971c" border-color="#f8971c"
                                                              :star-size="15" :show-rating="false"></star-rating>
                                             </span>
                            </div>
                        </div>
                    </div>
                    <div class="details-total-reviews retailer-review">
                        <span>{{ reviewRatingNumbers.reviewTotalRating }} reviews</span>
                    </div>
                </div>
                <div class="col-12 col-md-9" style="margin-bottom: 30px;">
                    <!-- RECORD DETAILS REVIEW -->
                    <div class="record-details-item details-review">
                        <!-- DETAILS PROGRESS WRAP -->
                        <div class="details-progress-bar-wrap">
                            <!-- 5 stars -->
                            <div class="details-progress-bar retailer-review">
                                <div class="progress-wrap">
                                    <span>5 stars</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-five" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating"
                                             :style="{width: reviewResolver(reviewRatingNumbers.reviewFiveRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                    </div>
                                    <span>{{ reviewRatingNumbers.reviewFiveRating }}</span>
                                </div>
                            </div>
                            <!-- 4 stars -->
                            <div class="details-progress-bar retailer-review">
                                <div class="progress-wrap">
                                    <span>4 stars</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-four" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating"
                                             :style="{width: reviewResolver(reviewRatingNumbers.reviewFourRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                    </div>
                                    <span>{{ reviewRatingNumbers.reviewFourRating }}</span>
                                </div>
                            </div>
                            <!-- 3 stars -->
                            <div class="details-progress-bar retailer-review">
                                <div class="progress-wrap">
                                    <span>3 stars</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-three" role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0"
                                             :aria-valuemax="reviewRatingNumbers.reviewTotalRating"
                                             :style="{width: reviewResolver(reviewRatingNumbers.reviewThreeRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                    </div>
                                    <span>{{ reviewRatingNumbers.reviewThreeRating }}</span>
                                </div>
                            </div>
                            <!-- 2 stars -->
                            <div class="details-progress-bar retailer-review">
                                <div class="progress-wrap">
                                    <span>2 stars</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-two" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating"
                                             :style="{width: reviewResolver(reviewRatingNumbers.reviewTwoRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                    </div>
                                    <span>{{ reviewRatingNumbers.reviewTwoRating }}</span>
                                </div>
                            </div>
                            <!-- 1 stars -->
                            <div class="details-progress-bar retailer-review">
                                <div class="progress-wrap">
                                    <span>1 stars</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-one" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating"
                                             :style="{width: reviewResolver(reviewRatingNumbers.reviewOneRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                    </div>
                                    <span>{{ reviewRatingNumbers.reviewOneRating }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- DETAILS PROGRESS WRAP ENDS -->
                    </div>
                    <!-- RECORD DETAILS REVIEW ENDS-->
                </div>
            </div>
            <!-- CUSTOMER REVIEW WRAP -->
            <div class="customer-review-wrap">
                <!-- CUSTOMER REVIEW ITEM -->
                <div class="customer-review-item" v-for="item in reviewCustomers" :key="item.id">
                    <div class="customer-review-head">
                        <div class="customer-review-head-img">
                            <img src="https://420finder.net/assets/img/logo.png" alt="User Profile"
                                 v-if="item.customer_profile == 'true'">
                            <img :src="item.customer_profile" alt="User Profile" v-else>
                        </div>
                        <div class="customer-review-head-content">
                            <span>{{ item.customer_name }}</span>
                            <span>{{ item.date_time }}</span>
                        </div>
                    </div>
                    <div class="customer-review-body">
                        <div class="customer-review-rating">
                            <div class="customer-review-rating-star">
                                <star-rating :increment="0.5" :read-only="true" :rating="parse(item.rating)"
                                             active-color="#f8971c" border-color="#f8971c" :star-size="15"
                                             :show-rating="false"></star-rating>
                            </div>
                            <div class="review-avg">
                                <span>{{ item.rating }}</span>
                            </div>
                        </div>
                        <div class="customer-review-desc">
                            <p>
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="pagination" style="background: #fff" v-if="pagination.total > 50">
                    <button
                        :disabled="changeButtonBg(pagination.current_page, pagination.current_page, 'prev')"
                        :class="{'grey_bg': changeButtonBg(pagination.current_page, pagination.current_page, 'prev')}"
                        @click="getRetailerReviews(pagination.current_page - 1)">
                        <svg width="8px" height="14px">
                            <path fill="#999999" transform="rotate(180 4 7)"
                                  d="M7.533 6.538L8 7l-.467.462L.933 14 0 13.075l6.6-6.537v.924L0 .925.933 0z"></path>
                        </svg>
                    </button>
                    <select name="" id="" @change="getRetailerReviews($event.target.value)" class="form-control">
                        <option :value="page" v-for="page in pagination.last_page" :key="page"
                                :selected="(pagination.current_page == page) ? 'selected' : '' ">Page {{ page }} of
                            {{ pagination.last_page }}
                        </option>
                    </select>
                    <button
                        :disabled="changeButtonBg(pagination.current_page, pagination.last_page, 'next')"
                        :class="{'grey_bg': changeButtonBg(pagination.current_page, pagination.last_page, 'next')}"
                        @click="getRetailerReviews(pagination.current_page + 1)"
                    >
                        <svg width="8px" height="14px">
                            <path fill="#999999" transform="rotate(0 0 0)"
                                  d="M7.533 6.538L8 7l-.467.462L.933 14 0 13.075l6.6-6.537v.924L0 .925.933 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- CUSTOMER REVIEW WRAP ENDS -->
        </template>
        <template v-else>
            <div>
                <a href="#" @click.prevent="checkReviewForm">
                    <img :src="desktop" alt="No review banner" class="retailer-desktop-banner">
                    <img :src="mobile" alt="No review banner" class="retailer-mobile-banner">
                </a>
            </div>
        </template>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating'
import MenuReviewDialog from '../dialog/MenuReviewDialog.vue';
export default {
    props: ['retailerid', 'user', 'isreviewed', 'desktop', 'mobile'],
    components: {
        StarRating,
        MenuReviewDialog,
    },
    data() {
        return {
            isReviewed: this.isreviewed,
            retailerId: this.retailerid,
            reviewBackground: 0,
            reviewRatingNumbers: [],
            reviewCustomers: [],
            pagination: {},
            showLoginDialog: false,
            showReviewForm: false,
            boundRating: 0,
            showBoundRating: false,
            reviewDesc: ""
        }
    },
    methods: {
        async getRetailerReviews(page = 1) {
            if (page <= 0 || page > this.pagination.last_page) {
                return;
            }
            await axios.get(`/api/menu/get-retailer-reviews/${this.retailerId}?page=${page}`).then((response) => {
                this.reviewCustomers = response.data.data;
                this.pagination = response.data.meta;
                this.reviewRatingNumbers = response.data.reviewsNumbers;
                this.reviewBarSmooth(this.reviewRatingNumbers.reviewAvgRating);
            }).catch((err) => {
                console.log(err);
            });
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
        link(businessType, business_name, businessId, routeUrl) {
            if (businessType == 'Delivery') {
                return `${routeUrl}/deliveries/${business_name}/${businessId}`;
            } else if (businessType == 'Dispensery') {
                return `${routeUrl}/dispensaries/${business_name}/${businessId}`;
            } else {
                return `${routeUrl}/brand/${business_name}/${businessId}`;
            }
        },
        reviewResolver($reviewNum, $totalReviews) {
            return ($reviewNum) * 100 / ($totalReviews) + '%';
        },
        reviewBarSmooth(reviewAvg) {
            var reviewAvg = Math.round(reviewAvg * 76);
            if (reviewAvg == 0) {
                return;
            }
            var review = this;
            let reviewInterval = setInterval(() => {
                review.reviewBackground++;
                if (review.reviewBackground == reviewAvg) {
                    clearInterval(reviewInterval);
                }
            }, 1);
        },
        parse(rating) {
            return parseFloat(rating);
        },
        changeButtonBg(current, lastPage, btn) {
            if (btn == 'prev') {
                return current == 1 ? true : false;
            } else {
                return current == lastPage ? true : false;
            }
        },
        checkReviewForm() {
            if (this.user) {
                this.showReviewForm = true;
            } else {
                this.showLoginDialog = true;
            }
        },
        hideModal() {
            this.showLoginDialog = false;
        },
        setRating: function (rating) {
            this.showBoundRating = true;
        },
        submitReview() {
            if (this.reviewDesc == "" || this.boundRating == 0) {
                alert('Please fill the details');
                return;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/submit-review",
                method: "POST",
                data: {
                    retailer_id: this.retailerId,
                    rating_num: this.boundRating,
                    rating_desc: this.reviewDesc
                },
                success: (data) => {
                    var response = data;
                    if (response.status == 200) {
                        toastr.info(response.message);
                        this.isReviewed = true;
                        this.showReviewForm = false;
                        this.getRetailerReviews();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: (data) => {
                    toastr.error('Sorry something went wrong');
                }
            });
        }
    },
    created() {
        this.getRetailerReviews();
    }
}
</script>
<style scoped>
@import url('../css/review.css');
</style>
