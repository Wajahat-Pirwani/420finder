<template>
    <div class="container">
        <div class="retailers-near-by">
            <h6 style="font-weight: 600;font-size: 1.4rem;margin-bottom: 1rem;">Retailers nearby</h6>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="record-items">
                    <div class="record-item" v-for="item in currentFeatures" :key="item.id">
                        <a :href="routeResolver(item)" style="display: block;">
                             <div class="record-item-content">
                            <div class="record-item-img">
                                <img src="https://420finder.net/assets/img/logo.png" alt="420 finder logo" v-if="item.profile_picture == '' || item.profile_picture == 'NULL'">
                            <img :src="item.profile_picture" alt="Business Image" v-else>
                            </div>
                            <div class="record-item-info">
                                <div class="record-item-title">
                                    <h5>{{ item.business_name }}</h5>
                                </div>
                                <div class="record-item-reviews">
                                    <div class="rating-icon">
                                        <star-rating :increment="0.5" :read-only="true" :rating="ratingResolver(item.rating)" active-color="#f8971c" border-color="#f8971c" :star-size="15" :show-rating="false"></star-rating>
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
                        </a>
                    </div>

                    <div v-if="currentFeatures.length > 3" class="record-item-link">
                        <a :href="routeMap">
                            View all retailers
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="map-container">
                    <div id="map">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import mapboxgl from "mapbox-gl";
import StarRating from 'vue-star-rating';

export default {
    props: ['latitude', 'longitude', 'categoryid'],
    components: {
         StarRating,
    },
    data() {
        return {
            map: null,
            lat: this.latitude,
            lng: this.longitude,
            markers: [],
            currentFeatures: [],
            categoryId: this.categoryid,
            routeMap: ''
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
    }
    },
    methods: {
    resetMarkers() {
        this.markers.forEach((marker) => {
            marker.remove();
        });
        this.markers = [];
    },
    updateMarkers() {
        // this.markers =
     this.markers = this.currentFeatures.map((feature) => {

        const el = this.getBusinessMarker(feature.business_type,feature.top_business, feature.icon, feature.custom_icon);

        const marker = new mapboxgl.Marker(el).setLngLat([feature.longitude,feature.latitude]).addTo(this.map);
        const markerDiv = marker.getElement();
      //  const pop = marker.getPopup();

        // markerDiv.addEventListener('mouseenter', () => {
        //     marker.togglePopup();
        // });

        markerDiv.addEventListener('click', () => {
            window.location.href = this.routeMap;
        });

        // return new mapboxgl.Marker(el).setLngLat([feature.longitude,feature.latitude]).setPopup(popup).addTo(this.map);

        return marker;

      });
    },
    getBusinessMarker(businessType, topStatus, topIcon, customIcon) {
        const el = document.createElement("div");
        el.className = "marker";
        el.style.width = '56px';
        el.style.height = '77px';
        el.style.backgroundRepeat = 'no-repeat';
        el.style.cursor = 'pointer';

        if(businessType == 'delivery') {
            if(topStatus == '1') {
                 el.style.backgroundImage = `url('${topIcon}')`;
            } else if(customIcon != null) {
                 el.style.backgroundImage = `url('${customIcon}')`;
            } else {
                 el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/delivery-green.png')";
            }

        }
        else if(businessType == 'dispensary') {
             if(topStatus == '1') {
                 el.style.backgroundImage = `url('${topIcon}')`;
            }
            else if(customIcon != null) {
                 el.style.backgroundImage = `url('${customIcon}')`;
            } else {
                 el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/dispensary-green.png')";
            }
        }
        return el;
    },
    getRecords() {

        axios.get('/api/products/category', {
            params: {
                    latitude: this.lat,
                    longitude: this.lng,
                    category_id: this.categoryid
            }
        }).then((response) => {
             this.currentFeatures = response.data.data;
             this.routeMap = response.data.routeMap;
        }).catch((err) => {
           // console.log(err);
        });
    },
    initMap() {
      mapboxgl.accessToken = "pk.eyJ1IjoiamNhcnJhc2NvNzIzIiwiYSI6ImNsOGJ6dmhlcTAxcHczb3F1enl0Z2s2dmsifQ._JYP-_Ma0bRQh6Ho-yAppw";
      this.map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [this.lng, this.lat],
        zoom: 5,
      });

      this.map.on("load", () => {
        this.map.addControl(new mapboxgl.NavigationControl(), "top-right");

        if (this.markers.length > 0) {
          this.resetMarkers();
        }

        if (this.currentFeatures) {
          this.updateMarkers();
        }
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
    ratingResolver(rating) {
        if(rating < 1) {
            return 0;
        }

        return parseFloat(parseFloat(rating).toFixed(1));
    },
    routeResolver(item) {
        if(item.business_type == 'dispensary') {
            return `/dispensaries/${item.business_name}/${item.id}`;
        } else {
            return `/deliveries/${item.business_name}/${item.id}`;
        }
    }
    },
    mounted() {
        this.initMap();
        this.getRecords();
    }
}

</script>

<style scoped>
/* .map-container {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: calc(100vh - 210px);
} */

#map {
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

.record-items {
    margin-bottom: 2rem;
    height: auto;
}

.record-items .record-item:last-child {
    border-bottom: 0;
}

</style>
