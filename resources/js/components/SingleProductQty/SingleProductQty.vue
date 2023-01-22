<template>
     <div class="product-single-qty">
         <button :disabled="qty <= 1 ? true : false" @click="changeQuantity('dec')">-</button>
          <input type="number" v-model="qty" min="1" id="product-single-qty-input">
          <button @click="changeQuantity('inc')">+</button>
     </div>
</template>

<script>
export default {
    data() {
        return {
            qty: 1
        }
    },
    watch: {
        qty() {
            if(this.qty < 1) {
                this.qty = 1;
            }
        }
    },
    methods: {
        changeQuantity($val){
            if($val == 'inc'){
                this.qty++;
            } else {
                if(this.qty == 0) {
                    this.qty = 1;
                } else {
                    this.qty--;
                }
            }
          },
    }
}
</script>
