@extends('users.profile')
@section('settings-content')
   <div class="f-row">
       <div class="col-12 col-md-5">
           <div class="profile-thumb" style="background-image: url('{{asset('_img/profiles/'.$user->profile_img)}}');width: initial; max-width: 100%;"></div>
           <form class="profile-thumb-upload mt-15" enctype="multipart/form-data" method="post">
               {{$user->name}}
               <div class="form-group">
                   {{csrf_field()}}
                   <div class="f-row justify-content-between">
                       <input type="file" class="form-control-file fade" id="upload-new-thumb" name="profile_img">
                       <label class="submit" for="upload-new-thumb">Upload Profile Img</label>
                       <label class="submit" for="submitImg">Submit Profile Img</label>
                       <input type="submit" name="submit" id="submitImg" class="fade">
                   </div>
                   @if($errors->has('profile_img')) <div class="text-danger">{{$errors->first('profile_img')}}</div> @endif

               </div>
           </form>
       </div>

       <div class="col-12 col-md-7">
           <div class="profile_form">
               <form action="#" method="post" class="text-left" novalidate="novalidate">
                   {{csrf_field()}}
                   <div class="g-row" style="grid-column-gap: 20px;">
                       <div class="g-col-12 g-col-md-6">
                           @include('forms.form-unit',['name'=>'first_name','value'=>$userInfo->first_name??'','display'=>'First Name'])
                       </div>
                       <div class="g-col-12 g-col-md-6">
                           @include('forms.form-unit',['name'=>'last_name','value'=>$userInfo->last_name??'','display'=>'Last Name'])
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="email">Email address</label>
                       <input type="email" class="form-control" id="email" value="{{auth()->user()->email}}" disabled="disabled">
                   </div>
                   @include('forms.form-unit',['name'=>'phone','value'=>$userInfo->phone??''])
                   @include('forms.form-unit',['name'=>'address','value'=>$userInfo->address??''])
                   @include('forms.form-unit',['name'=>'city','value'=>$userInfo->city??''])
                   @include('forms.form-unit',['name'=>'province','value'=>$userInfo->province??''])
                   @include('forms.form-unit',['name'=>'postal_code','value'=>$userInfo->postal_code??'','display'=>'Postal Code'])
                   @include('forms.form-unit',['name'=>'country','value'=>$userInfo->country??''])
                   <button type="submit" class="btn btn-success w-100 submit">Update Information</button>
               </form>
           </div>
       </div>
   </div>

@endsection
