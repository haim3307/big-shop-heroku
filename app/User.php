<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use File,Image;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password','profile_img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    public function uploadImg($request,$path,$imgSize = ['width'=>600],$inputName = null){
        $path = public_path($path);
        if ($this->save() && $request->hasFile($inputName??'img') && $request->file($inputName??'img')->isValid()) {
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            $file = $request->file($inputName??'img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            if ($file->move($path, $fileName)) {
                $img = Image::make($path . '/' . $fileName);
                $img->orientate();
                $img->fit($imgSize['width']);
                $img->save();
                $this->update([$inputName??'img' => $fileName]);
            }
            return true;
        }
    }
    public function reviews(){
        return $this->hasToMany(ProductReview::class);
    }
    public function wishList(){
        return $this->hasMany(WishListItem::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function info(){
        return $this->hasOne(UserInfo::class);
    }
    public function isAdministrator() {
        return $this->role()->where('id', 5)->exists();
    }
    public function allowedCMS() {
        return $this->role()->whereIn('id', [5,3])->exists();
    }
    public function orders(){
        return $this->hasMany(OrderList::class);
    }
}
