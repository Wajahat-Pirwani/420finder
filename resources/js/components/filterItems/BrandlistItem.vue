<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetBrandsItem">Reset</span>
            </div>
            <div class="modal-head-title">
                <span>Brands</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-search">
            <div class="modal-custom-search-inner" :class="{ 'search-border' : searchIcon}">
                <div class="modal-custom-search-icon" v-show="searchIcon" @click="searchBlur">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                </div>
                <input type="text" placeholder="Search Brands" v-model="brandSearchQuery" @focus="searchFocus" @blur="searchBlur">
            </div>
        </div>
        <template v-if="brandLoading">
             <div class="loading-spinner">
                    <p><i class="fas fa-circle-notch fa-spin"></i></p>
             </div>
        </template>
        <template v-else>
            <div class="modal-custom-body" v-if="allBrands.length > 0">
                <div class="modal-body-item" v-for="(item, index) in allBrands" :key="index">
                <input type="checkbox" name="brandlist" :value="item.id" :id="`brandlist-item-${index}`" v-model="checkedBrands" /> <label :for="`brandlist-item-${index}`">{{ item.name }}</label>
                </div>
            </div>
            <div class="modal-custom-body" v-else>
                <p>No results found.</p>
            </div>
        </template>

        <div class="modal-custom-footer">
            <button class="modal-footer-btn" @click="filterBrands">View results</button>
        </div>

    </div>
</template>

<script>
export default {
    props: ['deliveryId', 'brands', 'selectedBrands'],
    data() {
        return {
            checkedBrands: this.selectedBrands,
            allBrands: this.brands,
            brandSearchQuery: '',
            searchIcon: false,
            brandLoading: false,
        }
    },
    watch: {
            brandSearchQuery: _.debounce(function(val) {
                 if(val.length != '') {
                    this.getSearchBrands(val);
                 } else {
                     this.allBrands = this.brands;
                 }
            }, 500),
    },
    methods: {
        searchFocus() {
            this.searchIcon = true;
        },
        searchBlur() {
            this.searchIcon = false;
        },
        closeModal() {
            this.$emit("close");
        },
        resetBrandsItem() {
            this.$emit("reset");
        },
        filterBrands() {
            this.$emit("selected-item", this.checkedBrands);
        },
        async getSearchBrands(query) {
                this.brandLoading = true;
                await axios.get(`/api/products/search-brand/${this.deliveryId}/${query}`).then((response) => {
                    this.brandLoading = false;
                    this.allBrands = response.data.data;
                }).catch((err) => {
                    this.brandLoading = false;
                    console.log(err);
                });
        },
    }
}
</script>

<style>
     @import '../css/menu.css';
</style>
