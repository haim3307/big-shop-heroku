<?php

namespace App\Http\Controllers;

use App\{
    Http\Requests\UpdateUserInfoRequest, OrderList, User, UserInfo
};
use Session;

class UserController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        self::$data['user'] = auth()->user();
    }

    public function index(){
        self::$data['userInfo'] = Session::get('userInfo');
        self::setTitle(self::$data['user']->name.'\'s profile');
        return view('users.update-info',self::$data);
    }
    public function orders(){
        self::setTitle('Orders');
        OrderList::getAllOrdersPaginate(self::$data['orders'],auth()->user()->id);
        return view('users.orders',self::$data);
    }
    public function updateInfoPost(UpdateUserInfoRequest $request){
        $user = auth()->user();
        $userInfo = $user->info;
        $requestAll = $request->all();
        //isset($userInfo)?$userInfo->update($request->all()):(new UserInfo($request->all()))->save()->attach(Session::get('user'));
        if($request->hasFile('profile_img')){
            $user->uploadImg($request,'_img/profiles',['width'=>300],'profile_img');
        }
        if(empty($userInfo)){
            $userInfo = new UserInfo($requestAll);
            $user->info()->save($userInfo);
        }else $userInfo->update($requestAll);
        Session::put('userInfo',$userInfo);
        return redirect('user/profile');
    }

}
