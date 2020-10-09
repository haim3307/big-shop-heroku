<!--suppress ALL -->
<template>
    <li>
        <a :href="item_link" @click.prevent="checkCMS()"
           class="f-row container-fluid"
           style="margin-bottom: 20px; cursor: pointer;text-decoration: none; color: white;">
            <div class="col-2 allCentered">
                <img style="position: absolute;" class="img-fluid" :src="main_img" alt="">
            </div>
            <div class="col">
                <h6>{{item.title | capitalize}}</h6>
                <small>{{item.e_name | capitalize}}</small>
            </div>
        </a>
    </li>
</template>

<script>
import { computed } from '@vue/composition-api';
	export default {
		name: "auto-complete-item",
        props: ['item','cmsMode'],
        setup(){
            const { url,item,cmsMode,$emit } = this;
            let { img_path,base_url,iurl,img,base_url_var_val } = item;

            const fiilPlaceholder = (path) => (/{(.*?)}/.test(path) ? path.replace('{category-url}', base_url_var_val) : path);

            const item_link = computed(() => url  + fiilPlaceholder(base_url)  + iurl);
            const main_img = computed(() => `${url}/_img${fiilPlaceholder(img_path)}/${img}`);

            const methods = {
                checkCMS(){
                    if(!cmsMode) window.location = item_link;
                    else $emit('addToEntitesList',item);
                }
            }

            return {
                ...methods,
                item_link,
                main_img
            }
        }
    }
</script>

<style scoped>
    h6 {
        word-wrap: break-word;
    }

</style>

