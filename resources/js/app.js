/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('menu-dispensary', require('./components/MenuDispensary.vue').default);

Vue.component('product-component', require('./components/ProductComponent.vue').default);
Vue.component('desktopmap-component', require('./components/DesktopMapComponent.vue').default);
Vue.component('mobilesearch-component', require('./components/MobileSearchComponent.vue').default);

Vue.component('desktop-location-search', require('./components/DesktopLocationSearch.vue').default);

// Products
Vue.component('products-category', require('./components/products/ProductCategory.vue').default);

// Delivery Retailer Reviews
Vue.component('retailer-reviews', require('./components/delivery-retailer/RetailerReviews.vue').default);

Vue.component('details-map', require('./components/details/Map.vue').default);
Vue.component('single-product-review', require('./components/SingleProductReview/SingleProductReview.vue').default);
Vue.component('product-single-qty', require('./components/SingleProductQty/SingleProductQty.vue').default);

// Cart
Vue.component('update-cart-item', require('./components/cart/UpdateCartItem.vue').default);

//Deals Slider
Vue.component('deals-slider', require('./components/dealsslider/dealsslider.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
