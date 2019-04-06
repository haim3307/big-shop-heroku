<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File,Image;
class MainModel extends Model
{
    public function scopeGetByUrl($query,$url){
        $query->where('url',$url)->first();
    }
    static function getByUrl($url){
        return self::where('url',$url)->first();
    }
    static public function getByNameOrUrl(&$string){
        return self::where('url', '=', $string)->orWhere('name', '=', $string)->first();
    }
    static public function checkOrCreateFolder($path){
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
    }
    public function uploadImg($request,$path,$imgSize = ['width'=>600],$inputName = null){
        $path = public_path($path);
        if($request->hasFile($inputName??'img') && $request->file($inputName??'img')->isValid()){
            self::checkOrCreateFolder($path);
            $file = $request->file($inputName??'img');
            $fileName = self::randomFileName($file);
            if ($file->move($path, $fileName)) {
                self::rebuildImage($imgSize,$path,$fileName);
                $this->update([$inputName??'img' => $fileName]);
            }
            return 1;
        }
    }
    static public function randomFileName($file){
        return uniqid() . '.' . $file->getClientOriginalExtension();
    }
    static public function rebuildImage($imgSize,$path,$fileName){
        $img = Image::make($path . '/' . $fileName);
        $img->orientate();
        $img->resize($imgSize['width']??null, $imgSize['height']??null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save();
    }
    public function setEntityItemMain()
    {
        $query = call_user_func("App\\".$this->entity->model . '::where', "{$this->entity->table}.id",$this->entity_item_id);
        if (method_exists(self::class, $this->entity->name)) $query = call_user_func(self::class . '::' . $this->entity->name, $query);
        return $this->entityItem = $query->first();
    }

    public function setItemBaseUrl($entity){
        $this->base_url = $entity->name !== 'product'?$entity->base_url:str_replace('{category-url}',$this->c_url,$entity->base_url);
    }
    public function setItemImgPath($entity){
        $this->img_path = $entity->name !== 'product'?$entity->img_path:str_replace('{category-url}',$this->c_url,$entity->img_path);
    }
}
