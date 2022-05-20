<template>
    <div>
        <li class="nav-item">
            <a href="/cart" data-scroll-nav="0" class="text-sm text-gray-700 dark:text-gray-500 underline">
                <i class="fa-solid fa-cart-shopping"></i> {{ itemCount }}
            </a>
        </li>
    </div>
</template>

<script>
export default {
    data() {
        return {
            itemCount: '',
        }
    },
    mounted() {
        this.$root.$on('changeInCart', (item) => {
            this.itemCount = item;
        })
    },
    methods: {
        async getCarItemsOnPageLoad() {
            let response = await axios.post('/cart');
            this.itemCount = response.data.items
        }
    },
    created() {
        this.getCarItemsOnPageLoad();
    }
}
</script>
