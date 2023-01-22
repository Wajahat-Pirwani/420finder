<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetPriceItem">Reset</span>
            </div>
            <div class="modal-head-title">
                <span>Price range</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-body">
                <div class="modal-body-item" v-for="(item, index) in items" :key="index">
                <input type="radio" name="price" :value="item.value" :id="`price-item-${index}`" @change="selectedItem(item)" v-model="pr" /> <label :for="`price-item-${index}`">{{ item.title }}</label>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['price'],
    data() {
        return {
            pr   : this.price,
            items: [
                { title: 'Any', value: 'any'},
                { title: 'Under $25', value: '24'},
                { title: '$25 to $50', value: '26'},
                { title: '$50 to $100', value: '51'},
                { title: '$100 to $200', value: '101'}
            ],

        }
    },
    methods: {
        selectedItem(item) {
            this.$emit("selected-item", item);
        },
        closeModal() {
            this.$emit("close");
        },
        resetPriceItem() {
            this.$emit('reset')
        }
    }
}
</script>

<style>
    @import '../css/menu.css';
</style>
