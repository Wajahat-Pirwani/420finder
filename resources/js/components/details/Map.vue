<template>
    <div class="right-content">
        <div id="map"></div>
    </div>
</template>
<script>

import mapboxgl from "mapbox-gl";

export default {
    props: ['deliveryid', 'latitude', 'longitude'],
    data() {
        return {
            map: null,
            lat: this.latitude,
            lng: this.longitude,
            markers: [],
            currentFeatures: [],
            deliveryId: this.deliveryid
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

                const el = this.getBusinessMarker(feature.business_type, feature.top_business, feature.icon, feature.custom_icon);

                const marker = new mapboxgl.Marker(el, {offset: [0, -50/2]}).setLngLat([feature.longitude, feature.latitude]).addTo(this.map);
                // const markerDiv = marker.getElement();
                //  const pop = marker.getPopup();

                // markerDiv.addEventListener('mouseenter', () => {
                //     marker.togglePopup();
                // });

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
                zoom: 14,
                interactive: false
            });
            this.map.on("load", () => {
                // this.map.addControl(new mapboxgl.NavigationControl(), "top-right");
                this.map.resize();
                if (this.markers.length > 0) {
                    this.resetMarkers();
                }

                if (this.currentFeatures) {
                    this.updateMarkers();
                }
            });

            this.map.on("move", () => {
                // set the vue instance's data.center to the results of the mapbox instance    method for getting the center
                let center = this.map.getCenter();
                this.lat = center.lat;
                this.lng = center.lng;
                this.redoSearchBtnVisible = true;
            });
        },
        getBusinessMarker(businessType, topStatus, topIcon, customIcon) {

            const el = document.createElement("div");
            el.className = "marker";
            el.style.width = '56px';
            el.style.height = '77px';
            el.style.backgroundRepeat = 'no-repeat';
            el.style.cursor = 'pointer';

            if (businessType == 'Delivery') {
                if (topStatus == '1') {
                    el.style.backgroundImage = `url('${topIcon}')`;

                } else if (customIcon != null) {
                    el.style.backgroundImage = `url('${customIcon}')`;
                } else {
                    el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/delivery-green.png')";
                }

            } else if (businessType == 'Dispensary') {
                if (topStatus == '1') {
                    el.style.backgroundImage = `url('${topIcon}')`;
                } else if (customIcon != null) {
                    el.style.backgroundImage = `url('${customIcon}')`;
                } else {
                    el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/dispensary-green.png')";
                }
            }
            return el;
        },
        getRecord() {

            axios.get('/api/delivery/details/map', {
                params: {
                    delivery_id: this.deliveryId
                }
            }).then((response) => {
                this.currentFeatures = [response.data.data];
            }).catch((err) => {
                // console.log(err);
            });
        }
    },
    mounted() {
        this.initMap();
        this.getRecord();
        this.map.resize();
    }
}
</script>
<style scoped>
.mapboxgl-canvas{
    width: 526px; height: 280px !important;
}
</style>


