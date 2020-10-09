<template>
    <li class="d-block">
        <a :href="url_item">
            <div class="product-image" style="display: flex; align-items: center;">
                <img :src="main_img"
                     class="img-responsive" :alt="cartItem['name']"></div>
            <div class="product-details">
                <div class="close-icon" v-on:click.prevent="emitDeleteItem"><a><i class="fa fa-close"></i></a>
                </div>
                <p class="product-name">{{cartItem['title'] | capitalize }}</p>
                <strong>{{cartItem['quantity']}}</strong> x <span
                class="price text-primary">${{cartItem['price']}}</span>
            </div>
        </a>

        <!-- end product-details -->
    </li>
</template>

<script>
    export default {
        props: ['cartItem'],

        mounted() {
            let {cartItem} = this;
            if (!cartItem['quantity']) this.$set(cartItem, 'quantity', 1);
        },
        computed: {
            main_img() {
                let {cartItem, url} = this;
                if (!cartItem['main_category'] && !('url' in cartItem['main_category']) && !cartItem['c_url']) return;
                return `${url}/_img/products/${cartItem['c_url'] ? cartItem['c_url'] : cartItem['main_category'].url}/${cartItem['main_img']}`;
            },
            url_item() {
                //!this.cartItem['c_name'] && (this.cartItem['c_name'] = selectedCategory);
                /*console.log('cartItem:',this.cartItem['main_category']);
				*/
                let {cartItem, url} = this;
                return `${url}/shop/${cartItem['c_url'] ? cartItem['c_url'] : cartItem['main_category'].url}/${cartItem['url']}`;
            }
        },
        methods: {
            emitDeleteItem() {
                this.$emit('deleteItem', this.cartItem);
            },

        }
    }
</script>

<style scoped>

</style>

