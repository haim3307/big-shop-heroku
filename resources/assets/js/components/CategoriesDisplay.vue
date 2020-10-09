<template>
    <div class="categoriesDisplay">
        <draggable class="d-grid grid-col-md-2" style="grid-auto-rows: 600px" :list="categories"
                   :options="{animation:200,handle:'.categoryModelItem'}" :element="'ul'">
            <category-display v-for="category in categories" :key="category.id"
                              :category="category" :is-selected="selectedCategoryId"></category-display>
        </draggable>

    </div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        props: ['categories'],
        components: {draggable},
        data: function () {
            return {
                subCategories: false,
                selectedCategory: false,
                selectedCategoryId: false
            }

		}
	}
</script>


<style lang="scss">
    .categoriesDisplay{
        ul {
            grid-auto-rows: 374px;
            grid-gap: 15px;
        }
        .categoryModelItem {
            display: grid;
            grid-template-rows: 1fr 60px;
            border-radius: 3px;
            overflow: hidden;
            h3 {
                display: flex;
                align-items: center;
                padding-inline-start: 15px;
                color: grey;
                text-transform: capitalize;
            }
        }
    }

    .categoryFrame {
        overflow: hidden;
        img {
            max-width: 170%;
            height: auto;
        }
    }


    .categoryInfo {
        background-color: #fff;
        display: grid;
        border: 2px solid lightgray;
        border-top: 0;
        position: relative;
    }

    .linkToCategory {
        background-color: #F5F5F5;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
        position: absolute;
inset-inline-start: 5px;
inset-block-start: -20px;
    }
</style>

