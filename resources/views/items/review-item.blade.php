<div class="g-row review container-fluid" style="grid-gap: 11px;">
    <div style="height: 100px;" class="g-col-2">
        <img style=" border: 1px lightgrey solid;" class="img-fluid" width="100"
             src="{{asset("_img/profiles/{$review->user->profile_img}")}}" alt=""></div>
    <div style="font-family: Arial; background: radial-gradient(ellipse at center, #fafafa 0%,#eeeeee 100%); "
         class="g-col-md-10 reviewContent productConShadow p-md-3 container-fluid">
        <div class="f-row justify-content-between">
            <h3 class="reviewerName">{{ucwords($review->user->name)}}</h3>
            @empty($postMode)
                <span class="reviewRating">
                    <star-rating :show-rating="false" :rating="{{$review->rating}}"
                                                        :round-start-rating="false"
                                                        :star-size="20"
                                                        :read-only="true"></star-rating>
                </span>
            @endempty
        </div>
        <p style="color:  #777777; word-wrap: break-word">
            {{empty($postMode)?$review->description:$review->comment}}
        </p>
        @isset($postMode)
            <small class="pull-right">{{$review->created_at}}</small>
        @endisset
    </div>

</div>