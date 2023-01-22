<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetCategoryItem">Clear</span>
            </div>
            <div class="modal-head-title">
                <span>Products</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-body">

                <CategoryItem v-for="category in categories" :key="category.id"
                :category="category"
                @selectedCategory="selectedCategory"
                :changeBg="checkCategorySelected(category.id)"
                ></CategoryItem>
        </div>
        <div class="modal-custom-footer">
            <button class="modal-footer-btn" @click="closeModal">View results</button>
        </div>

    </div>
</template>

<script>

import CategoryItem from './CategoryItem.vue';

export default {
    props: ['category', 'selectedCategories', 'changeBg'],
    components: {
        CategoryItem
    },
    data() {
        return {
            categories: this.category,
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
        checkCategorySelected(categoryId) {
            return _.includes(this.checkedCategories, categoryId);
        },
        selectedCategory(categoryId) {

            if(_.includes(this.checkedCategories, categoryId)) {
            this.checkedCategories = _.remove(this.checkedCategories, function(n) {
                return n != categoryId;
            });
              } else {
            this.checkedCategories.push(categoryId);
            }

            this.$emit('selected-item', this.checkedCategories);
        }
    }
}
</script>

<style scoped>

</style>
