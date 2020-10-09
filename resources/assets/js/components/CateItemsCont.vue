<template>
    <ul class="grid-items-4" v-if="items && items.length && itemsAvail">
        <cate-item-r v-for="item in items" :key="item.id" :it="item"></cate-item-r>
    </ul>
    <h2 style="text-align: center; color: grey; text-transform: uppercase; padding: 30px 10px;" v-else> no products
        available</h2>
</template>

<script>
    export default {
        data: function () {
            return {
                items: window.items, itemsAvail: true
            }
        },
        props: {},

        mounted() {
            let $tags = $('.trending ul li');
			$tags.on('click',  e => {
                //, e => _self.items = window.items
                $.ajax({url: this.url+'/home/tags/' + $(e.target).data('tag')})
					.then(res => {
						this.items = res;
						this.itemsAvail = true;
                }, e => this.itemsAvail = false);
                $tags.removeClass('trendActive');
                $(e.target).addClass('trendActive');
            });
        }
    }
</script>
