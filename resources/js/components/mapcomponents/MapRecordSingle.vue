<template>
    <!-- RECORD SINGLE -->
     <div class="record-single">
                    <div class="results-sort">
                        <div class="results-sort-result r-s-head" @click="$emit('showResultFull')">
                            <h5><svg class="finder-icon finder-arrow" width="12px" height="12px" viewBox="0 0 451.847 451.847" style="transform: rotate(90deg);"><path fill="currentColor" d="M225.923 354.706c-8.098 0-16.195-3.092-22.37-9.263L9.27 151.157c-12.36-12.36-12.36-32.397 0-44.75 12.354-12.355 32.388-12.355 44.748 0L225.923 278.32 397.83 106.413c12.358-12.354 32.39-12.354 44.743 0 12.365 12.354 12.365 32.392 0 44.75L248.293 345.45c-6.178 6.17-14.275 9.256-22.37 9.256z"></path></svg> Back to results</h5>
                        </div>
                    </div>

                    <!-- RECORD ITEM -->
                    <div class="record-item">
                        <!-- RECORD ITEM CONTENT -->
                        <div class="record-item-content">
                           <div class="record-item-img">
                                <img src="https://420finder.net/assets/img/logo01.png" alt="" v-if="singleRecord.profile_picture == '' || singleRecord.profile_picture == 'NULL'|| singleRecord.profile_picture == 'https://images.weedmaps.com/original/image_missing.jpg'">
                                <img onerror="this.src='https://420finder.net/assets/img/logo01.png'" :src="singleRecord.profile_picture" alt="Business Image" v-else>
                            </div>
                            <div class="record-item-info">
                                <div class="record-item-title">
                                     <h5>{{ singleRecord.business_name }}</h5>
                                </div>
                                <div class="record-item-reviews">
                                    <div class="rating-icon">
                                         <star-rating :increment="0.5" :read-only="true" :rating="parseFloat(singleRecord.rating)" active-color="#f8971c" border-color="#f8971c" :star-size="15" :show-rating="false"></star-rating>
                                        </div>
                                        <div class="rating-avg">
                                            <span>{{ singleRecord.rating }}</span>
                                        </div>
                                        <div class="rating-total">
                                            <span>({{ singleRecord.reviewCount }})</span>
                                    </div>
                                </div>
                                <div class="record-brand">
                                     <h5>
                                       <span>{{ singleRecord.business_type }} </span>
                                     </h5>
                                </div>
                                <div class="record-item-tag">
                                    <span>{{ checkTime(singleRecord.opening_time, singleRecord.closing_time) }}</span>
                                    <span>Order online</span>
                                    <span>Curbside pickup</span>
                                </div>
                            </div>
                            </div>
                        <!-- RECORD ITEM CONTENT -->

                        <!-- RECORD EMAIL -->
                        <div class="call-email-wrap">
                            <div class="call-email-item">
                                <div class="icon">
                                    <svg class="finder-icon-phone" width="20px" height="20px" fill="#f8971c" viewBox="0 0 24 24"><path fill="#f8971c" d="M6.65 10.02c.12.28 2.07 4.94 7.43 7.23l1.7-1.72c.3-.3.75-.4 1.14-.26 1.25.4 2.6.63 3.97.63.61 0 1.11.5 1.11 1.11v3.88c0 .61-.5 1.11-1.11 1.11A18.89 18.89 0 012 3.11C2 2.5 2.5 2 3.11 2H7c.61 0 1.11.5 1.11 1.11 0 1.39.22 2.72.63 3.97.13.39.04.82-.27 1.13l-1.82 1.81z"></path></svg>
                                </div>
                                <span class="icon-text">Call</span>
                            </div>
                            <div class="call-email-item">
                                <div class="icon">
                                    <svg class="finder-icon-envelope" width="20px" height="20px" fill="#f8971c" viewBox="0 0 24 24"><path fill="#f8971c" fill-rule="evenodd" d="M4 5h16c1.1 0 2 .79 2 1.75v.88l-10 5.74L2 7.63l.01-.88C2.01 5.79 2.9 5 4 5zM2 9.93v-2.3 2.3zm20 0l-10 5.73L2 9.93v7.32c0 .96.9 1.75 2 1.75h16c1.1 0 2-.79 2-1.75V9.92z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="icon-text">Email</span>
                            </div>
                            <div class="call-email-item">
                                <div class="icon">
                                      <svg aria-hidden="true" width="20px" height="20px" viewBox="0 0 420 420" fill="#f8971c"><path d="M385 171c0 3-2 6-5 10l-77 78 18 111v4c0 3 0 6-2 8-1 2-3 3-6 3l-9-3-94-52-94 52-9 3c-3 0-5-1-6-3-2-2-3-5-3-8l1-4 18-111-77-78c-3-4-5-7-5-10 0-6 4-9 12-11l105-16 48-100c2-6 6-9 10-9s8 3 10 9l48 100 105 16c8 2 12 5 12 11z"></path></svg>
                                </div>
                                <span class="icon-text">Review</span>
                            </div>
                        </div>
                        <!-- RECORD EMAIL ENDS -->

                        <div class="record-item-link">
                        <a :href="link(singleRecord.business_type, singleRecord.business_name, singleRecord.id, singleRecord.route)">View menu</a>
                         </div>

                         <!-- RECORD DETAILS CONTENT -->
                         <div class="record-details-content">
                             <!-- RECORD DETAILS TIME -->
                             <div class="record-details-item">
                                 <h3>Hours of Operation</h3>
<!--                                    {{tConvert(singleRecord.monday_open)}}-->
                                 <div class="delivery-time delivery-common record-details-time">

                                <div class="time-icon">
                                <svg height="20px" width="20px" viewBox="0 0 24 24"><path fill="#999999" d="M11.805 14.019H7.94a1.21 1.21 0 1 1 0-2.418h2.657V7.25a1.21 1.21 0 0 1 2.419 0v5.559a1.21 1.21 0 0 1-1.21 1.209M12 4.04C7.611 4.04 4.04 7.61 4.04 12c0 4.389 3.571 7.96 7.96 7.96 4.389 0 7.96-3.571 7.96-7.96 0-4.389-3.571-7.96-7.96-7.96M12 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10"></path></svg>
                                </div>
                                <div class="time-content">
                                    <h6> OPEN NOW</h6>
                                    <div class="week-content-wrap">
                                    <!-- MONDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Monday</span>
                                            </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.monday_open)}} - {{tConvert(singleRecord.monday_close)}}</span>
                                           </div>
                                      </div>

                                     <!-- TUESDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Tuesday</span>
                                            </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.tuesday_open)}} - {{tConvert(singleRecord.tuesday_close)}}</span>
                                           </div>
                                      </div>

                                    <!-- WEDNESDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Wednesday</span>
                                            </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.wednesday_open)}} - {{tConvert(singleRecord.wednesday_close)}}</span>
                                           </div>
                                      </div>

                                    <!-- THURSDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Thursday</span>
                                            </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.thursday_open)}} - {{tConvert(singleRecord.thursday_close)}}</span>
                                           </div>
                                      </div>

                                     <!-- FRIDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Friday</span>
                                            </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.friday_open)}} - {{tConvert(singleRecord.friday_close)}}</span>
                                           </div>
                                      </div>

                                     <!-- SATURDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Saturday</span>
                                            </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.saturday_open)}} - {{tConvert(singleRecord.saturday_close)}}</span>
                                           </div>
                                      </div>

                                     <!-- SUNDAY -->
                                    <div class="week-content">
                                        <div class="week-day">
                                          <span>Sunday</span>
                                        </div>
                                        <div class="week-time">
                                            <span>{{tConvert(singleRecord.sunday_open)}} - {{tConvert(singleRecord.sunday_close)}}</span>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                                 </div>
                             </div>

                            <template v-if="Object.keys(retailerDetail).length > 0">
                             <!-- RECORD DETAILS INTRODUCTION -->
                             <div class="record-details-item">
                                 <h3>Introduction</h3>
                                 <div class="detail-intro-content" v-html="retailerDetail.introduction"></div>
                             </div>
                             <!-- RECORD DETAILS AMENITIES -->
                             <div class="record-details-item">
                                 <h3>Amenities</h3>

                                <div class="detail-ameni-content d-flex">

                                    <div v-for="(value, index) in amenities" :key="index">

                                        <div class="detail-ameni-item" v-if="(index == 'brand_verified' && value == 'on')
                                         " :key="index">
                                        <svg width="24" height="24" viewBox="0 0 24 24" class="finder-icon-brand"><path fill-rule="evenodd" clip-rule="evenodd" d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z" fill="#7C7C7C" class="finder-icon-brand"></path></svg>
                                         <span>Brand Verified</span>
                                        </div>

                                         <div class="detail-ameni-item" v-if="(index == 'access' && value == 'off')">
                                                    <svg class="finder-icon-accessible" width="24px" height="24px" viewBox="-2 0 20 20"><path fill="#7C7C7C" d="M7.73 18.734c-.15 0-.3-.005-.45-.014-3.74-.24-6.583-3.4-6.338-7.042.08-1.16.472-2.284 1.14-3.25.284-.412 1.82.595 1.534 1.008-.484.7-.77 1.517-.827 2.36-.18 2.65 1.89 4.95 4.612 5.125 1.982.128 3.848-.91 4.743-2.648.23-.445 1.883.364 1.654.81-1.162 2.253-3.51 3.652-6.07 3.652zm-.455-3.8c-.302 0-.598-.143-.776-.408L4.813 12.01c-.12-.18-.17-.393-.142-.603l.37-2.975c.064-.494.525-.845 1.033-.784.507.06.867.51.804 1.005L6.55 11.3l1.5 2.24c.28.417.158.976-.27 1.248-.156.1-.33.146-.505.146zM6.322 6.96c-.068 0-.136-.003-.205-.007C5.295 6.9 4.544 6.54 4 5.935c-.543-.603-.813-1.376-.758-2.177.11-1.64 1.585-2.897 3.28-2.8.822.05 1.573.412 2.117 1.016.542.603.812 1.377.757 2.178C9.29 5.726 7.94 6.96 6.322 6.96zm10.475 8.885c-.02 0-.04 0-.06-.002l-1.233-.08c-.42-.026-.768-.325-.848-.728l-.493-2.49c-.025-.128-.11-.2-.157-.23-.047-.032-.148-.08-.278-.056l-3.983.767c-.495.098-.988-.22-1.087-.71-.1-.488.227-.962.728-1.06l3.983-.767c.583-.11 1.177.004 1.67.328.493.323.828.816.94 1.385l.358 1.808.518.033c.51.033.897.462.864.96-.033.476-.44.842-.923.842z"></path></svg>
                                                    <span>Accessible</span>

                                         </div>

                                         <div class="detail-ameni-item" v-if="(index == 'security' && value == 'on')">
                                                    <svg class="finder-icon-solid-lock" height="24px" width="24px" viewBox="0 0 24 24"><path fill="#7C7C7C" d="M10.268 18.408c.196.19.45.294.715.294.265 0 .519-.105.715-.294l3.612-3.496c.469-.454.469-1.25 0-1.704a1.025 1.025 0 0 0-.715-.294c-.265 0-.52.105-.715.294l-2.672 2.587a.306.306 0 0 1-.45 0l-.702-.68a1.025 1.025 0 0 0-.715-.293c-.266 0-.52.104-.715.293l-.092.09v.012a1.21 1.21 0 0 0 .092 1.602l1.642 1.59zM5.7 19.551h12.6v-7.423H5.7v7.423zM8.246 9.48V7.803c0-1.9 1.633-3.446 3.64-3.446 2.006 0 3.639 1.546 3.639 3.446v1.68c0 .132.024.259.067.378H8.18c.042-.119.066-.246.066-.378zm11.384.379h-1.683c.042-.119.066-.246.066-.378v-1.68c0-3.2-2.749-5.802-6.127-5.802-3.379 0-6.128 2.603-6.128 5.802v1.68c0 .132.024.259.067.378H4.307C3.585 9.86 3 10.414 3 11.097v9.495c0 .683.585 1.237 1.307 1.237H19.63c.72 0 1.306-.554 1.306-1.237v-9.495c0-.683-.585-1.237-1.306-1.237z"></path></svg>
                                                    <span>Security</span>

                                         </div>
                                    </div>

                                 </div>

                             </div>
                             <!-- RECORD DETAILS AMENITIESE ENDS -->
                            </template>

                             <!-- RECORD DETAILS REVIEW -->
                             <div class="record-details-item details-review">
                                 <div class="details-progress-wrap">
                                     <div class="details-progress" :style="{background: `conic-gradient(#f5ab24 ${reviewBackground}deg, #E6E6E6 ${reviewBackground}deg)`}">
                                         <div class="details-progress-rating">
                                             <span>{{ singleRecord.rating }}</span>
                                             <span>
                                                 <star-rating :increment="0.5" :read-only="true" :rating="parseFloat(singleRecord.rating)" active-color="#f8971c" border-color="#f8971c" :star-size="15" :show-rating="false"></star-rating>
                                             </span>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="details-total-reviews">
                                     <span>{{ singleRecord.reviewCount }} reviews</span>
                                 </div>

                                <!-- DETAILS PROGRESS WRAP -->
                                <div class="details-progress-bar-wrap">
                                <!-- 5 stars -->
                                <div class="details-progress-bar">
                                     <div class="progress-wrap">
                                        <span>5 stars</span>
                                        <div class="progress">
                                        <div class="progress-bar progress-bar-five" role="progressbar" aria-valuenow="0" aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating" :style="{width: reviewResolver(reviewRatingNumbers.reviewFiveRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                        </div>
                                        <span>{{ reviewRatingNumbers.reviewFiveRating }}</span>
                                     </div>
                                </div>

                                <!-- 4 stars -->
                                <div class="details-progress-bar">
                                     <div class="progress-wrap">
                                        <span>4 stars</span>
                                        <div class="progress">
                                        <div class="progress-bar progress-bar-four" role="progressbar" aria-valuenow="0" aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating" :style="{width: reviewResolver(reviewRatingNumbers.reviewFourRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                        </div>
                                        <span>{{ reviewRatingNumbers.reviewFourRating }}</span>
                                      </div>
                                </div>

                                <!-- 3 stars -->
                                <div class="details-progress-bar">
                                     <div class="progress-wrap">
                                        <span>3 stars</span>
                                        <div class="progress">
                                        <div class="progress-bar progress-bar-three" role="progressbar" aria-valuenow="0" aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating" :style="{width: reviewResolver(reviewRatingNumbers.reviewThreeRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                        </div>
                                        <span>{{ reviewRatingNumbers.reviewThreeRating }}</span>
                                      </div>
                                </div>

                                <!-- 2 stars -->
                                <div class="details-progress-bar">
                                     <div class="progress-wrap">
                                        <span>2 stars</span>
                                        <div class="progress">
                                        <div class="progress-bar progress-bar-two" role="progressbar" aria-valuenow="0" aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating" :style="{width: reviewResolver(reviewRatingNumbers.reviewTwoRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                        </div>
                                        <span>{{ reviewRatingNumbers.reviewTwoRating }}</span>
                                      </div>
                                </div>

                                <!-- 1 stars -->
                                <div class="details-progress-bar">
                                     <div class="progress-wrap">
                                        <span>1 stars</span>
                                        <div class="progress">
                                        <div class="progress-bar progress-bar-one" role="progressbar" aria-valuenow="0" aria-valuemin="0" :aria-valuemax="reviewRatingNumbers.reviewTotalRating" :style="{width: reviewResolver(reviewRatingNumbers.reviewOneRating, reviewRatingNumbers.reviewTotalRating)}"></div>
                                        </div>
                                        <span>{{ reviewRatingNumbers.reviewOneRating }}</span>
                                       </div>
                                </div>
                                </div>
                                <!-- DETAILS PROGRESS WRAP ENDS -->

                                <!-- DETAILS REVIEW LINK -->
                                <div class="details-review-link">
                                    <a :href="link(singleRecord.business_type, singleRecord.business_name, singleRecord.id, singleRecord.route)">See all reviews</a>
                                </div>
                                <!-- DETAILS REVIEW LINK ENDS -->
                             </div>
                             <!-- RECORD DETAILS REVIEW ENDS-->

                            <!-- RECORD DETAILS BTN -->
                             <div class="record-details-item record-details-btn">
                                 <a :href="link(singleRecord.business_type, singleRecord.business_name, singleRecord.id, singleRecord.route)">View the full listing</a>
                             </div>
                            <!-- RECORD DETAILS BTN ENDS -->

                         </div>
                         <!-- RECORD DETAILS CONTENT ENDS-->

                    </div>
                    <!-- RECORD ITEM ENDS-->
                 </div>
            <!-- RECORD SINGLE ENDS -->
</template>

<script>

import StarRating from 'vue-star-rating'

export default {
    props: ['singleRecord'],
    components: {
       StarRating
    },
    data() {
        return {
            retailerDetail: {},
            amenities: {},
            reviewBackground: 0,
            reviewRatingNumbers: []
        }
    },
    watch: {
        singleRecord: function (newVal, oldVal) { // watch it
            this.getRetailorDetails();
            this.getRetailerReviews();
        },
    },
    methods: {
        tConvert (time) {
            if(time != null){
                // Check correct time format and split into components
                time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                if (time.length > 1) { // If time format correct
                    time = time.slice (1);  // Remove full string match value
                    time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                    time[0] = +time[0] % 12 || 12; // Adjust hours
                }
                return time.join (''); // return adjusted time or original string
            }else{
                return 'Closed'
            }

        },
        async getRetailorDetails() {
            await axios.get(`/api/map/get-retailer-details/${this.singleRecord.id}`).then((response) => {
                this.retailerDetail = response.data.data;
                this.amenities = JSON.parse(this.retailerDetail.amenities);
            }).catch((err) => {
                console.log(err);
            });
        },
        async getRetailerReviews() {
            await axios.get(`/api/map/get-retailer-reviews/${this.singleRecord.id}`).then((response) => {
                this.reviewRatingNumbers = response.data.reviewsNumbers;
                this.reviewBarSmooth(this.singleRecord.rating)
                // this.reviewBarSmooth(this.reviewRatingNumbers.reviewAvgRating);
            }).catch((err) => {
                console.log(err);
            });
        },
        checkTime(openingTime, closingTime) {
        const d = new Date();
        let time = d.getHours() + ':' + d.getMinutes();
        if(time >= openingTime && time <= closingTime) {
            return 'Open now';
        } else {
            return 'Closed';
        }
       },
       link(businessType, business_name, businessId, routeUrl) {
            if(businessType == 'Delivery') {
                return `${routeUrl}/deliveries/${business_name}/${businessId}`;
            } else if(businessType == 'Dispensary') {
                return `${routeUrl}/dispensaries/${business_name}/${businessId}`;
            } else if(businessType == 'Brand') {
                return `${routeUrl}/brand/${businessId}`;
            }else {
                return '/maps'
            }
        },
        reviewResolver($reviewNum, $totalReviews) {
            return ($reviewNum)*100/($totalReviews)+'%';
        },
        reviewBarSmooth(reviewAvg) {
            this.reviewBackground = 0
            var reviewAvg = Math.round(reviewAvg * 76);
            if(reviewAvg == 0) {
                return;
            }
            var review = this;
            let reviewInterval = setInterval(() => {
              review.reviewBackground++;
              if(review.reviewBackground == reviewAvg){
                  clearInterval(reviewInterval);
              }
            }, 1);
            console.log(this.reviewBackground)
        }
    },
    mounted() {
        this.getRetailorDetails();
        this.getRetailerReviews();
    }
}
</script>

<style>

</style>
