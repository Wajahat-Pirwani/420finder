<template>
    <div class="modal-item-content">
        <div class="modal-head">
            <div class="modal-head-reset">
                <span @click="resetSortItem">Reset</span>
            </div>
            <div class="modal-head-title">
                <span>Sort</span>
            </div>
            <div class="modal-head-close">
                <span @click="closeModal">Close</span>
            </div>
        </div>
        <div class="modal-custom-body">
                <div class="modal-body-item" v-for="(item, index) in items" :key="index">
                <input type="radio" name="sort" :value="item.value" :id="`sort-item-${index}`" @change="selectedItem(item)" v-model="rel" /> <label :for="`sort-item-${index}`">{{ item.title }} <span>{{ defaultItem(index) }}</span></label>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['relevance'],
    data() {
        return {
            rel: this.relevance,
            items: [
                { title: 'Relevance', value: 'relevance'},
                { title: 'Recently Added', value: 'recently-added'},
                { title: 'Lowest Price', value: 'low-price'},
                { title: 'Highest Price', value: 'high-price'},
                { title: 'THC%: low to high', value: 'thc-low-to-high'},
                { title: 'THC%: high to low', value: 'thc-high-to-low'},
                { title: 'CBD%: low to high', value: 'cbd-low-to-high'},
                { title: 'CBD%: high to low', value: 'cbd-high-to-low'}
            ],

        }
    },
    computed: {
    },
    methods: {
        defaultItem(index) {
            return (index == 0) ? '(default)' : '';
        },
        selectedItem(item) {
            this.$emit("selected-item", item);
        },
        closeModal() {
            this.$emit("close");
        },
        resetSortItem() {
            this.$emit('reset')
        }
    }
}
</script>

<style>
    @import '../css/menu.css';
</style>
