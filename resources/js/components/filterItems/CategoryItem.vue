<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetCategoryItem">Reset</span>
            </div>
            <div class="modal-head-title">
                <span>Categories</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-body">
                <div class="modal-body-item" v-for="(item, index) in category" :key="index">
                <input type="checkbox" name="category" :value="item.id" :id="`category-item-${index}`" v-model="checkedCategories" /> <label :for="`category-item-${index}`">{{ item.name }}</label>
                </div>
        </div>
        <div class="modal-custom-footer">
            <button class="modal-footer-btn" @click="filterCategories">View results</button>
        </div>

    </div>
</template>

<script>
export default {
    props: ['category', 'selectedCategories'],
    data() {
        return {
            checkedCategories: this.selectedCategories
        }
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
        resetCategoryItem() {
            this.$emit("reset");
        },
        filterCategories() {
            this.$emit("selected-item", this.checkedCategories);
        }
    }
}
</script>

<style>
     @import '../css/menu.css';
</style>
