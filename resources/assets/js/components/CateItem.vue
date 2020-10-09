<template>
    <li class="catesItem" v-show="loadedItem">
        <a :href="url_item">
            <img :src="url_main_img" v-on:load="loadItem()" class="img-fluid" alt="">
            <div class="innerCatesItem">
                <div class="partA">
                    <h3>{{it['title']}}</h3>
                    <p class="desc">{{it['description']}}</p>
                    <div class="frameItemPrices">
                        <span style="color: #d70a0a">${{it['price']}}</span>
                        <span style="text-decoration: line-through;">${{it['prev_price']}}</span>
                    </div>
                    <div class="allCentered buyNowWideButton" :data-id="it['id']">
                        <div class="allCentered buyIconFrame "><img
                            :data-src="url_shopping_cart" alt="" class="Sirv"></div>
                        <span>Add to cart</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
</template>

<script>
    export default {
        props: ['it'],
        data: function () {
            return {
                loadedItem: false
            }
        },
        methods: {
            loadItem() {
                this.loadedItem = true;
            }
        },
        computed: {
            url_main_img () {
                return `${this.cdnByType.img}/${!window.categoryImgRoute ? '_img/main-items-by-cates/' : window.categoryImgRoute}${this.it['main_img']}`;
            },
            url_shopping_cart () {
                return `${this.cdnByType.img}/_img/shopping-cart.png`;
            },
            url_item () {
                /*				!this.it['c_name'] && (this.it['c_name'] = selectedCategory);
                                !this.it['sc_name'] && (this.it['sc_name'] = selectedSubCategory);*/
                return `${this.url}/shop/${this.it['c_name']}/${this.it['sc_name']}/${this.it['url']}`;
            },
        }
    }
</script>

