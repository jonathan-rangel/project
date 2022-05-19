<template>
    <div>
        <button class="btn btn-warning" v-on:click.prevent="addProductToCart()">
            Add to cart
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    props: ['smartphoneId', 'userId'],
    methods: {
        async addProductToCart() {
            if (this.userId == 0) {
                this.$toastr.e('You need to login to add this product to cart');
            } else {
                let response = await axios.post('/cart', {
                    'smartphone_id': this.smartphoneId
                });

                this.$root.$emit('changeInCart', response.data.items);
            }
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
