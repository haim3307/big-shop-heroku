<template>
    <li class="categoryModelItem" :class="{categoryModelItemFront:cmsMode}" @click="emitCategorySelect">
        <div class="categoryFrame allCentered">
            <img :src="category_img" alt="">
        </div>
        <div class="categoryInfo" :class="{selectedCategory:isSelected == category.id}">
            <a class="linkToCategory" :href="category_link">
                &gt;
            </a>
            <h3>{{category.name}}</h3>
        </div>
    </li>
</template>

<script>
import { computed } from '@vue/composition-api';
	export default {
		name: "category-display",
		props: {
			cmsMode: {
				type: Boolean,
				default: false,
			}, 'isSelected': {default: false}, 'category': {default: {}}
		},
		setup(){
			const { $emit,category,cdnByType,url } = this;
			const { url:curl,product_img,img: cimg,name:cname } = category;

			const computed = {
				category_link : computed(() => `${url}/shop/${curl}`),
				category_img: computed(() => {
					let path = `${cdnByType.img}/_img/`;
					if (cimg) {
						path += `categories/${cimg}`;
					} else if (product_img) {
						path += `products/${curl}/${product_img}`
					} else {
						path = 'http://via.placeholder.com/600x600?text=' + cname;
					}
					return path;
				})
            };

			return {
				emitCategorySelect() {
					$emit('oncategoryselect', category);
				},
				...computed
            }
        }
    }
</script>
<style lang="scss">
    .selectedCategory {
        background-color: #CD1121;
        border-color: #CD1123;
    }

    .selectedCategory h3 {
        color: white !important;
    }

    .categoryFrame img {
        transition: 0.7s all;
    }

    .categoryModelItemFront:hover .categoryFrame img {
        transform: scale(1.2);
    }
</style>

