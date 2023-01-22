<template>
    <div class="modal-body-item">

        <div @click="selectedCategory(category.id)" class="map-cat-item-inner col-12 mb-3">
            <button class="mobile-map-btn-common map-product-cat" :class="{'mobile-btn-common-dark' : changeBg }">
            <img src="https://images.weedmaps.com/categories/000/000/002/avatar/original/1607965277-F-V3.png?fit=crop&auto=format&w=48&h=48" alt="Category Image">
                            <span>{{ category.name }}</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['category', 'changeBg'],
    methods: {
        selectedCategory(categoryId) {
            this.$emit('selectedCategory', categoryId);
        }
    }
}
</script>

<style scoped>

</style>
