<script>
    CMSAppOBJ.data.lists = @isset($lists)   {!! $lists->toJson() !!};
        @else [];
    @endisset
        CMSAppOBJ.data.selectedList = '{{isset($lists[0])?$selectedList??($lists[0]->url):false}}';
    CMSAppOBJ.data.pageManageMode = '{{request()->manage_mode??'manage'}}';
    CMSAppOBJ.methods.togglePageManageMode = function (mode) {
        CMSAppOBJ.data.pageManageMode = mode;
    };
    Vue.prototype.page = {url: '{{$page->url}}'};
    CMSAppOBJ.provide = function () {
        return {
            page: {!! $page !!}
        }
    }
    var CMSApp = new Vue(CMSAppOBJ);
</script>
