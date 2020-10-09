<template>
    <ul class="autoCompleteMenuUl" v-show="list.length" style="">
        <auto-complete-item :cms-mode="cmsMode" :item="item" :key="item.id"
                            @addToEntitesList="$emit('addToEntitesList',$event)"
                            v-for="item in list"></auto-complete-item>
    </ul>
</template>

<script>
    import AutoCompleteItem from './AutoCompleteItem';
	export default {
		components:{AutoCompleteItem},
		props:['list','cmsMode'],
		name: "auto-complete-menu"
	}
</script>

<style>
    .autoCompleteMenuUl {
        position: absolute;
        z-index: 1111;
        margin: 10px auto;
inset-inline-start: -3px;
inset-inline-end: 0;
        padding: 10px;
inset-block-start: 26px;
        background-color: rgba(125, 125, 125, 0.7);
        width: 90%;
        border-bottom: 1px solid lightgrey
    }

    @media (max-width: 1112px) {
        .autoCompleteMenuUl {
            height: 80vh;
            overflow-y: scroll;
        }

        .autoCompleteMenuUl li {
            min-height: 100px;
            padding: 20px;
        }
    }
</style>

