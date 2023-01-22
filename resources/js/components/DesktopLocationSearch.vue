<template>
    <div class="col-6 px-0">
        <div class="d-flex location-wrap v-mobile-search">
        <span class="btn btn-sm location-icon" @click="changeToDefault"><i class="fas fa-map-marker-alt"></i></span>
        <input type="text" v-model="geometrySearch" class="search_input" placeholder="Type address..." @focus="showResultCard"/>
        <div id="map_canvas"></div>
        <div class="v-search-results" v-click-outside="hideResultCard" v-show="cardVisible">
            <ul>
            <li class="current-location-btn d-flex align-items-center" @click="getUserCoordinates">
                <div class="current-location-icon">
                    <svg class="wm-locate" width="20px" height="20px" viewBox="0 0 20 20"><path d="M10 6.364C7.99 6.364 6.364 7.99 6.364 10c0 2.01 1.627 3.636 3.636 3.636 2.01 0 3.636-1.627 3.636-3.636 0-2.01-1.627-3.636-3.636-3.636zm8.127 2.727C17.71 5.3 14.7 2.29 10.91 1.874V0H9.09v1.873C5.3 2.29 2.29 5.3 1.874 9.09H0v1.82h1.873c.418 3.79 3.427 6.8 7.218 7.217V20h1.82v-1.873c3.79-.418 6.8-3.427 7.217-7.218H20V9.09h-1.873zM10 16.365c-3.518 0-6.364-2.846-6.364-6.364S6.482 3.636 10 3.636 16.364 6.482 16.364 10 13.518 16.364 10 16.364z" fill="#999999"></path></svg>
                </div>
                <div class="current-location-text">
                    <h6>Current Location</h6>
                </div>
            </li>

            <template v-if="predictions.length > 0">
            <li v-for="predict in predictions" :key="predict.place_id" @click="getCoordinates(predict.place_id, predict.description)">
                <span>
                    <svg width="25px" height="25px" viewBox="0 0 24 24" class="location__SVG-sc-14zeeeh-0 gIxWzV"><path fill="#a5a9b1" d="M20 10.36c0 2.87-2.59 6.8-7.88 11.6a.18.18 0 0 1-.24 0C6.58 17.15 4 13.22 4 10.35 4 5.75 7.58 2 12 2s8 3.75 8 8.36Zm-8 3.78c1.84 0 3.33-1.6 3.33-3.57C15.33 8.6 13.84 7 12 7s-3.33 1.6-3.33 3.57c0 1.97 1.49 3.57 3.33 3.57Z"></path></svg>
                </span>
                <span v-html="highlightQuery(predict.description)"></span>
            </li>
            </template>
           </ul>
        </div>
        </div>
    </div>
</template>

<script>

import ClickOutside from 'vue-click-outside';

export default {
    data() {
        return {
            key: 'AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8',
            geometrySearch: this.geometrySearch,
            predictions: [],
            selectedLat: '',
            selectedLng: '',
            cardVisible: false,
        }
    },
    watch: {
        geometrySearch: _.debounce(function(val) {
                 if(val.length >= 2) {
                     this.initService();
                 }
        }, 300),
    },
    methods: {

        displaySuggestions(predictions, status) {

        if (status != google.maps.places.PlacesServiceStatus.OK || !predictions) {
            // alert(status);
             return;
        }

        this.predictions = predictions;

        },
        getCoordinates(predictionPlaceId, predictDescription) {
        this.geometrySearch = predictDescription;
        var map = new google.maps.Map(document.getElementById("map_canvas"));
        var request = {
            placeId: predictionPlaceId,
            fields: ['name', 'geometry']
        };

        let service = new google.maps.places.PlacesService(map);
        service.getDetails(request, callback);

        let that = this;
        function callback(place, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
               that.selectedLat = place.geometry.location.lat();
               that.selectedLng = place.geometry.location.lng();
               that.getUserLocation();
            }
        }

        },
        highlightQuery(predictDescription){
            var iQuery = new RegExp(this.geometrySearch, "ig");
                return predictDescription.toString().replace(iQuery, function(matchedTxt,a,b){
                    return ('<span class=\'highlight\'>' + matchedTxt + '</span>');
                });
        },
        changeToDefault() {
            this.geometrySearch = 'Los Angeles, California, USA';
        },
        hideResultCard() {
            this.cardVisible = false;
        },
        showResultCard() {
            this.cardVisible = true;
        },
        getUserCoordinates() {

              if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
              (position) => {

                let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${position.coords.latitude},${position.coords.longitude}&key=${this.key}`;
                var that = this;
                $.get(url, function(data, status){
                    that.geometrySearch = data.results[3].formatted_address;

                    that.selectedLat = position.coords.latitude;
                    that.selectedLng = position.coords.longitude;
                    that.getUserLocation();
                });
                this.cardVisible = false;
            },
            //   (error) => {
            //     alert(error.message);
            //   }
            );
          } else {
            // alert("Your browser does not support geolocation API ");
          }
        },
        getUserLocation() {
            this.cardVisible = false;
            $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/getlocationforcurrentuser",
            method:"POST",
            data:{
              lat:this.selectedLat,
              lon:this.selectedLng
              },
              success:function(data) {
                let response = JSON.parse(data);
                if (response.statuscode == 200) {
                  localStorage.removeItem("currentlocation");
                  localStorage.setItem("currentlocation", response.message);
                  location.reload();
                } else {
                  toastr.error(response.message);
                }

              }
          });
        },
        initService() {

        var sessionToken = new google.maps.places.AutocompleteSessionToken();

        // Pass the token to the autocomplete service.
        var autocompleteService = new google.maps.places.AutocompleteService();
        autocompleteService.getPlacePredictions({
                input: this.geometrySearch,
                sessionToken: sessionToken
         },
         this.displaySuggestions);

        },
        setGeometrySearch() {
            let currentLocation = localStorage.getItem('currentlocation');
            if(currentLocation !== null) {
                this.geometrySearch = currentLocation;
            } else {
                this.geometrySearch = 'Los Angeles, California, USA';
            }
        }
    },
    mounted() {
        this.setGeometrySearch();
        this.popupItem = this.$el;
    },
     directives: {
      ClickOutside
    }
}
</script>

<style scoped>
   @import './css/mobile-search.css';
</style>
