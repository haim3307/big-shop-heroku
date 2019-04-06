<ul class="list-group-item" style="width: 100%;">
    @if(count($orders))
        @foreach($orders as $order)
            @isset($order->id)
                <li class="list-group-item">
                    <a data-toggle="collapse" class="container-fluid d-block" href="#orderList{{$order->id}}">
                        <div class="f-row justify-content-between">
                            <span>{{$order->created_at}}</span>
                            @if(!empty($cmsMode))
                                <span>{{$order->user->name}}</span>
                            @endif
                            <span class="f-row align-items-center"><strong class="mr-1">Status: </strong>
                                @if($order->step == 1)
                                    <span class="badge badge-success">Payed</span>
                                @else
                                    <span class="badge badge-warning">Waiting for payment</span>
                                @endif
                                </span>
                        </div>
                        <div id="orderList{{$order->id}}" class="collapse">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Calculated</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order['list'] as $orderItem)

                                    <tr>
                                        <th scope="row">{{ucwords($orderItem->item->title)}}</th>
                                        <th>{{$orderItem->item->price}}$</th>
                                        <th>{{$orderItem->quantity}}</th>
                                        <th>{{$orderItem->quantity * $orderItem->item->price}}$</th>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">Total Price: {{$order->total}}$</td>
                                    <td colspan="1">Total Quantity: {{$order->totalQuantity}}</td>
                                    <td colspan="1">Subtotal Price: {{$order->subTotal}}$</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- <ul id="orderList{{$order->id}}" class="collapse orderList">
                             @foreach($order['list'] as $orderItem)
                                 <li class="card">
                                     <div class="cartFrameI">
                                         <img class="card-img-top"
                                              src="{{asset('_img/products/'.$orderItem->item->c_url.'/'.$orderItem->item->main_img) }}"
                                              alt="Card image cap">
                                     </div>
                                     <h5 class="card-title h3">
                                         {{$orderItem->item->title}}
                                     </h5>
                                     <ul class="list-group list-group-flush">
                                         <li class="list-group-item">Price : {{$orderItem->item->price}}$</li>
                                         <li class="list-group-item">Quantity : {{$orderItem->quantity}}</li>
                                     </ul>

                                 </li>
                             @endforeach
                         </ul>--}}
                    </a>
                </li>
            @endisset
        @endforeach
    @else
        <h3 class="display-5">You Have No Orders Yet.. </h3>
    @endif

</ul>
@push('styles')
    <style>
        .orderList .card .cartFrameI {
            transition: 0.7s all;
            height: 100px;
            overflow: hidden;
        }

        .orderList .card .cartFrameI:hover {
            overflow: initial;
            height: 500px;
            transition: 0.7s all;

        }
    </style>
@endpush