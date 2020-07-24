<template>
    <div class="f-row g-col-12">
        <b-col md="3">
            <section class="trending">
                <h2>TRENDING NOW</h2>
                <ul>
                    <li @click="selectedTag" v-for="tab in [ 'man', 'women', 'kids', 'accessories' ]"
                        :data-tag="tab">{{tab}}
                    </li>
                </ul>
            </section>
        </b-col>
        <b-col md="9">
            <div class="trendingItems">
                <div class="cate-items"><!--animated-loop-->
                    <ul class="grid-items-4" v-if="items && items.length && itemsAvail">
                        <cate-item-r v-for="item in items" :key="item.id" :it="item"></cate-item-r>
                    </ul>
                    <h2 style="text-align: center; color: grey; text-transform: uppercase; padding: 30px 10px;"
                        v-else> no products available</h2>
                </div>
            </div>
        </b-col>
    </div>
</template>

<script>
    export default {
        name: "home",
        props: ['items'],
        data() {
            return {
                itemsAvail: this
            }
        },
        methods: {
            selectedTag(e) {
                $('.animated-loop').children().addClass('animate-loaded-hide');
                $.ajax({url: url + '/home/tags/' + $(e.target).data('tag')}).then(function (res) {
                    shopAppOBJ.data.items = res;
                    shopAppOBJ.data.itemsAvail = true;
                    Vue.nextTick(function () {
                        var $els = document.querySelectorAll('.animate-loaded-hide');
                        if ($els.length) shopAppOBJ.methods.animatedLoop($els[0]);
                        reloadSirv();
                    });

                }, function (e) {
                    shopAppOBJ.data.itemsAvail = false;
                    if ($els.length) shopAppOBJ.methods.animatedLoop($els[0]);
                });
                $('.trending ul li').removeClass('trendActive');
                $(e.target).addClass('trendActive');
            }
        }
    }
</script>

<style scoped>

</style>
