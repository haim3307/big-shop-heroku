<template>
    <div class="pageList">
        <h2>{{listTitle | seoUnFriendly | capitalize}}</h2>
        <div class="container-fluid">
            <form id="changesOrderForm" @submit="onSubmitForm($event)"
                  :action="url + '/cms/page/'+page.url+'/'+listTitle+'/order?manage_mode='+pageManageMode"
                  class="f-row justify-content-center p-2"
                  method="POST"
                  style="background-color: cornflowerblue;">
                <input type="hidden" name="_token" :value="token">
                <input type="hidden" name="_method" value="PATCH">
                <input type="submit" value="Save Changes" class="btn btn-primary">
                <div class="col-3"><input type="hidden" name="order" id="order" :value="order"></div>
                <a :href="'?manage_mode='+pageManageMode"><input class="btn btn-danger" id="cancel" type="button"
                                                                 value="Cancel"></a>
            </form>
        </div>
        <div class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
            <ul class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header"
                v-if="list.items && list.items.length">
                <li :class="{'ui-state-active':displayMode === 'thumbnail'}"
                    @click="displayMode = 'thumbnail'"
                    class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active"><a
                    class="tabLink ui-tabs-anchor"
                    href="#thumbnails">Thumbnails</a></li>
                <li :class="{'ui-state-active':displayMode === 'table'}"
                    @click="displayMode = 'table'"
                    class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active"
                    v-if="list.entity && list.entity.name == 'product'"><a class="tabLink ui-tabs-anchor"
                                                                           href="#tableTab">Table</a></li>
            </ul>
            <div id="quickProductSearch" class="f-row p-md-2 justify-content-center">
                <div class="autoCompleteWrap" v-if="list.searchable == '1'">
                    <input type="text" class="form-control" id="autoCompleteInput" placeholder="search products.."
                           v-model="autoCompleteInput"
                           @keyup="getAutoComplete()">
                    <auto-complete-menu @addToEntitesList="addToEntitesListTrigger($event)" :cms-mode="true"
                                        v-if="this.autoCompleteInput.length"
                                        :list="autoCompleteEntitiesList" :list-title="listTitle"></auto-complete-menu>
                </div>
                <div class="addToList" v-else>
                    <a :href="url+'/cms/page/'+page.url+'/'+list.id+'/create'">
                        <button class="btn btn-success">Add New Item</button>
                    </a>
                </div>
            </div>
            <div v-if="!list.items || !list.items.length" style="min-height: 300px;">
                <h3 class="text-center">This List Is Empty</h3>
            </div>
            <div v-else>
                <section class="ui-tabs-panel ui-corner-bottom ui-widget-content" id="thumbnails"
                         v-show="displayMode === 'thumbnail'">

                    <thumbnail-list :list-obj="list" @deleteItem="deleteItem($event)"></thumbnail-list>
                </section>

                <section class="ui-tabs-panel ui-corner-bottom ui-widget-content"
                         id="tableTab" v-if="list.entity && list.entity.name == 'product'"
                         v-show="displayMode === 'table'">
                    <deal-table :list-obj="list"></deal-table>
                </section>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        name: "manage-page-list",
        props: ['list', 'listTitle', 'list_id', 'pageManageMode'],
        inject: ['page'],
        data() {
            return {
                token: window.token,
                order: false,
                autoCompleteEntitiesList: [],
                autoCompleteInput: '',
                displayMode: 'thumbnail'
			}
        },
        setup(){
            const {url,page,listTitle,list,autoCompleteInput,autoCompleteEntitiesList,order} = this;
            const { items } = list;

            const methods = {
                async addToEntitesListTrigger(item) {
                    const { id,entity_id } = item;
                    const res = await $.ajax({
                        url: `${url}/cms/page/${page.url}/${listTitle}/${id}/${entity_id}`,
                        method: "POST",
                    });
                    items.push(res);
                },
                async deleteItem(item) {
                    const res = await $.ajax({
                        method: 'DELETE',
                        url: url + '/cms/page/list/' + item.id
                    });
                    if (res == '1') {
                        items = items.filter(listitem => listitem.id != item.id);
                        toastr.success('List item deleted');
                    } else toastr.error('List item delete failed');
                },
                onSubmitForm(e) {
                    e.preventDefault();
                    order = items.map(product => product.list_item_id).join();
                    Vue.nextTick(() => $(e.target).unbind('submit').submit());
                },
                async getAutoComplete() {
                    autoCompleteEntitiesList = await $.ajax({
                        url: `${url}/${!listTitle ? `api/entities` : `cms/api/entities/${listTitle}`}/${autoCompleteInput}`,
                        method: "GET",
                    });
                }
            }
            return {
                ...methods
            }
        },
		mounted() {
			Vue.nextTick(() => $('#cancel').on('click', e => CMSAppOBJ.data.items = items));
		}
	}
</script>

<style>
    .tabs li a, .tabs li {
        cursor: pointer !important;
    }

    .ui-helper-clearfix:before, .ui-helper-clearfix:after {
        content: "";
        display: table;
        border-collapse: collapse;
    }

    .pageList .autoCompleteWrap {
        position: relative;
    }

    .pageList .autoCompleteMenuUl {
        width: 100%;
    }
</style>

