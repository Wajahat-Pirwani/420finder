<template>
        <div @click="selectedCategory(category.id)" class="map-cat-item-inner col-4 mb-3">
            <button class="desktop-map-btn-common map-product-cat" :class="{'desktop-btn-common-dark' : categoryBg }">
                <img src="https://images.weedmaps.com/categories/000/000/002/avatar/original/1607965277-F-V3.png?fit=crop&auto=format&w=48&h=48" alt="Category Image">
                <span>{{ category.name }}</span>
               </button>
        </div>
</template>

<script>
export default {
    props: ['category', 'categoryBg'],
    data() {
        return {

        }
    },
    methods: {
        selectedCategory(categoryId) {
            this.$emit('category', categoryId);
        }
    }
}
</script>

<style scoped>
     @import '../css/desktop-map.css';

</style>
