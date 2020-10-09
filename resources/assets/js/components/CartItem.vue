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
	import { ref, computed } from "@vue/composition-api";

	export default {
		props: ['cartItem'],

		setup(){
			let { cartItem,url } = this;

			const url_item = computed(() => {
                return `${url}/shop/${cartItem['c_url'] ? cartItem['c_url'] : cartItem['main_category'].url}/${cartItem['url']}`;
			});

			const main_img = computed(() => {
			    if(!cartItem['main_category'] && !('url' in cartItem['main_category']) && !cartItem['c_url']) return;
				return `${url}/_img/products/${cartItem['c_url']? cartItem['c_url'] : cartItem['main_category'].url}/${cartItem['main_img']}`;
			});

			const methods = {
				emitDeleteItem() {
					this.$emit('deleteItem', cartItem);
				}
			};

			return {
				url_item,
				main_img,
				...methods
			}
		},
		mounted() {
			let { cartItem } = this;
			if (!cartItem['quantity']) this.$set(cartItem, 'quantity', 1);
		}
	}
</script>

<style scoped>

</style>

