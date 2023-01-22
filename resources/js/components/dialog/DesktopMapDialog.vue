<template>
    <div class="mb-menu-dialog">
        <div class="backdrop" @click="closeModal"></div>
            <div class="content">
                <slot></slot>
            </div>
    </div>
</template>

<script>
export default {
    methods: {
        closeModal() {
            this.$emit('close')
        }
    }
}
</script>

<style scoped>
    @import '../css/menu.css';
</style>
