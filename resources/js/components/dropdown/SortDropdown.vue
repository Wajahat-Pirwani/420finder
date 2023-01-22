<template>
        <div class="sort-dropdown">
            <ul>
                <li v-for="item, index in items" :key="index" @click="sortChecked(item.value, item.name)" class="sort-dropdown-item" :class="{active: sortItemTitle == item.name }">{{ item.name }}</li>
            </ul>
        </div>
</template>

<script>
export default {
    props: ['sortItemTitle'],
    data() {
        return {
            items: [
                { name: 'Featured', value: 'featured'},
                { name: 'Highest rated', value: 'highest-rated'},
                { name: 'Most reviewed', value: 'most-reviewed'},
                { name: 'Name A-Z', value: 'name-a-to-z'},
                { name: 'Name Z-A', value: 'name-z-to-a'}
            ]
        }
    },
    methods: {
        sortChecked(value, name) {
            let sortData = {
                value,
                name
            }
            this.$emit('sortData', sortData);
        }
    }
}
</script>
