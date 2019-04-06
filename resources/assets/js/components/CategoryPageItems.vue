<template>
    <ul class="grid-items-4" v-if="items && items.length && itemsAvail">
        <cate-item-r v-for="item in items" :key="item.id" v-bind:it="item"></cate-item-r>
    </ul>
    <h2 class="noItems" v-else> no products available</h2>
</template>
<style>
    .noItems {
        text-align: center;
        color: grey;
        text-transform: uppercase;
        padding: 30px 10px;
    }
</style>
<script>
	export default {
		data: function () {
			return {
				items: window.items, itemsAvail: true
			}
		},
		props: {},

		mounted() {
			console.log(this.items);
			console.log('Component mounted.');
		}
	}
</script>
