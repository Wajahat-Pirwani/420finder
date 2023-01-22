<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetGeneticItem">Reset</span>
            </div>
            <div class="modal-head-title">
                <span>Indica, Sativa, Hybrid</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-body">
                <div class="modal-body-item" v-for="(item, index) in genetic" :key="index">
                <input type="checkbox" name="genetic" :value="item.id" :id="`genetic-item-${index}`" v-model="checkedGenetics" /> <label :for="`genetic-item-${index}`">{{ item.name }}</label>
                </div>
        </div>
        <div class="modal-custom-footer">
            <button class="modal-footer-btn" @click="filterGenetics">View results</button>
        </div>

    </div>
</template>

<script>
export default {
    props: ['genetic', 'selectedGenetics'],
    data() {
        return {
            checkedGenetics: this.selectedGenetics
        }
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
        resetGeneticItem() {
            this.$emit("reset");
        },
        filterGenetics() {
            this.$emit("selected-item", this.checkedGenetics);
        }
    }
}
</script>

<style>
     @import '../css/menu.css';
</style>
