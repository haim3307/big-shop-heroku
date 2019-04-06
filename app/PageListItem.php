<?php

namespace App;

use Illuminate\Support\Facades\DB,App\Product,App\Page,App\Category;

class PageListItem extends MainModel
{
    protected $table = 'page_list_items';
    protected $fillable = ['options', 'page_list_id', 'entity_id', 'entity_item_id','title'];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function getItem()
    {
        EntityItem::getByIds($this['entity_id'], $this['entity_item_id']);
    }

    static public function getItemStat($item)
    {
        return EntityItem::getByIdsWhere($item);
    }

    public function setEntityItem()
    {
        if(!isset($this->entity_item_id)) return;
        $query = call_user_func("App\\".$this->entity->model . '::where', "{$this->entity->table}.id",$this->entity_item_id);
        if (method_exists(self::class, $this->entity->name)) $query = call_user_func(self::class . '::' . $this->entity->name, $query);
        return $this->entityItem = $query->first();
    }

    static public function product($query)
    {
        return Product::joinCategory($query)->select('products.*', 'c.url as c_url');
    }

    static public function saveNew($list, $entityId, $itemId,$request)
    {
        $data = ['page_list_id' => $list->id, 'entity_id' => $entityId, 'entity_item_id' => $itemId];
        if (!self::where($data)->exists() or !$data['entity_id'] && !$data['entity_item_id']) {
            $item = new self($data+$request->all());
            if ($item->save()) {
                if($entityId) {
                    $item->setEntityItem();
                    $item->hasOptions = !empty($list->options_layout);
                }
                return $item;
            }
        } else return 'false';
    }
    public function updateItemOptions($request,$pageList){
        if ($optionsLayout = json_decode($pageList->options_layout, true)) {
            foreach ($optionsLayout as $key => $param){
                if($optionsLayout[$key]["type"] == "img"){
                    if(!empty($request->$key) && $request->hasFile($key) && !empty($pageList->img_path)){
                        $file = $request->file($key);
                        $fileName = self::randomFileName($file);
                        $path = public_path('_img/'.$pageList->img_path);
                        if($file->move($path,$fileName)){
                            $optionsLayout[$key]["value"] = $fileName;
                            self::rebuildImage(['width'=>1920],$path,$fileName);
                        }else $optionsLayout[$key]["value"] = !empty($request->{'old_'.$key})?$request->{'old_'.$key}:'';
                    }else $optionsLayout[$key]['value'] = !empty($request->{'old_'.$key})?$request->{'old_'.$key}:'';
                }else $optionsLayout[$key]['value'] = $request->$key??'';
            }
            $this->update(['options' => json_encode($optionsLayout)]);
        }
    }

}
