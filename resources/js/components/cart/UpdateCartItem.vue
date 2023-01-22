<template>
    <div class="update-cart-qty">
        <div class="update-cart-qty-price">
            <span><strong>${{ price }} </strong> x <strong>{{ qty }}</strong></span>
            <span><strong>${{ total }} </strong></span>
        </div>
        <input type="hidden" :name="`products[${loopkey}][product_id]`" :value="productid">

        <button type="button" :disabled="qty <= 1 ? true : false" @click="changeQuantity('dec')">-</button>

          <input type="number" v-model="qty" min="1" :name="`products[${loopkey}][qty]`">
          <button type="button" @click="changeQuantity('inc')">+</button>
    </div>
</template>

<script>
export default {
    props: ['price', 'quantity', 'loopkey', 'productid'],
    data() {
        return {
            qty: this.quantity,
            total: this.price * this.quantity
        }
    },
    watch: {
        qty() {
            if(this.qty < 1) {
                this.qty = 1;
            }

            this.total = this.price * this.qty;
        }
    },
    methods: {
        changeQuantity($val){
            if($val == 'inc'){
                this.qty++;
                this.total = this.price * this.qty;
            } else {
                if(this.qty == 0) {
                    this.qty = 1;
                    this.total = this.price * this.quantity;
                } else {
                    this.qty--;
                    this.total = this.price * this.qty;
                }
            }
        },
    }
}
</script>
