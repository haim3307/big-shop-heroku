<template>
    <div class="modal fade product_view" id="product_view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-remove"></span></a>
                    <h3 class="modal-title">{{product.title | capitalize}}</h3>
                </div>
                <div class="modal-body" style="min-height: 50vh;">
                    <div class="g-row">
                        <div class="g-col-md-6 product_img">
                            <img :src="url+'/_img/products/'+product.c_url+'/'+product.main_img"
                                 class="img-responsive" style="    max-width: 203px;margin: 0 auto;height: auto;">
                        </div>
                        <div class="g-col-md-6 product_content">
                            <h4>Product Id: <span>{{product.id}}</span></h4>
                            <div class="rating">
                                <star-rating :show-rating="false" :rating="parseInt(product.rating)"
                                             :round-start-rating="false"
                                             :star-size="20" :read-only="true"></star-rating>
                            </div>
                            <p v-html="product.description"></p>
                            <h3 class="cost"><span class="fa fa-usd"></span> {{product.price}}
                                <small class="pre-cost" v-if="product.prev_price"><span class="fa fa-usd"></span>
                                    {{product.prev_price}}
                                </small>
                            </h3>
                            <!--<div class="row">
                                <div class="g-col-md-4 g-col-sm-6 g-col-xs-12">
                                    <select class="form-control" name="select" id="addModalSelect1">
                                        <option value="" selected="">Color</option>
                                        <option value="black">Black</option>
                                        <option value="white">White</option>
                                        <option value="gold">Gold</option>
                                        <option value="rose gold">Rose Gold</option>
                                    </select>
                                </div>
                                &lt;!&ndash; end g-col &ndash;&gt;
                                <div class="g-col-md-4 g-col-sm-6 g-col-xs-12">
                                    <select class="form-control" name="select">
                                        <option value="">Capacity</option>
                                        <option value="">16GB</option>
                                        <option value="">32GB</option>
                                        <option value="">64GB</option>
                                        <option value="">128GB</option>
                                    </select>
                                </div>
                                &lt;!&ndash; end col &ndash;&gt;
                                <div class="g-col-md-4 g-col-sm-12">
                                    <select class="form-control" name="select">
                                        <option value="" selected="">QTY</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                    </select>
                                </div>
                                &lt;!&ndash; end col &ndash;&gt;
                            </div>-->
                            <div class="space-ten"></div>
                            <div class="btn-ground" data-dismiss="modal">
                                <button :data-id="product.id" :data-product="jsonProduct()"
                                        class="btn btn-primary addToCartB"
                                        type="button"><span
                                    class="fa fa-shopping-cart"></span> <span class="btnTitle">Add To Cart</span>
                                </button>
                                <button type="button" class="btn btn-primary addToWishB" :data-wish-id="product.id"
                                        :data-wish-url="product.url"><span class="fa fa-heart"></span><span
                                    v-if="!product.inWishList && !product.inwishlist">Add To
                                    Wishlist</span><span v-else>Remove From Wishlist</span>
                                </button>
                                <!--                                <button class="btn allCentered addToWishB" :data-wish-id="product.id"
                                                                        style="position: relative; padding: 0; justify-content: stretch; border-radius: 0; font-size: 16px;font-weight: 400;color: #FFFFFF;">
                                                                    <div class="allCentered"
                                                                         style="height: 38px; width: 42px; background-color: rgb(247, 24, 24);">
                                                                        <i class="fa @if($inWishList) fa-heart @else fa-heart-o @endif"></i>
                                                                    </div>
                                                                </button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "quick-product-view-modal",
        props: ['product'],
        mounted() {
        },
        watch: {
            product(newVal, oldVal) {
                Vue.nextTick(updateCartedButtons);
            }
        },
        methods: {
            jsonProduct() {
                return JSON.stringify(this.product);
            },
        }
    }
</script>

<style scoped>

</style>
