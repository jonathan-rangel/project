<template>
    <div>
        <li class="nav-item">
            <a href="/home" class="text-sm text-gray-700 dark:text-gray-500 underline">
                Cart {{ itemCount }}
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
        getCarItemsOnPageLoad()
    }
}
</script>
