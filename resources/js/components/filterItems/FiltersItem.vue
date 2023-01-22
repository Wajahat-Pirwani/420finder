<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetFiltersItem">Reset</span>
            </div>
            <div class="modal-head-title">
                <span>Filter & Sort</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-body">
                <template v-if="Object.keys(checkedFilters).length > 0">
                <div class="modal-body-item filter-body-item" v-for="(value, key, index) in checkedFilters" :key="index">
                    <div class="modal-body-filter-icon-wrap">
                        <div class="modal-body-filter-icon" @click="filterItem(key)">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                        </div>
                        <div class="modal-body-filter-name">
                            <p>{{ key }}</p>
                        </div>
                    </div>
               </div>
                </template>

                <template v-else>
                    <p>No filters Selected</p>
                </template>

                <!-- <div class="modal-body-item" v-for="(item, index) in genetic" :key="index">
                <input type="checkbox" name="genetic" :value="item.id" :id="`genetic-item-${index}`" v-model="checkedGenetics" /> <label :for="`genetic-item-${index}`">{{ item.name }}</label>
                </div> -->
        </div>
    </div>
</template>

<script>
export default {
    props: ['selectedFilters'],
    data() {
        return {
            checkedFilters: this.selectedFilters,
        }
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
        resetFiltersItem() {
            this.$emit("reset");
        },
        filterItem(key) {
            this.checkedFilters = _.omit(this.checkedFilters, key);
            this.$emit("selected-item", this.checkedFilters);
        },
    }
}
</script>

<style>
     @import '../css/menu.css';
</style>
