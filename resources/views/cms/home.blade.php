@extends('cms.cms')

@section('content')
        <div class="overflow-content" id="CMSApp">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="admin-content-con">
                        <header class="d-flex justify-content-between">
                            <h5>New Orders</h5>
                        </header>
                        <div class="overflow-content" style="height: 50vh;">
                            @include('cms.model.inc.orders-table',['cmsMode'=>true])
                        </div>
                        <div class="d-flex"><a href="{{url('cms/order')}}" class="link">All Orders</a></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="admin-content-con">
                        <header>
                            <h5>Recent Reviews</h5>
                        </header>
                        <div class="overflow-content" style="height: 50vh;">
                            @include('cms.inc.list-reviews')
                        </div>
                        <div class="d-flex">
                            <a href="{{url('cms/review')}}" class="link" id="">All Reviews</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="admin-content-con">
                        <header class="d-flex justify-content-between">
                            <h5>New Products</h5>
                            <a href="{{url('cms/product/create')}}" class="btn btn-primary" role="button">Create New</a>
                        </header>
                        @component('cms.model.inc.data-table',['items'=>$products,'entity'=>'product'])
                            @slot('ths')
                                <th scope="col">Stock</th>
                            @endslot
                            @slot('tds')
                                @verbatim
                                    <td>{{$item->stock}}</td>
                                @endverbatim
                            @endslot
                        @endcomponent
                        <div class="d-flex justify-content-end">
                            <a href="{{url('cms/product')}}" class="text-link">All Products</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $.each(['product','user'],function (index,entity) {
                console.log(entity);

                $('.delete'+entity.capitalize()).on('click', function (e) {
                    const _self = $(this);
                    $.ajax({
                        method: 'DELETE',
                        url: BASE_URL + '/cms/'+entity+'/' + _self.data(entity+'-id'),
                    })
                        .then(function (res) {
                            if (res == 1) {
                                _self.parent().parent().remove();
                                $('#productsTable').DataTable();
                                toastr.success(entity+' has been removed successfully');
                            }
                        }, function (e) {
                            console.error('ajaxError: ', e);
                        });
                });
            });
            $('#productsTable').DataTable();

        });
        var CMSApp = new Vue(CMSAppOBJ);

    </script>
@endpush


{{--
<div class="container">
        <div class="all-g-centered-md">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>

</div>--}}